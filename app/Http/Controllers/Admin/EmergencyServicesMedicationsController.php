<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmergencyServicesMedications;
use App\Models\MedicationGroups;
use App\Http\Controllers\Controller;
use App\Models\EmergencyServices;
use App\Models\EmergencyServicesMedicationChecks;
use Illuminate\Support\Facades\Validator;
use App\Models\ServiceUnits;
use App\Helpers\Mask;
use App\Models\User;
use App\Models\Medicines;
use PDF;
use DB;

class EmergencyServicesMedicationsController extends Controller
{
    protected $emergency_services_medications;
    protected $medication;
    protected $mask;
    protected $users;
    protected $medication_groups;
    protected $emergency_services_medication_checks;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->emergency_services_medications = new EmergencyServicesMedications();
        $this->medication = new Medicines();
        $this->mask = new Mask();
        $this->users = new User();
        $this->medication_groups = new MedicationGroups();
        $this->emergency_services_medication_checks = new EmergencyServicesMedicationChecks();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($IdEmergencyServices, $IdMedicationGroups = null)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services = EmergencyServices::where('IdEmergencyServices', $IdEmergencyServices)->first();

        return view('admin.emergency_services_medications.list', [
            'mask' => $this->mask,
            'users' => $this->users,
            'layout' => ['menu' => true, 'header' => true],
            'IdEmergencyServices' => base64_encode($IdEmergencyServices),
            'IdMedicationGroups' => $IdMedicationGroups,
            'emergency_services' =>  $emergency_services,
            'medication_groups' => $this->medication_groups->list_current(base64_decode($IdMedicationGroups)),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check_list(Request $request, $IdEmergencyServices)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        return view('admin.emergency_services_medications.list-run', [
            'mask' => $this->mask,
            'medication_groups' => $this->medication_groups->list_check($IdEmergencyServices),
            'users' => $this->users,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check($IdEmergencyServices, $IdMedicationGroups)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        return view('admin.emergency_services_medications.check', [
            'mask' => $this->mask,
            'users' => $this->users,
            'layout' => ['menu' => true, 'header' => true],
            'medication_groups' => $this->medication_groups->list_current(base64_decode($IdMedicationGroups)),
            'IdEmergencyServices' => base64_encode($IdEmergencyServices),
            'IdMedicationGroups' => $IdMedicationGroups,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table($IdEmergencyServices, $IdMedicationGroups = null)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_medications = $this->emergency_services_medications->list($IdEmergencyServices, base64_decode($IdMedicationGroups));

        return view('admin.emergency_services_medications.table', [
            'mask' => $this->mask,
            'IdEmergencyServices' => base64_encode($IdEmergencyServices),
            'IdMedicationGroups' => $IdMedicationGroups,
            'emergency_services_medications' => $emergency_services_medications
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table_ckeck($IdEmergencyServices, $IdMedicationGroups)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $data['status'] = "a";
        $emergency_services_medications = $this->emergency_services_medications->list($IdEmergencyServices, base64_decode($IdMedicationGroups), $data);

        return view('admin.emergency_services_medications.table-check', [
            'mask' => $this->mask,
            'users' => $this->users,
            'IdEmergencyServices' => base64_encode($IdEmergencyServices),
            'IdMedicationGroups' => $IdMedicationGroups,
            'emergency_services_medications' => $emergency_services_medications
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table_form($IdEmergencyServicesMedications)
    {
        return view('admin.emergency_services_medications.table-form', [
            'IdEmergencyServicesMedications' => $IdEmergencyServicesMedications
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_check($IdEmergencyServices, $IdEmergencyServicesMedications)
    {
        return view('admin.emergency_services_medications.update-check', [
            'users' => $this->users,
            'emergency_services' =>   EmergencyServices::where('IdEmergencyServices', base64_decode($IdEmergencyServices))->first(),
            'emergency_services_medications' => $this->emergency_services_medications->list_current(base64_decode($IdEmergencyServicesMedications)),
            'IdEmergencyServicesMedications' => $IdEmergencyServicesMedications,
            'IdEmergencyServices' => $IdEmergencyServices,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check_send_update(Request $request, $IdEmergencyServices, $IdEmergencyServicesMedications)
    {
        $emergency_services_medications = EmergencyServicesMedications::find(base64_decode($IdEmergencyServicesMedications));

        //Finalizar
        if($request->input('action') == "f"):

            $emergency_services_medications->status = "b";
            $emergency_services_medications->IdUsersResponsibleCheckEdite = auth()->user()->IdUsers;
            $emergency_services_medications->note_finalize = $request->input('note_finalize');
            $emergency_services_medications->save();

        elseif($request->input('action') == "mf"):

            $emergency_services_medications->status = "bf";
            $emergency_services_medications->IdUsersResponsibleCheckEdite = auth()->user()->IdUsers;
            $emergency_services_medications->save();

        elseif($request->input('action') == "pnm"):

            $emergency_services_medications->status = "bn";
            $emergency_services_medications->IdUsersResponsibleCheckEdite = auth()->user()->IdUsers;
            $emergency_services_medications->note_denied_medication = $request->input('note_denied_medication');
            $emergency_services_medications->save();
            return route('emergency_services_medications.denied.medication.export', ['IdEmergencyServices' => $IdEmergencyServices, 'IdEmergencyServicesMedications' => $IdEmergencyServicesMedications]);

        elseif($request->input('action') == "sm"):

            $emergency_services_medications->status = "bs";
            $emergency_services_medications->IdUsersResponsibleCheckEdite = auth()->user()->IdUsers;
            $emergency_services_medications->save();
            $emergency_services_medications_list = $this->emergency_services_medications->list_current(base64_decode($IdEmergencyServicesMedications));

            EmergencyServicesMedications::create([
                'status' => 'a',
                'IdEmergencyServices' => base64_decode($IdEmergencyServices),
                'IdMedicines' => $request->input('IdMedicines'),
                'IdMedicationGroups' => $emergency_services_medications_list->IdMedicationGroups,
                'IdUsersResponsible' => auth()->user()->IdUsers,
                'type' => $request->input('type'),
                'guidance' => $request->input('guidance'),
                'number_time_day' => $request->input('number_time_day'),
                'break' =>  ($request->input('type') != "f") ? "{$request->input('brack')}:00" : $this->convertHours((!empty( $request->input('number_time_day'))) ? 24 / $request->input('number_time_day') : 0),
                'IdMedicationAdministrations' => $request->input('IdMedicationAdministrations'),
                'infusao' => $request->input('infusao'),
                'IdMedicationDilutions' => $request->input('IdMedicationDilutions'),
                'amount' => (!empty($request->input('amount'))) ? floatval(str_replace(',', '.', str_replace('.', '', $request->input('amount')))) : 0,
                'un_measure' => $request->input('un_measure'),
            ]);

        elseif($request->input('action') == "aip"):

            $emergency_services_medications_list = $this->emergency_services_medications->list_current(base64_decode($IdEmergencyServicesMedications));
            $b = ((date('H', strtotime($emergency_services_medications_list->break)) * 60) * 60);
            $b =+ (date('i', strtotime($emergency_services_medications_list->break)) * 60);

            EmergencyServicesMedicationChecks::create([
                'type' => "a",
                'IdEmergencyServicesMedications' => base64_decode($IdEmergencyServicesMedications),
                'IdEmergencyServices' => base64_decode($IdEmergencyServices),
                'IdUsersResponsible' => auth()->user()->IdUsers,
                'created_at' => date('Y-m-d H:i:s', strtotime("{$request->input('schedule_date')} {$request->input('schedule_date_hour')}:00") - $b),
            ]);

        endif;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check_admin($IdEmergencyServices, $IdMedicationGroups)
    {
        return view('admin.emergency_services_medications.check-admin', [
            'IdEmergencyServices' => $IdEmergencyServices,
            'IdMedicationGroups' => $IdMedicationGroups,
            'users' => $this->users,
            'emergency_services_medication_checks' => $this->emergency_services_medication_checks->list(base64_decode($IdEmergencyServices), base64_decode($IdMedicationGroups)),
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check_save(Request $request, $IdEmergencyServices, $IdMedicationGroups)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $IdMedicationGroups = base64_decode($IdMedicationGroups);

        if(!empty($request->input('IdEmergencyServicesMedications'))):

            foreach($request->input('IdEmergencyServicesMedications') as $val):
                EmergencyServicesMedicationChecks::create([
                    'type' => 'c',
                    'IdEmergencyServicesMedications' => $val,
                    'IdEmergencyServices' => $IdEmergencyServices,
                    'IdUsersResponsible' => auth()->user()->IdUsers,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                $emergency_services_medications = EmergencyServicesMedications::where('IdEmergencyServicesMedications', $val)->first();

                if($emergency_services_medications != null):

                    if($emergency_services_medications->type == "u"):

                        $emergency_services_medications_update = EmergencyServicesMedications::find($val);
                        $emergency_services_medications_update->status = 'b';
                        $emergency_services_medications_update->save();
                    
                    endif;

                endif;

            endforeach;

        endif;

        return "success";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdEmergencyServices, $IdMedicationGroups = null)
    {
        $data = $request->all();

        if(empty($IdMedicationGroups) AND (!empty($request->input('IdMedicines')))):

            $medication_groups = MedicationGroups::create([
                'IdEmergencyServices' => base64_decode($IdEmergencyServices),
                'IdUsersResponsible' => auth()->user()->IdUsers,
                'note' => $request->input('note')
            ]);

            $IdMedicationGroups = $medication_groups->IdMedicationGroups;
        elseif(!empty($IdMedicationGroups)):
            $IdMedicationGroups = base64_decode($IdMedicationGroups);

            $medication_groups = MedicationGroups::find($IdMedicationGroups);
            $medication_groups->note = $request->input('note');
            $medication_groups->save();
        endif;

        if(empty($request->input('IdEmergencyServicesMedications')) AND (!empty($request->input('IdMedicines')))):

            EmergencyServicesMedications::create([
                'status' => 'a',
                'IdEmergencyServices' => base64_decode($IdEmergencyServices),
                'IdMedicines' => $data['IdMedicines'],
                'IdMedicationGroups' => $IdMedicationGroups,
                'IdUsersResponsible' => auth()->user()->IdUsers,
                'type' => $request->input('type'),
                'guidance' => $request->input('guidance'),
                'number_time_day' => $request->input('number_time_day'),
                'break' =>  ($request->input('type') != "f") ? "{$request->input('brack')}:00" : $this->convertHours((!empty( $request->input('number_time_day'))) ? 24 / $request->input('number_time_day') : 0),
                'IdMedicationAdministrations' => $request->input('IdMedicationAdministrations'),
                'infusao' => $request->input('infusao'),
                'IdMedicationDilutions' => $request->input('IdMedicationDilutions'),
                'amount' => (!empty($request->input('amount'))) ? floatval(str_replace(',', '.', str_replace('.', '', $request->input('amount')))) : 0,
                'un_measure' => $request->input('un_measure'),
            ]);

        elseif(!empty($request->input('IdMedicines'))):

            $emergency_ervices_medication = EmergencyServicesMedications::find($request->input('IdEmergencyServicesMedications'));
            $emergency_ervices_medication->IdMedicines = $request->input('IdMedicines');
            $emergency_ervices_medication->type = $request->input('type');
            $emergency_ervices_medication->guidance = $request->input('guidance');
            $emergency_ervices_medication->number_time_day = $data['number_time_day'];
            $emergency_ervices_medication->break = ($request->input('type') != "f") ? "{$request->input('brack')}:00" : $this->convertHours((!empty( $request->input('number_time_day'))) ? 24 / $request->input('number_time_day') : 0);
            $emergency_ervices_medication->IdMedicationAdministrations = $request->input('IdMedicationAdministrations');
            $emergency_ervices_medication->infusao = $request->input('infusao');
            $emergency_ervices_medication->IdMedicationDilutions = $request->input('IdMedicationDilutions');
            $emergency_ervices_medication->amount = (!empty($request->input('amount'))) ? floatval(str_replace(',', '.', str_replace('.', '', $request->input('amount')))) : 0;
            $emergency_ervices_medication->un_measure = $request->input('un_measure');
            $emergency_ervices_medication->save();

        endif;

        return json_encode([
            'table' => route('emergency_services_medications.table', ['IdEmergencyServices' => $IdEmergencyServices,'IdMedicationGroups' => base64_encode($IdMedicationGroups)]),
            'create' => route('emergency_services_medications.form.create', ['IdEmergencyServices' => $IdEmergencyServices, 'IdMedicationGroups' => base64_encode($IdMedicationGroups)])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_data(Request $request, $IdEmergencyServices, $IdEmergencyServicesMedications)
    {
        $data = EmergencyServicesMedications::where('IdEmergencyServicesMedications', $IdEmergencyServicesMedications)->first()->toArray();
        if(!empty($data)):
            $data['break'] = date('H:i', strtotime($data['break']));
            $data['amount'] = number_format($data['amount'], 2, ",", ".");
        endif;
        return json_encode($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmergencyServicesMedications::find(base64_decode($id))->delete();
    }

    private function convertHours($a) {

        $format = '%02d:%02d';
        $m = $a * 60;
        $h = floor($m / 60);
        $m = ($m % 60);
        return sprintf($format, $h, $m).":00";
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function check_history($IdEmergencyServices)
    {
        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        $IdEmergencyServicesOld = array();
        if(!empty($emergency_services->IdEmergencyServicesOld)):
            $IdEmergencyServicesOld = explode(',', $emergency_services->IdEmergencyServicesOld);
        endif;
        $IdEmergencyServicesOld[] = $emergency_services->IdEmergencyServices;
        $medication_groups = MedicationGroups::select('medication_groups.*', 'users_responsible.name as responsible')->whereIn('medication_groups.IdEmergencyServices', $IdEmergencyServicesOld)->
        leftjoin('users as users_responsible', 'medication_groups.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        join('emergency_services_medications', 'medication_groups.IdMedicationGroups', '=', 'emergency_services_medications.IdMedicationGroups')->
        join('emergency_services_medication_checks', 'emergency_services_medications.IdEmergencyServicesMedications', '=', 'emergency_services_medication_checks.IdEmergencyServicesMedications')->
        groupBy('medication_groups.IdMedicationGroups')->
        get();

        return view('admin.emergency_services_medications.check_history', [
            'medication_groups' => $medication_groups,
            'users' => $this->users,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export_pdf($IdEmergencyServices, $IdMedicationGroups)
    {
        $title = 'Prescrição';
        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $medication_groups = MedicationGroups::find(base64_decode($IdMedicationGroups));
        $emergency_services_medications = $this->emergency_services_medications->list($IdEmergencyServices, base64_decode($IdMedicationGroups));

        $pdf = PDF::loadView('admin.emergency_services_medications.export', [
            'title' => $title,
            'mask' => $this->mask,
            'service_units' => ServiceUnits::find($emergency_services->IdServiceUnits),
            'users_responsible_sing' => User::find($medication_groups->IdUsersResponsible),
            'users' => User::find($emergency_services->IdUsers),
            'medication_groups' => $medication_groups,
            'emergency_services_medications' => $emergency_services_medications,
        ]);
        $pdf->add_info('Title', $title);
        return $pdf->stream();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function denied_medication_export($IdEmergencyServices, $IdEmergencyServicesMedications)
    {
        $title = 'Termo de recusa de Tratamento';
        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $IdEmergencyServicesMedications = base64_decode($IdEmergencyServicesMedications);
        $emergency_services_medications = EmergencyServicesMedications::select('medicines.title', 'emergency_services_medications.note_denied_medication')->
        join('medicines', 'emergency_services_medications.IdMedicines', '=', 'medicines.IdMedicines')->find($IdEmergencyServicesMedications);

        $pdf = PDF::loadView('admin.emergency_services_medications.export_denied_medication', [
            'title' => $title,
            'mask' => $this->mask,
            'service_units' => ServiceUnits::find($emergency_services->IdServiceUnits),
            'users' => User::find($emergency_services->IdUsers),
            'emergency_services_medications' => $emergency_services_medications,
        ]);
        $pdf->add_info('Title', $title);
        return $pdf->stream();
    }
}