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

        // validator
        $validator = Validator::make($data, [
            'temperature' => ['required', 'string', 'max:255'],
            'IdMedicalSpecialties' => ['required', 'max:255'],
            'O2_saturation' => ['required', 'string', 'max:255'],
            'blood_pressure' => ['required', 'string', 'max:255'],
        ]);
        
        // update emergency services
        $emergency_services = $this->emergency_services::find($IdEmergencyServices);
        $emergency_services->types = "atem";
        $emergency_services->save();

        if($validator->fails() OR (empty($emergency_services))):
            return redirect(route('screenings.form', ['IdEmergencyServices' => base64_encode($IdEmergencyServices)]))->withErrors($validator)->withInput();
        endif;
        
        //create screenings
        $screenings = Screenings::create([
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'IdEmergencyServices' => $emergency_services->IdEmergencyServices,
            'IdMedicalSpecialties' => $request->input('IdMedicalSpecialties'),
            'IdUsers' => $emergency_services->IdUsers,
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'weight' => $request->input('weight'),
            'temperature' => $request->input('temperature'),
            'heart_rate' => $request->input('heart_rate'),
            'height' => $request->input('height'),
            'respiratory_frequency' => $request->input('respiratory_frequency'),
            'O2_saturation' => $request->input('O2_saturation'),
            'blood_pressure' => $request->input('blood_pressure'),
            'ecg' => $request->input('ecg'),
            'blood_glucose' => $request->input('blood_glucose'),
            'rule_of_pain' => $request->input('rule_of_pain'),
            'condition_hypertensive' => $request->input('condition_hypertensive'),
            'condition_diabetic' => $request->input('condition_diabetic'),
            'condition_heart_disease' => $request->input('condition_heart_disease'),
            'condition_pregnant' => $request->input('condition_pregnant'),
            'gestational_age' => $request->input('gestational_age'),
            'complaints' => $request->input('complaints'),
            'classification' => $request->input('classification'),
            'breathing_type' => $request->input('breathing_type'),
            'allergic_reactions' => $request->input('allergic_reactions'),
            'discriminator' => $request->input('discriminator'),
        ]);

        //create emergency services forward Internal
        EmergencyServicesForwardInternal::create([
            'status' => 'a',
            'type' => 't',
            'IdScreenings' => $screenings->IdScreenings,
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'IdEmergencyServices' => $IdEmergencyServices,
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdMedicalSpecialties' => $request->input('IdMedicalSpecialties'),
        ]);

        // modal success
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
            'medical_specialties' => MedicalSpecialties::select('IdMedicalSpecialties', 'title', 'code')->where('status', 'a')->where('service', 'y')->get(),
        ]);
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
}