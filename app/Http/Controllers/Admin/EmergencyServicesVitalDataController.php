<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmergencyServicesVitalData;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\EmergencyServices;
use App\Models\EmergencyServicesRoles;
use App\Models\ServiceUnits;
use PDF;
use DB;

class EmergencyServicesVitalDataController extends Controller
{
    protected $emergency_services_vital_data;
    protected $users;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->emergency_services_vital_data = new EmergencyServicesVitalData();
        $this->users = new User();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($IdEmergencyServices)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices); 
        $emergency_services_vital_data = $this->emergency_services_vital_data->list($IdEmergencyServices);

        return view('admin.emergency_services_vital_data.list', [
            'mask' => $this->mask,
            'users' => $this->users,
            'emergency_services_vital_data' => $emergency_services_vital_data
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

        $validator = Validator::make($data, [
            'temperature' => ['required', 'string'],
            'heart_rate' => ['required', 'string'],
            'respiratory_frequency' => ['required', 'string'],
        ]);

        if($validator->fails()):
            return redirect(route('emergency_services_vital_data.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        EmergencyServicesVitalData::create([
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdEmergencyServices' => base64_decode($IdEmergencyServices),
            'temperature' => $request->input('temperature'),
            'weight' => $request->input('weight'),
            'heart_rate' => $request->input('heart_rate'),
            'height' => $request->input('height'),
            'respiratory_frequency' => $request->input('respiratory_frequency'),
            'O2_saturation' => $request->input('O2_saturation'),
            'blood_pressure' => $request->input('blood_pressure'),
            'flowchart' => $request->input('flowchart'),
            'discriminator' => $request->input('discriminator'),
            'rule_of_pain' => $request->input('rule_of_pain'),
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdEmergencyServices, $IdEmergencyServicesVitalData = null)
    {
        $IdEmergencyServicesVitalData = base64_decode($IdEmergencyServicesVitalData);
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_vital_data = $this->emergency_services_vital_data->list_current($IdEmergencyServicesVitalData);

        return view('admin.emergency_services_vital_data.form', [
            'emergency_services_vital_data' => $emergency_services_vital_data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdEmergencyServices, $IdEmergencyServicesVitalData)
    {
        $data = $request->all();
        $IdEmergencyServicesVitalData = base64_decode($IdEmergencyServicesVitalData);

        $validator = Validator::make($data, [
            'temperature' => ['required', 'string'],
            'heart_rate' => ['required', 'string'],
            'respiratory_frequency' => ['required', 'string'],
            'O2_saturation' => ['required', 'string'],
        ]);

        if($validator->fails()):
            return redirect(route('emergency_services_vital_data.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        $emergency_servicesVitalData = EmergencyServicesVitalData::find($IdEmergencyServicesVitalData);

        $emergency_servicesVitalData->temperature = $request->input('temperature');
        $emergency_servicesVitalData->weight = $request->input('weight');
        $emergency_servicesVitalData->heart_rate = $request->input('heart_rate');
        $emergency_servicesVitalData->height = $request->input('height');
        $emergency_servicesVitalData->respiratory_frequency = $request->input('respiratory_frequency');
        $emergency_servicesVitalData->O2_saturation = $request->input('O2_saturation');
        $emergency_servicesVitalData->blood_pressure = $request->input('blood_pressure');
        $emergency_servicesVitalData->flowchart = $request->input('flowchart');
        $emergency_servicesVitalData->discriminator = $request->input('discriminator');
        $emergency_servicesVitalData->rule_of_pain = $request->input('rule_of_pain');
        $emergency_servicesVitalData->save();

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
        EmergencyServicesVitalData::find(base64_decode($id))->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export_pdf($IdEmergencyServices, $id = null)
    {
        $title = 'Dados Vitais';
        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        $emergency_services_vital_data = EmergencyServicesVitalData::where('IdEmergencyServices', base64_decode($IdEmergencyServices))->
        select('emergency_services_vital_data.*', 'users_responsible.name as responsible', 'users_responsible.crm as responsible_crm')->
        join('users as users_responsible', 'emergency_services_vital_data.IdUsersResponsible', '=', 'users_responsible.IdUsers');

        if(!empty($id)):
            $emergency_services_vital_data = $emergency_services_vital_data->where('IdEmergencyServicesVitalData', base64_decode($id));
        endif;

        $pdf = PDF::loadView('admin.emergency_services_vital_data.export', [
            'title' => $title,
            'mask' => $this->mask,
            'service_units' => ServiceUnits::find($emergency_services->IdServiceUnits),
            'users' => User::find($emergency_services->IdUsers),
            'users_responsible_sing' => User::find(auth()->user()->IdUsers),
            'emergency_services_vital_data' => ['data' => $emergency_services_vital_data->get(), 'count' => $emergency_services_vital_data->count()],
        ]);
        $pdf->add_info('Title', $title);
        return $pdf->stream();
    }
}
