<?php

namespace App\Http\Controllers\Admin;

use App\Events\channelMedicalCare;
use Illuminate\Http\Request;
use App\Models\MedicalCare;
use App\Models\EmergencyServices;
use App\Models\ServiceUnits;
use App\Models\UsersMedicalSpecialties;
use App\Models\MedicalCareLottery;
use App\Models\EmergencyServicesForwardInternal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\MedicalSpecialties;
use App\Models\User;
use DB;

class MedicalCareController extends Controller
{
    protected $medical_care;
    protected $emergency_services;
    protected $mask;
    protected $service_units;
    protected $medical_specialties;
    protected $medical_care_lottery;
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->medical_care = new MedicalCare();
        $this->emergency_services = new EmergencyServices();
        $this->mask = new Mask();
        $this->service_units = new ServiceUnits();
        $this->medical_specialties = new MedicalSpecialties();
        $this->medical_care_lottery = new MedicalCareLottery();
        $this->users = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $IdFlowcharts)
    {
        $data = $request->all();
        $data['IdFlowcharts'] = base64_decode($IdFlowcharts);
        $emergency_services = $this->medical_care->list_care($data);

        return view('admin.medical_care.list', [
            'title' => " Atendimentos | ".env('APP_NAME'),
            'IdFlowcharts' => $IdFlowcharts,
            'emergency_services' => $emergency_services,
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table(Request $request, $IdFlowcharts)
    {
        $data = $request->all();
        $data['IdFlowcharts'] = base64_decode($IdFlowcharts);

        return view('admin.medical_care.table', [
            'emergency_services' => $this->medical_care->list_care($data),
            'IdFlowcharts' => $IdFlowcharts,
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_iframe(Request $request, $IdEmergencyServices)
    {
        $data = $request->all();
        $data['IdEmergencyServices'] = base64_decode($IdEmergencyServices);
        $emergency_services = $this->emergency_services->list_current(base64_decode($IdEmergencyServices));

        return view('admin.medical_care.list_iframe', [
            'medical_care' => $this->medical_care->list($data),
            'users' => $this->users,
            'emergency_services' => $emergency_services,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdEmergencyServices, $IdEmergencyServicesForwardInternal, $IdFlowcharts)
    {
        $data = $request->all();
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        $validator = Validator::make($data, [
            'anamnesis' => ['required', 'string'],
        ]);

        $emergency_services = $this->emergency_services::find($IdEmergencyServices);

        if($validator->fails() OR (empty($emergency_services))):
            return redirect(route('medical_care.form', ['IdFlowcharts' => $IdFlowcharts, 'IdEmergencyServicesInternal' => $IdEmergencyServicesForwardInternal, 'IdEmergencyServices' => base64_encode($IdEmergencyServices)]))->withErrors($validator)->withInput();
        endif;

        $IdEmergencyServicesForwardInternal = base64_decode($IdEmergencyServicesForwardInternal);

        $medical_care = MedicalCare::create([
            'IdEmergencyServices' => $emergency_services->IdEmergencyServices,
            'IdUsers' => $emergency_services->IdUsers,
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'anamnesis' => $request['anamnesis'],
            'guidelines' => $request['guidelines'],
            'bodily_injury' => $request['bodily_injury'],
            'aggression' => $request['aggression'],
            'firearm_aggression' => $request['firearm_aggression'],
            'weapon_flaps' => $request['weapon_flaps'],
            'self_extermination' => $request->input('self_extermination'),
            'sexual_violence' => $request->input('sexual_violence'),
            'forensic_examination' => $request->input('forensic_examination'),
        ]);

        $emergency_services_forward_internal = EmergencyServicesForwardInternal::find($IdEmergencyServicesForwardInternal);
        $emergency_services_forward_internal->status = 'e';
        $emergency_services_forward_internal->IdMedicalCare = $medical_care->IdMedicalCare;
        $emergency_services_forward_internal->save();

        //broadcast
        broadcast(new channelMedicalCare(auth()->user()->units_current()->IdServiceUnits));

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('emergency_services_conducts', ['type' => $IdFlowcharts, 'IdEmergencyServices' => base64_encode($IdEmergencyServices)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdFlowcharts, $IdEmergencyServices, $IdEmergencyServicesForwardInternal, $IdMedicalCare = null)
    {
        //select from units
        $service_units = $this->service_units::whereExists(function ($query) {
            $query->select(DB::raw(true))->from('service_units_forwarding')->
            whereColumn('service_units_forwarding.IdServiceUnitsReceive', 'service_units.IdServiceUnits')->
            where('service_units_forwarding.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);
        })->get();

        $emergency_services = $this->emergency_services->list_current(base64_decode($IdEmergencyServices));
        if(empty($emergency_services->IdUsersResponsibleMedicare)):
            $emergency_services_edit = EmergencyServices::find($emergency_services->IdEmergencyServices); 
            $emergency_services_edit->IdUsersResponsibleMedicare = auth()->user()->IdUsers;
            $emergency_services_edit->save();
        endif;

        return view('admin.medical_care.form', [
            'title' => " Atendimentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'IdFlowcharts' => $IdFlowcharts,
            'IdEmergencyServicesForwardInternal' => $IdEmergencyServicesForwardInternal,
            'emergency_services' =>  $emergency_services,
            'users' => $this->users->list_current($emergency_services->IdUsers),
            "service_units" => $service_units,
            "medical_specialties" => $this->medical_specialties::where('status', 'a')->get(),
            'medical_care' => MedicalCare::where('IdEmergencyServices', $emergency_services->IdEmergencyServices)->orderBy('IdMedicalCare', 'ASC')->first()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_iframe($IdEmergencyServices, $IdMedicalCare = null)
    {
        return view('admin.medical_care.form_iframe', [
            'medical_care' => MedicalCare::find(base64_decode($IdMedicalCare))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_iframe(Request $request, $IdEmergencyServices)
    {
        $data = $request->all();
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        $validator = Validator::make($data, [
            'anamnesis' => ['required', 'string'],
        ]);

        $emergency_services = $this->emergency_services::find($IdEmergencyServices);

        if($validator->fails() OR (empty($emergency_services))):
            return redirect(route('medical_care.form.iframe', ['IdEmergencyServices' => base64_encode($IdEmergencyServices)]))->withErrors($validator)->withInput();
        endif;

        MedicalCare::create([
            'IdEmergencyServices' => $emergency_services->IdEmergencyServices,
            'IdUsers' => $emergency_services->IdUsers,
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'anamnesis' => $request['anamnesis'],
        ]);

        return "success";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function watch($IdEmergencyServices, $IdMedicalCareLottery)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices); 
        $IdMedicalCareLottery = base64_decode($IdMedicalCareLottery);

        $medical_care_lottery = MedicalCareLottery::find($IdMedicalCareLottery);
        $medical_care_lottery->status = "p";
        $medical_care_lottery->save();

        $emergency_services_edit = EmergencyServices::find($IdEmergencyServices); 
        $emergency_services_edit->IdUsersResponsibleMedicare = NULL;
        $emergency_services_edit->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function release($IdEmergencyServices, $IdMedicalCareLottery)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices); 
        $IdMedicalCareLottery = base64_decode($IdMedicalCareLottery);

        $medical_care_lottery = MedicalCareLottery::find($IdMedicalCareLottery);
        $medical_care_lottery->status = "b";

        $emergency_services_edit = EmergencyServices::find($IdEmergencyServices); 
        $emergency_services_edit->IdUsersResponsibleMedicare = NULL;
        $emergency_services_edit->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdEmergencyServices, $IdMedicalCare, $IdFlowcharts)
    {
        $IdMedicalCare = base64_decode($IdMedicalCare);
        $medical_care = MedicalCare::find($IdMedicalCare);
        $data = $request->all();

        $validator = Validator::make($data, [
            'anamnesis' => ['required', 'string'],
        ]);

        $emergency_services = $this->emergency_services::find(base64_decode($IdEmergencyServices));

        if($validator->fails() OR (empty($emergency_services))):
            return redirect(route('medical_care.form', ['IdFlowcharts' => $IdFlowcharts, 'IdEmergencyServices' => base64_encode($IdEmergencyServices), 'IdMedicalCare' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        $medical_care->guidelines = $request['guidelines'];
        $medical_care->bodily_injury = $request['bodily_injury'];
        $medical_care->aggression = $request['aggression'];
        $medical_care->firearm_aggression = $request['firearm_aggression'];
        $medical_care->weapon_flaps = $request['weapon_flaps'];
        $medical_care->self_extermination = $request->input('self_extermination');
        $medical_care->sexual_violence = $request->input('sexual_violence');
        $medical_care->forensic_examination = $request->input('forensic_examination');

        $medical_care->anamnesis = $data['anamnesis'];
        $medical_care->save();

        //broadcast
        broadcast(new channelMedicalCare(auth()->user()->units_current()->IdServiceUnits));

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('emergency_services_conducts', ['type' => $IdFlowcharts, 'IdEmergencyServices' => $IdEmergencyServices]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_iframe(Request $request, $IdEmergencyServices, $IdMedicalCare)
    {
        $IdMedicalCare = base64_decode($IdMedicalCare);
        $medical_care = MedicalCare::find($IdMedicalCare);
        $data = $request->all();

        $validator = Validator::make($data, [
            'anamnesis' => ['required', 'string'],
        ]);

        $emergency_services = $this->emergency_services::find(base64_decode($IdEmergencyServices));

        if($validator->fails() OR (empty($emergency_services))):
            return redirect(route('medical_care.form.iframe', ['IdEmergencyServices' => base64_encode($IdEmergencyServices)]))->withErrors($validator)->withInput();
        endif;

        $medical_care->anamnesis = $data['anamnesis'];
        $medical_care->save();
        return "success";
    }
}
