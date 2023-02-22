<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmergencyServicesProcedures;
use App\Models\ProceduresGroups;
use App\Models\EmergencyServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Procedures;
use App\Models\ServiceUnits;
use PDF;
use DB;

class EmergencyServicesProceduresController extends Controller
{
    protected $emergency_services_procedures;
    protected $procedures;
    protected $users;
    protected $procedures_groups;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->emergency_services_procedures = new EmergencyServicesProcedures();
        $this->procedures = new Procedures();
        $this->users = new User();
        $this->procedures_groups = new ProceduresGroups();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($IdEmergencyServices, $IdProceduresGroups = null)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        return view('admin.emergency_services_procedures.list', [
            'users' => $this->users,
            'layout' => ['menu' => true, 'header' => true],
            'IdEmergencyServices' => base64_encode($IdEmergencyServices),
            'IdProceduresGroups' => $IdProceduresGroups,
            'procedures_groups' => $this->procedures_groups->list_current(base64_decode($IdProceduresGroups)),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function run_list(Request $request)
    {
        $data = $request->all();
        $data['status'] = $request->input('status') ?? "open";

        return view('admin.emergency_services_procedures.list-run', [
            'procedures_groups' => $this->procedures_groups->list_run($data),
            'users' => $this->users,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function run($IdEmergencyServices, $IdProceduresGroups = null)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        return view('admin.emergency_services_procedures.run', [
            'users' => $this->users,
            'layout' => ['menu' => true, 'header' => true],
            'IdEmergencyServices' => base64_encode($IdEmergencyServices),
            'IdProceduresGroups' => $IdProceduresGroups,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table($IdEmergencyServices, $IdProceduresGroups = null)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_procedures = $this->emergency_services_procedures->list($IdEmergencyServices, base64_decode($IdProceduresGroups));

        return view('admin.emergency_services_procedures.table', [
            'IdEmergencyServices' => base64_encode($IdEmergencyServices),
            'IdProceduresGroups' => $IdProceduresGroups,
            'emergency_services_procedures' => $emergency_services_procedures
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table_run($IdEmergencyServices, $IdProceduresGroups = null)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_procedures = $this->emergency_services_procedures->list($IdEmergencyServices, base64_decode($IdProceduresGroups));

        return view('admin.emergency_services_procedures.table-run', [
            'users' => $this->users,
            'IdEmergencyServices' => base64_encode($IdEmergencyServices),
            'IdProceduresGroups' => $IdProceduresGroups,
            'emergency_services_procedures' => $emergency_services_procedures
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table_form($IdEmergencyServicesProcedures)
    {
        return view('admin.emergency_services_procedures.table-form', [
            'IdEmergencyServicesProcedures' => $IdEmergencyServicesProcedures
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function run_save(Request $request, $IdEmergencyServicesProcedures)
    {
        $IdEmergencyServicesProcedures = base64_decode($IdEmergencyServicesProcedures);
        $emergency_services_procedures = EmergencyServicesProcedures::find($IdEmergencyServicesProcedures);
        $emergency_services_procedures->status = $request->input('status');
        $emergency_services_procedures->IdUsersResponsibleRunProcedures = $request->input('IdUsersResponsibleRunProcedures');
        $emergency_services_procedures->medical_report = $request->input('medical_report');
        $emergency_services_procedures->date_run = date('Y-m-d H:i', strtotime($request->input('date')));
        $emergency_services_procedures->note_refused = $request->input('note_refused');
        $emergency_services_procedures->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdEmergencyServices, $IdProceduresGroups = null)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdProcedures' => ['required', 'string', 'max:11'],
        ]);

        if(empty($IdProceduresGroups)):

            $procedures_groups = ProceduresGroups::create([
                'IdEmergencyServices' => base64_decode($IdEmergencyServices),
                'IdUsersResponsible' => auth()->user()->IdUsers,
            ]);

            $IdProceduresGroups = $procedures_groups->IdProceduresGroups;
        elseif(!empty($IdProceduresGroups)):
            $IdProceduresGroups = base64_decode($IdProceduresGroups);
        endif;

        if(empty($request->input('IdEmergencyServicesProcedures'))):

            EmergencyServicesProcedures::create([
                'status' => 'open',
                'IdProcedures' => $data['IdProcedures'],
                'IdProceduresGroups' => $IdProceduresGroups,
                'IdUsersResponsible' => auth()->user()->IdUsers,
                'note' => $data['note'],
                'IdEmergencyServices' => base64_decode($IdEmergencyServices),
            ]);

        else:

            $emergency_ervices_procedures = EmergencyServicesProcedures::find($request->input('IdEmergencyServicesProcedures'));
            $emergency_ervices_procedures->IdProcedures = $request->input('IdProcedures');
            $emergency_ervices_procedures->note = $data['note'];
            $emergency_ervices_procedures->save();

        endif;

        return json_encode([
            'table' => route('emergency_services_procedures.table', ['IdEmergencyServices' => $IdEmergencyServices,'IdProceduresGroups' => base64_encode($IdProceduresGroups)]),
            'create' => route('emergency_services_procedures.form.create', ['IdEmergencyServices' => $IdEmergencyServices, 'IdProceduresGroups' => base64_encode($IdProceduresGroups)])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_data(Request $request, $IdEmergencyServices, $IdEmergencyServicesProcedures)
    {
        $data = $request->all();
        return json_encode(EmergencyServicesProcedures::where('IdEmergencyServicesProcedures', $IdEmergencyServicesProcedures)->first()->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmergencyServicesProcedures::find(base64_decode($id))->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export_procedures($IdEmergencyServices, $IdProceduresGroups)
    {
        $title = 'LAUDO PARA SOLICITAÇÃO/AUTORIZAÇÃO DE PROCEDIMENTO AMBULATORIAL';
        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $IdProceduresGroups = base64_decode($IdProceduresGroups);
        $emergency_services_procedures = EmergencyServicesProcedures::where('IdProceduresGroups', $IdProceduresGroups)->select('title','code')->join('procedures', 'emergency_services_procedures.IdProcedures', '=', 'procedures.IdProcedures')->get();

        $procedures_groups = ProceduresGroups::find($IdProceduresGroups);

        $pdf = PDF::loadView('admin.emergency_services_procedures.export-group', [
            'title' => $title,
            'procedures_groups' => $procedures_groups,
            'IdEmergencyServices' => $IdEmergencyServices,
            'emergency_services_procedures' => $emergency_services_procedures,
            'users_responsible' => User::find(auth()->user()->IdUsers),
            'service_units' => ServiceUnits::find($emergency_services->IdServiceUnits),
            'emergency_services' => $emergency_services,
            'users_paciente' => User::find($emergency_services->IdUsers),
            'users_' => User::find($emergency_services->IdUsers),
        ]);
        $pdf->add_info('Title', $title);
        return $pdf->stream();
    }
}
