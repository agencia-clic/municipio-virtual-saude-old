<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmergencyServicesPrescriptions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\EmergencyServices;
use App\Models\ServiceUnits;
use App\Models\User;
use App\Helpers\Mask;
use PDF;
use DB;

class EmergencyServicesPrescriptionsController extends Controller
{
    protected $emergency_services_prescriptions;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->emergency_services_prescriptions = new EmergencyServicesPrescriptions();
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

        $emergency_services_prescriptions = $this->emergency_services_prescriptions->list($IdEmergencyServices, $request->input('type'));
        return view('admin.emergency_services_prescriptions.list', [
            'mask' => $this->mask,
            'emergency_services_prescriptions' => $emergency_services_prescriptions
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
            'note_prescription' => ['required', 'string'],
            'type_medication' => ['required', 'string'],
        ]);

        if(!empty($data['date'])):
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        endif;

        if($validator->fails()):
            return redirect(route('emergency_services_prescriptions.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        EmergencyServicesPrescriptions::create([
            'IdEmergencyServices' => base64_decode($IdEmergencyServices),
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdMedicationPrescriptions' => $data['IdMedicationPrescription'],
            'IdMedicationUnits' => $data['IdMedicationUnits'],
            'IdMedicationAdministrations' => $data['IdMedicationAdministrations'],
            'type' => $data['type_medication'],
            'note' => $data['note_prescription'],
            'amount' => $data['amount'],
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdEmergencyServices, $IdEmergencyServicesPrescriptions = null)
    {
        $emergency_services_prescriptions = $this->emergency_services_prescriptions->list_current(base64_decode($IdEmergencyServicesPrescriptions));
        return view('admin.emergency_services_prescriptions.form', [
            'emergency_services_prescriptions' => $emergency_services_prescriptions
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
        $emergency_services_prescriptions = EmergencyServicesPrescriptions::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'note_prescription' => ['required', 'string'],
            'type_medication' => ['required', 'string'],
        ]);

        if($validator->fails()):
            return redirect(route('emergency_services_prescriptions.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;
      
        $emergency_services_prescriptions->IdMedicationPrescriptions = $data['IdMedicationPrescription'];
        $emergency_services_prescriptions->IdMedicationUnits = $data['IdMedicationUnits'];
        $emergency_services_prescriptions->IdMedicationAdministrations = $data['IdMedicationAdministrations'];
        $emergency_services_prescriptions->type = $data['type_medication'];
        $emergency_services_prescriptions->note = $data['note_prescription'];
        $emergency_services_prescriptions->amount = $data['amount'];
        $emergency_services_prescriptions->save();
        
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
        EmergencyServicesPrescriptions::find(base64_decode($id))->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export_pdf(Request $request, $IdEmergencyServices, $id = null)
    {
        $title = 'Receituário Médico';
        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        $emergency_services_prescriptions = EmergencyServicesPrescriptions::where('IdEmergencyServices', base64_decode($IdEmergencyServices))->
        select('emergency_services_prescriptions.*', 'medication_prescriptions.title as prescriptions', 'medication_administrations.title as administrations', 'medication_units.title as units', 'users_responsible.name as responsible', 'users_responsible.crm as responsible_crm')->
        join('users as users_responsible', 'emergency_services_prescriptions.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        leftjoin('medication_units', 'emergency_services_prescriptions.IdMedicationUnits', '=', 'medication_units.IdMedicationUnits')->
        leftjoin('medication_administrations', 'emergency_services_prescriptions.IdMedicationAdministrations', '=', 'medication_administrations.IdMedicationAdministrations')->
        leftjoin('medication_prescriptions', 'emergency_services_prescriptions.IdMedicationPrescriptions', '=', 'medication_prescriptions.IdMedicationPrescriptions');

        if(!empty($id)):
            $emergency_services_prescriptions = $emergency_services_prescriptions->where('IdEmergencyServicesPrescriptions', base64_decode($id));
        endif;

        if(!empty($request->input('type'))):
            $emergency_services_prescriptions = $emergency_services_prescriptions->where('type', $request->input('type'));
        endif;

        $pdf = PDF::loadView('admin.emergency_services_prescriptions.export', [
            'title' => $title,
            'mask' => $this->mask,
            'service_units' => ServiceUnits::find($emergency_services->IdServiceUnits),
            'users' => User::find($emergency_services->IdUsers),
            'users_responsible_sing' => User::find(auth()->user()->IdUsers),
            'emergency_services_prescriptions' => ['data' => $emergency_services_prescriptions->get(), 'count' => $emergency_services_prescriptions->count()],
        ]);
        $pdf->add_info('Title', $title);
        return $pdf->stream();
    }
}
