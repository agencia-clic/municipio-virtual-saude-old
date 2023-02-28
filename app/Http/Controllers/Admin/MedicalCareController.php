<?php

namespace App\Http\Controllers\Admin;

use App\Events\channelMedicalCare;
use Illuminate\Http\Request;
use App\Models\MedicalCare;
use App\Models\EmergencyServices;
use App\Models\ServiceUnits;
use App\Models\EmergencyServicesForwardInternal;
use App\Http\Controllers\Controller;
use App\Models\HospitalizationObservation;
use Illuminate\Support\Facades\Validator;
use App\Models\MedicalSpecialties;
use App\Models\User;
use DB;

class MedicalCareController extends Controller
{
    protected $medical_care;
    protected $emergency_services;
    protected $service_units;
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
        $this->medical_care = new MedicalCare();
        $this->emergency_services = new EmergencyServices();
        $this->service_units = new ServiceUnits();
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
        $emergency_services = $this->medical_care->list_care($data);

        return view('admin.medical_care.list', [
            'title' => " Atendimentos | ".env('APP_NAME'),
            'emergency_services' => $emergency_services,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table(Request $request)
    {
        return view('admin.medical_care.table', [
            'emergency_services' => $this->medical_care->list_care($request->all()),
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
    public function store(Request $request, $IdEmergencyServices)
    {
        $data = $request->all();
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        $validator = Validator::make($data, [
            'anamnesis' => ['required', 'string'],
            'chief_complaint' => ['required', 'string'],
            'comorbidities' => ['required', 'string'],
            'medication_continues' => ['required', 'string'],
            'allergies' => ['required', 'string'],
            'clinical_exam' => ['required', 'string'],
            'hypothesis_diagnostics' => ['required', 'string'],
            'conduct' => ['required', 'string'],
        ]);

        $emergency_services = EmergencyServices::find($IdEmergencyServices);

        if($validator->fails() OR (empty($emergency_services))):
            return redirect(route('medical_care.form', ['IdEmergencyServices' => base64_encode($IdEmergencyServices)]))->withErrors($validator)->withInput();
        endif;

        // get the emergency services forward internal by IdEmergencyServices and status
        $emergency_services_forward_internal = EmergencyServicesForwardInternal::select('status', 'IdEmergencyServicesForwardInternal', 'IdUsersResponsibleExecution')->where('IdEmergencyServices', $emergency_services->IdEmergencyServices)->whereIn('status', ['r'])->first();

        // the responsible user for execution is not the current user
        if((empty($emergency_services_forward_internal)) OR ($emergency_services_forward_internal->status != 'a' AND $emergency_services_forward_internal->IdUsersResponsibleExecution != auth()->user()->IdUsers)):
            session()->flash('modal', json_encode(['title' => "Atenção", 'description' => 'Atendimento não esta mais disponivel.', 'color' => 'bg-warning']));
            return redirect()->route('medical_care');
        endif;

        // make records
        $medical_care = MedicalCare::create([
            'IdEmergencyServices' => $emergency_services->IdEmergencyServices,
            'IdUsers' => $emergency_services->IdUsers,
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'anamnesis' => $request->input('anamnesis'),
            'comorbidities' => $request->input('comorbidities'),
            'chief_complaint' => $request->input('chief_complaint'),
            'medication_continues' => $request->input('anamnesis'),
            'allergies' => $request->input('allergies'),
            'clinical_exam' => $request->input('clinical_exam'),
            'hypothesis_diagnostics' => $request->input('hypothesis_diagnostics'),
            'conduct' => $request->input('conduct'),
            'aggression' => $request->input('aggression'),
            'firearm_aggression' => $request->input('firearm_aggression'),
            'weapon_flaps' => $request->input('weapon_flaps'),
            'self_extermination' => $request->input('self_extermination'),
            'sexual_violence' => $request->input('sexual_violence'),
            'forensic_examination' => $request->input('forensic_examination'),
        ]);

        // closes the internal medical consultation
        $emergency_services_forward_internal = EmergencyServicesForwardInternal::find($emergency_services_forward_internal->IdEmergencyServicesForwardInternal);
        $emergency_services_forward_internal->status = 'e';
        $emergency_services_forward_internal->IdMedicalCare = $medical_care->IdMedicalCare;
        $emergency_services_forward_internal->save();

        //new hospitalization observation
        HospitalizationObservation::create([
            'status' => 'a',
            'type' => "o",
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdUsers' => $emergency_services->IdUsers,
            'IdEmergencyServices' => $emergency_services->IdEmergencyServices,
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('emergency_services_conducts', ['type' => 'm', 'IdEmergencyServices' => base64_encode($IdEmergencyServices)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdEmergencyServices)
    {
        // select from units
        $service_units = $this->service_units::whereExists(function ($query) {
            $query->select(DB::raw(true))->from('service_units_forwarding')->
            whereColumn('service_units_forwarding.IdServiceUnitsReceive', 'service_units.IdServiceUnits')->
            where('service_units_forwarding.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);
        })->get();

        // get emergency services by decoding the given IdEmergencyServices
        $emergency_services = $this->emergency_services->list_current(base64_decode($IdEmergencyServices));

        // check if the responsible user for medicare is empty, if so, update it with the current user's IdUsers
        if(empty($emergency_services->IdUsersResponsibleMedicare)):
            $emergency_services_edit = EmergencyServices::find($emergency_services->IdEmergencyServices); 
            $emergency_services_edit->IdUsersResponsibleMedicare = auth()->user()->IdUsers;
            $emergency_services_edit->save();
        endif;

        // get the emergency services forward internal by IdEmergencyServices and status
        $emergency_services_forward_internal = EmergencyServicesForwardInternal::select('status', 'IdEmergencyServicesForwardInternal', 'IdUsersResponsibleExecution')->where('IdEmergencyServices', $emergency_services->IdEmergencyServices)->whereIn('status', ['a', 'r'])->first();

        // check if the emergency services forward internal is empty or not active, or the responsible user for execution is not the current user
        if((empty($emergency_services_forward_internal)) OR ($emergency_services_forward_internal->status != 'a' AND $emergency_services_forward_internal->IdUsersResponsibleExecution != auth()->user()->IdUsers)):
            // flash a warning message and redirect to the medical_care route
            session()->flash('modal', json_encode(['title' => "Atenção", 'description' => 'Atendimento não esta mais disponivel.', 'color' => 'bg-warning']));
            return redirect()->route('medical_care');
        endif;

        // if the status of emergency services forward internal is active, update it to 'r' and assign the current user as the responsible user for execution
        if($emergency_services_forward_internal->status == "a"):
            $emergency_services_forward_internal = EmergencyServicesForwardInternal::find($emergency_services_forward_internal->IdEmergencyServicesForwardInternal);
            $emergency_services_forward_internal->status = 'r';
            $emergency_services_forward_internal->IdUsersResponsibleExecution = auth()->user()->IdUsers;
            $emergency_services_forward_internal->save();
        endif;

        // return the medical_care form view with necessary data
        return view('admin.medical_care.form', [
            'title' => " Atendimentos | ".env('APP_NAME'),
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

        $emergency_services = EmergencyServices::find($IdEmergencyServices);

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdEmergencyServices, $IdMedicalCare)
    {
        $IdMedicalCare = base64_decode($IdMedicalCare);
        $medical_care = MedicalCare::find($IdMedicalCare);
        $data = $request->all();

        $validator = Validator::make($data, [
            'anamnesis' => ['required', 'string'],
        ]);

        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        if($validator->fails() OR (empty($emergency_services))):
            return redirect(route('medical_care.form', ['IdEmergencyServices' => base64_encode($IdEmergencyServices), 'IdMedicalCare' => $IdEmergencyServices]))->withErrors($validator)->withInput();
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

    public function release($IdEmergencyServices)
    {
        // get the emergency services forward internal by IdEmergencyServices and status
        $emergency_services_forward_internal = EmergencyServicesForwardInternal::select('status', 'IdEmergencyServicesForwardInternal', 'IdUsersResponsibleExecution')->where('IdEmergencyServices', base64_decode($IdEmergencyServices))->whereIn('status', ['r'])->first();

        if(!empty($emergency_services_forward_internal)):
            $emergency_services_forward_internal = EmergencyServicesForwardInternal::find($emergency_services_forward_internal->IdEmergencyServicesForwardInternal);
            $emergency_services_forward_internal->status = 'a';
            $emergency_services_forward_internal->IdUsersResponsibleExecution = NULL;
            $emergency_services_forward_internal->save();
        endif;
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

        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        if($validator->fails() OR (empty($emergency_services))):
            return redirect(route('medical_care.form.iframe', ['IdEmergencyServices' => base64_encode($IdEmergencyServices)]))->withErrors($validator)->withInput();
        endif;

        $medical_care->anamnesis = $data['anamnesis'];
        $medical_care->save();
        return "success";
    }
}
