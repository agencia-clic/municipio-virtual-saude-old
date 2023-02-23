<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmergencyServicesForwardInternal;
use Illuminate\Http\Request;
use App\Models\Screenings;
use App\Models\EmergencyServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\MedicalSpecialties;
use App\Models\User;
use DB;

class ScreeningsController extends Controller
{
    protected $screenings;
    protected $emergency_services;
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

        EmergencyServicesForwardInternal::create([
            'status' => 'a',
            'type' => 't',
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'IdEmergencyServices' => $IdEmergencyServices,
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdFlowcharts' => $data['IdFlowcharts'],
        ]);

        $emergency_services->types = "atem";
        $emergency_services->save();

        $data['IdServiceUnits'] = auth()->user()->units_current()->IdServiceUnits;
        $data['IdEmergencyServices'] = $emergency_services->IdEmergencyServices;
        $data['IdUsers'] = $emergency_services->IdUsers;
        $data['IdUsersResponsible'] = auth()->user()->IdUsers;
        $this->create($data, $request);

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

        //update em processo
        $emergency_services = EmergencyServices::find($data['IdEmergencyServices']);
        $emergency_services->IdUsersResponsibleScreenings = auth()->user()->IdUsers;
        $emergency_services->save();

        $screenings = $this->screenings->list_current(base64_decode($IdScreenings));
        $emergency_services = $this->emergency_services->list_current($data['IdEmergencyServices']);

        return view('admin.screenings.form', [
            'title' => " Atendimentos | ".env('APP_NAME'),
            'emergency_services' => $emergency_services,
            'users' => $this->users->list_current($emergency_services->IdUsers),
            'screenings' => $screenings,
            'medical_specialties' => MedicalSpecialties::select('title', 'code')->where('status', 'a')->where('service', 'y')->get(),
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
        $screenings->breathing_type = $data['breathing_type'];
        $screenings->allergic_reactions = $data['allergic_reactions'];
        $screenings->discriminator = $data['discriminator'];
        $screenings->save();

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
            'breathing_type' => $data['breathing_type'],
            'allergic_reactions' => $data['allergic_reactions'],
            'discriminator' => $data['discriminator'],
        ]);
    }
}