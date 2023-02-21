<?php

namespace App\Http\Controllers\Admin;

use App\Events\channelEmergencyServices;
use Illuminate\Http\Request;
use App\Models\EmergencyServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Helpers\Mask;

class EmergencyServicesController extends Controller
{
    protected $emergency_services;
    protected $emergency_services_vital_data;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->emergency_services = new EmergencyServices();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $data['status'] = "a";

        return view('admin.emergency_services.list', [
            'title' => " Atendimentos | ".env('APP_NAME'),
            'emergency_services' => $this->emergency_services->list($data),
            'mask' => $this->mask,
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
        $data['status'] = "a";

        return view('admin.emergency_services.table', [
            'emergency_services' => $this->emergency_services->list($data),
            'mask' => $this->mask,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'provenance' => ['required', 'string', 'max:255'],
            'character' => ['required', 'string', 'max:255'],
            'forwarding' => ['required', 'string', 'max:255'],
            'accident_work' => ['required', 'string', 'max:255'],
            'identified_patient' => ['required', 'string', 'max:255'],
            'types' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);

        if($validator->fails()):
            return redirect(route('emergency_services.form'))->withErrors($validator)->withInput();
        endif;

        //users not
        if($request->input('identified_patient') == 'n'):
            $users = User::create([
                'name' => 'NÃO IDENTIFICADO - ATENDIMENTO()',
                'status' => 'a',
                'level' => 'p',
            ]);

            $data['IdUsers'] = $users->IdUsers;
        endif;

        $emergency_services = EmergencyServices::create([
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'IdUsers' => $data['IdUsers'],
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'users_description' => $data['users_description'],
            'types' => $data['types'],
            'users_date_birth_identified' => $data['users_date_birth_identified'],
            'users_sex' => $data['users_sex'],
            'forwarding' => $data['forwarding'],
            'forwarding_uf' => $data['forwarding_uf'],
            'forwarding_county' => $data['forwarding_county'],
            'forwarding_number' => $data['forwarding_number'],
            'provenance' => $data['provenance'],
            'character' => $data['character'],
            'accident_work' => $data['accident_work'],
            'note' => $data['note'],
            'identified_patient' => $request->input('identified_patient'),
            'escort_name' => $data['escort_name'],
            'escort_phone' => $data['escort_phone'],
            'kinship' => $data['kinship'],
            'status' => $data['status'],
        ]);

        //users not
        if($request->input('identified_patient') == 'n'):

            $user = User::find($users->IdUsers);
            $user->name = "NÃO IDENTIFICADO - ATENDIMENTO({$emergency_services->IdEmergencyServices})";
            $user->save();
        endif;

        //broadcast
        channelEmergencyServices::dispatch(auth()->user()->units_current()->IdServiceUnits, $emergency_services->IdEmergencyServices);

        //modal
        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('emergency_services.form');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdEmergencyServices = null)
    {
        $emergency_services = $this->emergency_services->list_current(base64_decode($IdEmergencyServices));

        return view('admin.emergency_services.form', [
            'title' => " Atendimentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'emergency_services' => $emergency_services
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = base64_decode($id);
        $emergency_services = EmergencyServices::find($id);
        $data = $request->all();

        $validator = Validator::make($data, [
            'provenance' => ['required', 'string', 'max:255'],
            'character' => ['required', 'string', 'max:255'],
            'forwarding' => ['required', 'string', 'max:255'],
            'accident_work' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('emergency_services.form', ['IdEmergencyServices' => base64_encode($emergency_services->IdEmergencyServices)]))->withErrors($validator)->withInput();
        endif;

        $emergency_services->IdUsersResponsibleMedicare = null;
        $emergency_services->users_description = $data['users_description'];
        $emergency_services->users_date_birth_identified = $data['users_date_birth_identified'];
        $emergency_services->types = $data['types'];
        $emergency_services->users_sex = $data['users_sex'];
        $emergency_services->forwarding = $data['forwarding'];
        $emergency_services->forwarding_uf = $data['forwarding_uf'];
        $emergency_services->forwarding_county = $data['forwarding_county'];
        $emergency_services->forwarding_number = $data['forwarding_number'];
        $emergency_services->provenance = $data['provenance'];
        $emergency_services->character = $data['character'];
        $emergency_services->accident_work = $data['accident_work'];
        $emergency_services->note = $data['note'];
        $emergency_services->status = $data['status'];
        $emergency_services->escort_name = $data['escort_name'];
        $emergency_services->kinship = $data['kinship'];
        $emergency_services->escort_phone = $data['escort_phone'];
        
        $emergency_services->save();

        //broadcast
        channelEmergencyServices::dispatch(auth()->user()->units_current()->IdServiceUnits, $id);
        
        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('emergency_services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = base64_decode($id);

        //broadcast
        channelEmergencyServices::dispatch(auth()->user()->units_current()->IdServiceUnits, $id);
        
        $emergency_services = EmergencyServices::find($id);
        $emergency_services->status = "c";
        $emergency_services->cancellation_justification = $request->input('cancellation_justification');
        $emergency_services->save();

        return "success";
    }

    public function historic($IdEmergencyServices)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $emergency_services = EmergencyServices::find($IdEmergencyServices);

        return view('admin.emergency_services.historic', [
            'emergency_services_historic' => $this->emergency_services->list_historic(['IdUsers' => $emergency_services->IdUsers, 'status' => 'b']),
        ]);
    }
}
