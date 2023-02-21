<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmergencyServicesForwardInternal;
use App\Events\channelCall;
use App\Events\channelScreenings;
use Illuminate\Http\Request;
use App\Models\Screenings;
use App\Models\EmergencyServices;
use App\Models\ServiceUnits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\MedicalSpecialties;
use App\Models\EmergencyServicesVitalData;
use App\Models\Flowcharts;
use App\Models\FlowchartsUsers;
use App\Models\FlowchartsServiceUnits;
use App\Models\MedicalCareRaffles;
use App\Models\User;
use DB;

class ScreeningsController extends Controller
{
    protected $screenings;
    protected $emergency_services;
    protected $mask;
    protected $flowcharts;
    protected $medical_specialties;
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->screenings = new Screenings();
        $this->emergency_services = new EmergencyServices();
        $this->mask = new Mask();
        $this->flowcharts = new Flowcharts();
        $this->medical_specialties = new MedicalSpecialties();
        $this->users = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $data['types'] = $request->input('types') ?? "acol";
        $data['status'] = "a";

        return view('admin.screenings.list', [
            'title' => " Atendimentos Triagem | ".env('APP_NAME'),
            'emergency_services' => $this->emergency_services->list($data),
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table(Request $request)
    {
        $data = $request->all();
        $data['types'] = $request->input('types') ?? "acol";
        $data['status'] = "a";

        return view('admin.screenings.table', [
            'emergency_services' => $this->emergency_services->list($data),
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome(Request $request, $IdEmergencyServices)
    {
        $data = $request->all();
        $data['IdEmergencyServices'] = base64_decode($IdEmergencyServices);
        $emergency_services = $this->emergency_services->list_current($data['IdEmergencyServices']);

        return view('admin.screenings.wellcome', [
            'title' => " Atendimentos Triagem | ".env('APP_NAME'),
            'screenings' => $this->screenings->list($data),
            'emergency_services' => $emergency_services,
            'mask' => $this->mask,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdEmergencyServices)
    {
        $data = $request->all();
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        $validator = Validator::make($data, [
            'temperature' => ['required', 'string', 'max:255'],
            'IdFlowcharts' => ['required', 'string', 'max:255'],
            'O2_saturation' => ['required', 'string', 'max:255'],
            'blood_pressure' => ['required', 'string', 'max:255'],
        ]);

        //type
        $data['type'] = $data['type'] ?? "e";
        $emergency_services = $this->emergency_services::find($IdEmergencyServices);

        if($validator->fails() OR (empty($emergency_services))):
            return redirect(route('screenings.form', ['IdEmergencyServices' => base64_encode($IdEmergencyServices)]))->withErrors($validator)->withInput();
        endif;

        //type
        if($data['type'] == "a"):

            EmergencyServicesForwardInternal::create([
                'status' => 'a',
                'type' => 't',
                'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
                'IdEmergencyServices' => $IdEmergencyServices,
                'IdUsersResponsible' => auth()->user()->IdUsers,
                'IdFlowcharts' => $data['IdFlowcharts'],
            ]);

            $emergency_services->types = "atem";
        elseif($data['type'] == "e"):
            $emergency_services->status = "rf";
            $emergency_services->IdServiceUnitsForwarding = $request->input('IdServiceUnitsForwarding');
            $emergency_services->forwarding_reason = $request->input('forwarding_reason');

            //insert emergencia
            $emerg = EmergencyServices::create([
                'IdServiceUnits' => $request->input('IdServiceUnitsForwarding'),
                'IdUsers' => $emergency_services->IdUsers,
                'IdUsersResponsible' => auth()->user()->IdUsers,
                'types' => 'pp',  
                'provenance' => 'amb',
                'character' => 'ele',
                'accident_work' => 'n',
                'note' => $request->input('forwarding_reason'),
                'identified_patient' => 's',
                'status' => 'a',
            ]);

            $data['IdServiceUnits'] = $request->input('IdServiceUnitsForwarding');
            $data['IdEmergencyServices'] =  $emerg->IdEmergencyServices;
            $data['IdUsers'] = $emergency_services->IdUsers;
            $data['IdUsersResponsible'] = auth()->user()->IdUsers;
            $this->create($data, $request);

        else:
            $emergency_services->status = "r";
            $emergency_services->discharge_reason = $data['discharge_reason'];
        endif;

        $emergency_services->save();

        $data['IdServiceUnits'] = auth()->user()->units_current()->IdServiceUnits;
        $data['IdEmergencyServices'] = $emergency_services->IdEmergencyServices;
        $data['IdUsers'] = $emergency_services->IdUsers;
        $data['IdUsersResponsible'] = auth()->user()->IdUsers;
        $this->create($data, $request);

        //broadcast
        channelScreenings::dispatch(auth()->user()->units_current()->IdServiceUnits);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('screenings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdEmergencyServices, $IdScreenings = null)
    {
        $data = $request->all();
        $data['IdEmergencyServices'] = base64_decode($IdEmergencyServices);
        $emergency_services = $this->emergency_services->list_current($data['IdEmergencyServices']);

        //update em processo
        $emergency_services = EmergencyServices::find($emergency_services->IdEmergencyServices);
        $emergency_services->IdUsersResponsibleScreenings = auth()->user()->IdUsers;
        $emergency_services->save();
        
        //broadcast
        channelScreenings::dispatch(auth()->user()->units_current()->IdServiceUnits);

        $screenings = $this->screenings->list_current(base64_decode($IdScreenings));

        //select from units
        $flowcharts = Flowcharts::join('flowcharts_service_units', 'flowcharts.IdFlowcharts', 'flowcharts_service_units.IdFlowcharts')->
        where('flowcharts_service_units.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->where('flowcharts_service_units.status', 'a')->get();

        return view('admin.screenings.form', [
            'title' => " Atendimentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'emergency_services' => $emergency_services,
            'users' => $this->users->list_current($emergency_services->IdUsers),
            "flowcharts" => $flowcharts,
            'screenings' => $screenings
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdEmergencyServices, $id)
    {
        $screenings = Screenings::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('screenings.form', ['IdScreenings' => base64_encode($screenings->IdScreenings)]))->withErrors($validator)->withInput();
        endif;

        $screenings->IdMedicalSpecialties = $data['IdMedicalSpecialties'];
        $screenings->weight = $data['weight'];
        $screenings->heart_rate = $data['heart_rate'];
        $screenings->height = $data['height'];
        $screenings->respiratory_frequency = $data['respiratory_frequency'];
        $screenings->O2_saturation = $data['O2_saturation'];
        $screenings->blood_pressure = $data['blood_pressure'];
        $screenings->ecg = $data['ecg'];
        $screenings->blood_glucose = $data['blood_glucose'];
        $screenings->rule_of_pain = $data['rule_of_pain'];
        $screenings->condition_hypertensive = $request->input('condition_hypertensive');
        $screenings->condition_diabetic = $request->input('condition_diabetic');
        $screenings->condition_heart_disease = $request->input('condition_heart_disease');
        $screenings->condition_pregnant = $request->input('condition_pregnant');
        $screenings->gestational_age = $request->input('gestational_age');
        $screenings->complaints = $data['complaints'];
        $screenings->classification = $data['classification'];
        $screenings->status = $data['status'];
        
        $screenings->save();

        //broadcast
        channelScreenings::dispatch(auth()->user()->units_current()->IdServiceUnits);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('screenings.welcome', ['IdEmergencyServices' => $IdEmergencyServices]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Screenings::find(base64_decode($id))->delete();
    }

    public function create($data, $request)
    {
        Screenings::create([
            'IdServiceUnits' => $data['IdServiceUnits'],
            'IdEmergencyServices' => $data['IdEmergencyServices'],
            'IdFlowcharts' => $data['IdFlowcharts'],
            'IdUsers' => $data['IdUsers'],
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'type' => $data['type'],
            'weight' => $data['weight'],
            'temperature' => $data['temperature'],
            'heart_rate' => $data['heart_rate'],
            'height' => $data['height'],
            'respiratory_frequency' => $data['respiratory_frequency'],
            'O2_saturation' => $data['O2_saturation'],
            'blood_pressure' => $data['blood_pressure'],
            'ecg' => $data['ecg'],
            'blood_glucose' => $data['blood_glucose'],
            'rule_of_pain' => $data['rule_of_pain'],
            'condition_hypertensive' => $request->input('condition_hypertensive'),
            'condition_diabetic' => $request->input('condition_diabetic'),
            'condition_heart_disease' => $request->input('condition_heart_disease'),
            'condition_pregnant' => $request->input('condition_pregnant'),
            'gestational_age' => $request->input('gestational_age'),
            'complaints' => $request->input('complaints'),
            'classification' => $data['classification'],
        ]);

        $this->lottery($data['IdEmergencyServices'], $data['classification'], $data['IdFlowcharts']);
    }

    private function lottery($IdEmergencyServices, $classification, $IdFlowcharts)
    {
        $weight = array();
        $flowcharts_users = FlowchartsUsers::where('status', 'a')->where('IdFlowcharts', $IdFlowcharts)->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->get();

        if(!empty($flowcharts_users)):

            foreach($flowcharts_users as $val_users):

                //para os que tem 0 atendimento
                $medical_care_raffles_count =  MedicalCareRaffles::where('IdUsers', $val_users->IdUsers)->where('status', 'a')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->count();
                if($medical_care_raffles_count == 0):
                    MedicalCareRaffles::where('IdEmergencyServices', $IdEmergencyServices)->update(['status' => 'b']);
                    MedicalCareRaffles::create([
                        'status' => 'a',
                        'IdUsers' => $val_users->IdUsers,
                        'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
                        'IdEmergencyServices' => $IdEmergencyServices
                    ]);
                    return 0;
                endif;

                //count classification
                $medical_care_raffles_count_classification = MedicalCareRaffles::where('medical_care_raffles.IdUsers', $val_users->IdUsers)->where('medical_care_raffles.status', 'a')->join('screenings', 'medical_care_raffles.IdEmergencyServices', '=', 'screenings.IdEmergencyServices')->where('screenings.classification', $classification)->
                where('medical_care_raffles.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->whereRaw("screenings.IdScreenings = (select max(`IdScreenings`) from screenings WHERE IdEmergencyServices={$IdEmergencyServices})")->count();

                $weight[$val_users->IdUsers] = $medical_care_raffles_count_classification;

            endforeach;

            if(!empty($weight)):
                foreach ($weight as $key => $value):
                    if($value == min($weight)):
                        MedicalCareRaffles::where('IdEmergencyServices', $IdEmergencyServices)->update(['status' => 'b']);
                        MedicalCareRaffles::create([
                            'status' => 'a',
                            'IdUsers' => $key,
                            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
                            'IdEmergencyServices' => $IdEmergencyServices
                        ]);
                        return 0;
                    endif;
                endforeach;
            endif;
            
        endif;
    }
}