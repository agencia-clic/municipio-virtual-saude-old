<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmergencyServicesForwardInternal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\EmergencyServices;
use App\Models\ServiceUnits;
use App\Helpers\Mask;
use App\Models\User;
use App\Models\MedicalSpecialties;
use DB;
use PDF;

class EmergencyServicesForwardInternalController extends Controller
{
    protected $emergency_services_forward_internal;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->emergency_services_forward_internal = new EmergencyServicesForwardInternal();
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

        $emergency_services_forward_internal = $this->emergency_services_forward_internal->list($IdEmergencyServices, $request->input('type'));
        return view('admin.emergency_services_forward_internal.list', [
            'mask' => $this->mask,
            'emergency_services_forward_internal' => $emergency_services_forward_internal
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
            'IdMedicalSpecialties' => ['required', 'string'],
            'type_forward_internal' => ['required', 'string'],
        ]);

        if($validator->fails()):
            return redirect(route('emergency_services_forward_internal.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        EmergencyServicesForwardInternal::create([
            'status' => 'a',
            'type' => $data['type_forward_internal'],
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'IdEmergencyServices' => base64_decode($IdEmergencyServices),
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdMedicalSpecialties' => $data['IdMedicalSpecialties'],
            'note' => $data['note_forward_internal'],
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdEmergencyServices, $IdEmergencyServicesForwardInternal = null)
    {
        $emergency_services_forward_internal = $this->emergency_services_forward_internal->list_current(base64_decode($IdEmergencyServicesForwardInternal));
        return view('admin.emergency_services_forward_internal.form', [
            'medical_specialties' => MedicalSpecialties::where('status', 'a')->get(),
            'emergency_services_forward_internal' => $emergency_services_forward_internal
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
        $emergency_services_forward_internal = EmergencyServicesForwardInternal::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdMedicalSpecialties' => ['required', 'string'],
        ]);

        if($validator->fails()):
            return redirect(route('emergency_services_forward_internal.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;
      
        $emergency_services_forward_internal->type = $data['type_forward_internal'];
        $emergency_services_forward_internal->IdMedicalSpecialties = $data['IdMedicalSpecialties'];
        $emergency_services_forward_internal->note = $data['note_forward_internal'];

        $emergency_services_forward_internal->save();
        
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
        EmergencyServicesForwardInternal::find(base64_decode($id))->delete();
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

        $emergency_services_forward_internal = EmergencyServicesForwardInternal::where('IdEmergencyServices', base64_decode($IdEmergencyServices))->
        select('emergency_services_forward_internal.note', 'procedures.title', 'procedures.code', 'users_responsible.name as responsible', 'users_responsible.crm as responsible_crm', 'procedures.code', 'specialty_categories.title as specialty', 'specialty_categories.categorie as categorie')->
        
        join('users as users_responsible', 'emergency_services_forward_internal.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        join('procedures', 'emergency_services_forward_internal.IdProcedures', '=', 'procedures.IdProcedures')->join('specialty_categories', 'emergency_services_forward_internal.IdSpecialtyCategories', '=', 'specialty_categories.IdSpecialtyCategories');

        if(!empty($id)):
            $emergency_services_forward_internal = $emergency_services_forward_internal->where('IdEmergencyServicesForwardInternal', base64_decode($id));
        endif;

        $pdf = PDF::loadView('admin.emergency_services_forward_internal.export', [
            'title' => $title,
            'mask' => $this->mask,
            'service_units' => ServiceUnits::find($emergency_services->IdServiceUnits),
            'users' => User::find($emergency_services->IdUsers),
            'users_responsible_sing' => User::find(auth()->user()->IdUsers),
            'emergency_services_forward_internal' => ['data' => $emergency_services_forward_internal->get(), 'count' => $emergency_services_forward_internal->count()],
        ]);
        $pdf->add_info('Title', $title);
        return $pdf->stream();
    }
}
