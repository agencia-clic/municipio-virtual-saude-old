<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmergencyServicesForward;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\EmergencyServices;
use App\Models\ServiceUnits;
use App\Helpers\Mask;
use App\Models\User;
use DB;
use PDF;

class EmergencyServicesForwardController extends Controller
{
    protected $emergency_services_forward;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->emergency_services_forward = new EmergencyServicesForward();
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

        $emergency_services_forward = $this->emergency_services_forward->list($IdEmergencyServices, $request->input('type'));
        return view('admin.emergency_services_forward.list', [
            'mask' => $this->mask,
            'emergency_services_forward' => $emergency_services_forward
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
            'IdProceduresForward' => ['required', 'string'],
        ]);

        if(!empty($data['date'])):
            $data['date'] = date('Y-m-d', strtotime($data['date']));
        endif;

        if($validator->fails()):
            return redirect(route('emergency_services_forward.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        EmergencyServicesForward::create([
            'IdEmergencyServices' => base64_decode($IdEmergencyServices),
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdProcedures' => $data['IdProceduresForward'],
            'IdSpecialtyCategories' => $data['IdSpecialtyCategories'],
            'note' => $data['note_forward'],
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdEmergencyServices, $IdEmergencyServicesForward = null)
    {
        $emergency_services_forward = $this->emergency_services_forward->list_current(base64_decode($IdEmergencyServicesForward));
        return view('admin.emergency_services_forward.form', [
            'emergency_services_forward' => $emergency_services_forward
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
        $emergency_services_forward = EmergencyServicesForward::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdProceduresForward' => ['required', 'string'],
            'IdUsersResponsibleForward' => ['required', 'string'],
        ]);

        if($validator->fails()):
            return redirect(route('emergency_services_forward.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;
      
        $emergency_services_forward->IdProcedures = $data['IdProceduresForward'];
        $emergency_services_forward->IdSpecialtyCategories = $data['IdSpecialtyCategories'];
        $emergency_services_forward->note = $data['note_forward'];
        $emergency_services_forward->save();
        
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
        EmergencyServicesForward::find(base64_decode($id))->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export_pdf($IdEmergencyServices, $id = null)
    {
        $title = 'Encaminhar Paciente';
        $emergency_services = EmergencyServices::find(base64_decode($IdEmergencyServices));

        $emergency_services_forward = EmergencyServicesForward::where('IdEmergencyServices', base64_decode($IdEmergencyServices))->
        select('emergency_services_forward.note', 'procedures.title', 'procedures.code', 'users_responsible.name as responsible', 'users_responsible.crm as responsible_crm', 'procedures.code', 'specialty_categories.title as specialty', 'specialty_categories.categorie as categorie')->
        
        join('users as users_responsible', 'emergency_services_forward.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        join('procedures', 'emergency_services_forward.IdProcedures', '=', 'procedures.IdProcedures')->join('specialty_categories', 'emergency_services_forward.IdSpecialtyCategories', '=', 'specialty_categories.IdSpecialtyCategories');

        if(!empty($id)):
            $emergency_services_forward = $emergency_services_forward->where('IdEmergencyServicesForward', base64_decode($id));
        endif;

        $pdf = PDF::loadView('admin.emergency_services_forward.export', [
            'title' => $title,
            'mask' => $this->mask,
            'service_units' => ServiceUnits::find($emergency_services->IdServiceUnits),
            'users' => User::find($emergency_services->IdUsers),
            'users_responsible_sing' => User::find(auth()->user()->IdUsers),
            'emergency_services_forward' => ['data' => $emergency_services_forward->get(), 'count' => $emergency_services_forward->count()],
        ]);
        $pdf->add_info('Title', $title);
        return $pdf->stream();
    }
}
