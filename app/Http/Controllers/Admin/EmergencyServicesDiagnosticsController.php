<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmergencyServicesDiagnostics;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\EmergencyServices;
use DB;

class EmergencyServicesDiagnosticsController extends Controller
{
    protected $emergency_services_diagnostics;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->emergency_services_diagnostics = new EmergencyServicesDiagnostics();
        $this->mask = new Mask();
        $this->emergency_services = new EmergencyServices();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $IdEmergencyServices)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        $emergency_services_diagnostics = $this->emergency_services_diagnostics->list($IdEmergencyServices, $request->input('type'));
        return view('admin.emergency_services_diagnostics.list', [
            'mask' => $this->mask,
            'emergency_services_diagnostics' => $emergency_services_diagnostics
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
        $emergency_services = $this->emergency_services->list_current(base64_decode($IdEmergencyServices));

        $validator = Validator::make($data, [
            'IdCid10' => ['required', 'string', 'max:11'],
            'traffic_accident' => ['required', 'string', 'max:1'],
            'work_related' => ['required', 'string', 'max:1'],
            'violent_attack' => ['required', 'string', 'max:1'],
            'notifiable_disease' => ['required', 'string', 'max:1'],
            'main_diagnosis' => ['required', 'string', 'max:1'],
            'diagnostics' => ['required', 'string', 'max:1'],
            'respiratory_symptomatic' => ['required', 'string', 'max:1'],
        ]);

        if(!empty($data['date'])):
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        endif;

        if($validator->fails()):
            return redirect(route('emergency_services_diagnostics.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        EmergencyServicesDiagnostics::create([
            'IdEmergencyServices' => base64_decode($IdEmergencyServices),
            'IdUsers' => $emergency_services->IdUsers,
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdCid10' => $data['IdCid10'],
            'traffic_accident' => $data['traffic_accident'],
            'work_related' => $data['work_related'],
            'violent_attack' => $data['violent_attack'],
            'notifiable_disease' => $data['notifiable_disease'],
            'diagnostics' => $data['diagnostics'],
            'main_diagnosis' => $data['main_diagnosis'],
            'respiratory_symptomatic' => $data['respiratory_symptomatic'],
            'date' => $data['date'],
        ]);


        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdEmergencyServices, $IdEmergencyServicesDiagnostics = null)
    {
        $emergency_services_diagnostics = $this->emergency_services_diagnostics->list_current(base64_decode($IdEmergencyServicesDiagnostics));
        return view('admin.emergency_services_diagnostics.form', [
            'emergency_services_diagnostics' => $emergency_services_diagnostics
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
        $emergency_services_diagnostics = EmergencyServicesDiagnostics::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdCid10' => ['required', 'string', 'max:11'],
            'traffic_accident' => ['required', 'string', 'max:1'],
            'work_related' => ['required', 'string', 'max:1'],
            'violent_attack' => ['required', 'string', 'max:1'],
            'notifiable_disease' => ['required', 'string', 'max:1'],
            'main_diagnosis' => ['required', 'string', 'max:1'],
            'diagnostics' => ['required', 'string', 'max:1'],
            'respiratory_symptomatic' => ['required', 'string', 'max:1'],
        ]);
        
        if(!empty($data['date'])):
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        endif;

        if($validator->fails()):
            return redirect(route('emergency_services_diagnostics.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        $emergency_services_diagnostics->IdCid10 = $data['IdCid10'];
        $emergency_services_diagnostics->traffic_accident = $data['traffic_accident'];
        $emergency_services_diagnostics->work_related = $data['work_related'];
        $emergency_services_diagnostics->violent_attack = $data['violent_attack'];
        $emergency_services_diagnostics->notifiable_disease = $data['notifiable_disease'];
        $emergency_services_diagnostics->diagnostics = $data['diagnostics'];
        $emergency_services_diagnostics->main_diagnosis = $data['main_diagnosis'];
        $emergency_services_diagnostics->respiratory_symptomatic = $data['respiratory_symptomatic'];
        $emergency_services_diagnostics->date = $data['date'];
        $emergency_services_diagnostics->save();

        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmergencyServicesDiagnostics::find(base64_decode($id))->delete();
    }
}
