<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EmergencyServicesFiles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Helpers\Mask;
use App\Helpers\Files;
use DB;
use Storage;

class EmergencyServicesFilesController extends Controller
{
    protected $emergency_services_files;
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
        $this->emergency_services_files = new EmergencyServicesFiles();
        $this->users = new User();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $IdEmergencyServices)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services_files = $this->emergency_services_files->list($IdEmergencyServices, $request->input('type'));

        return view('admin.emergency_services_files.list', [
            'mask' => $this->mask,
            'users' => $this->users,
            'emergency_services_files' => $emergency_services_files
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
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        EmergencyServicesFiles::create([
            'title' => $request->input('title'),
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'path' => Files::save($request, 'Filedata', "emergency_services_files/{$IdEmergencyServices}"),
            'IdEmergencyServices' => $IdEmergencyServices,
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdEmergencyServices, $IdEmergencyServicesFiles = null)
    {
        $emergency_services_files = $this->emergency_services_files->list_current(base64_decode($IdEmergencyServices));

        return view('admin.emergency_services_files.form', [
            'layout' => ['menu' => true, 'header' => true],
            'IdEmergencyServices' => $IdEmergencyServices,
            'emergency_services_files' => $emergency_services_files
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
        $emergency_services_files = EmergencyServicesFiles::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'text' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:1'],
        ]);
        
        if($validator->fails()):
            return redirect(route('emergency_services_files.form', ['type' => $data['type'], 'IdEmergencyServices' => $IdEmergencyServices]))->withErrors($validator)->withInput();
        endif;

        $emergency_services_files->text = $data['text'];
        $emergency_services_files->type = $data['type'];
        $emergency_services_files->IdEmergencyServices = $IdEmergencyServices;
        $emergency_services_files->save();
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
        EmergencyServicesFiles::find(base64_decode($id))->delete();
    }
}
