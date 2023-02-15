<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmergencyServicesMaterials;
use App\Models\EmergencyServicesService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Helpers\Mask;
use App\Models\Materials;
use App\Models\ServiceUnits;
use DB;

class EmergencyServicesMaterialsController extends Controller
{
    protected $emergency_services_materials;
    protected $service_units;
    protected $mask;
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->emergency_services_materials = new EmergencyServicesMaterials();
        $this->service_units = new ServiceUnits();
        $this->mask = new Mask();
        $this->users = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $IdEmergencyServices)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_materials = $this->emergency_services_materials->list($IdEmergencyServices, $request->input('type'));
        return view('admin.emergency_services_materials.list', [
            'mask' => $this->mask,
            'users' => $this->users,
            'IdEmergencyServices' => $IdEmergencyServices,
            'emergency_services_materials' => $emergency_services_materials
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
            'IdMaterials' => ['required', 'string'],
            'amount' => ['required', 'string'],
        ]);

        if($validator->fails()):
            return redirect(route('emergency_services_materials.form', ['IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        EmergencyServicesMaterials::create([
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdEmergencyServices' => base64_decode($IdEmergencyServices),
            'IdMaterials' => $request->input('IdMaterials'),
            'note' => $request->input('note'),
            'amount' => (!empty($request->input('amount'))) ? floatval(str_replace(',', '.', str_replace('.', '', $request->input('amount')))) : 0,
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdEmergencyServices, $IdEmergencyServicesMaterials = null)
    {
        $emergency_services_materials = $this->emergency_services_materials->list_current(base64_decode($IdEmergencyServicesMaterials));
        return view('admin.emergency_services_materials.form', [
            'IdEmergencyServices' => $IdEmergencyServices,
            'emergency_services_materials' => $emergency_services_materials
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
        $emergency_services_materials = EmergencyServicesMaterials::find(base64_decode($id));
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'amount' => ['required', 'string'],
        ]);

        if($validator->fails()):
            return redirect(route('emergency_services_materials.form', ['IdEmergencyServicesMaterials' => $id, 'IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        $emergency_services_materials->note = $data['note'];
        $emergency_services_materials->amount = (!empty($request->input('amount'))) ? floatval(str_replace(',', '.', str_replace('.', '', $request->input('amount')))) : 0;
        $emergency_services_materials->save();
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
        EmergencyServicesMaterials::find(base64_decode($id))->delete();
    }
}
