<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServiceUnits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use Illuminate\Support\Facades\Cookie;
use DB;

class ServiceUnitsController extends Controller
{
    protected $service_units;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->service_units = new ServiceUnits();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service_units = $this->service_units->list($request);

        return view('admin.service_units.list', [
            'title' => " Unidades | ".env('APP_NAME'),
            'service_units' => $service_units,
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
            'name' => ['required', 'string', 'max:255'],
            'acronym' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:service_units'],
            'IdUsers' => ['required', 'string', 'max:11'],
            'phone' => ['required', 'string', 'max:15'],
            'zip_code' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'uf' => ['required', 'string', 'max:5'],
        ]);

        if($validator->fails()):
            return redirect(route('service_units.form'))->withErrors($validator)->withInput();
        endif;

        ServiceUnits::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'acronym' => $data['acronym'],
            'IdUsers' => $data['IdUsers'],
            'email' => $data['email'],
            'status' => $data['status'],
            'phone' => preg_replace('/[^0-9]/', '', $data['phone']),
            'zip_code' => $data['zip_code'],
            'address' => $data['address'],
            'number' => $data['number'],
            'district' => $data['district'],
            'city' => $data['city'],
            'uf' => $data['uf'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('service_units');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdServiceUnits = null)
    {
        $service_units = $this->service_units->list_current(base64_decode($IdServiceUnits));

        return view('admin.service_units.form', [
            'title' => " Unidades | ".env('APP_NAME'),
            'service_units' => $service_units
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
        $user = ServiceUnits::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'acronym' => ['required', 'string', 'max:255'],
            'email' => "required|email|unique:service_units,email,{$user->IdServiceUnits},IdServiceUnits",
            'IdUsers' => ['required', 'string', 'max:11'],
            'phone' => ['required', 'string', 'max:15'],
            'zip_code' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'uf' => ['required', 'string', 'max:5'],
        ]);
        
        if($validator->fails()):
            return redirect(route('service_units.form', ['IdServiceUnits' => base64_encode($user->IdServiceUnits)]))->withErrors($validator)->withInput();
        endif;

        $user->name = $data['name'];
        $user->acronym = $data['acronym'];
        $user->code = $data['code'];
        $user->email = $data['email'];
        $user->IdUsers = $data['IdUsers'];
        $user->status = $data['status'];
        $user->phone = preg_replace('/[^0-9]/', '', $data['phone']);
        $user->zip_code = $data['zip_code'];
        $user->address = $data['address'];
        $user->number = $data['number'];
        $user->district = $data['district'];
        $user->city = $data['city'];
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('service_units');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ServiceUnits::find(base64_decode($id))->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function existe_email(Request $request)
    {
        return json_encode($this->service_units->existe_email($request->input('email'), $request->input('email_current')));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $IdServiceUnits
     * @return \Illuminate\Http\Response
     */
    public function set($id)
    {
        $id = base64_decode($id);
        $service_units = ServiceUnits::find($id);

        if(!empty($service_units)):
            Cookie::queue('IdServiceUnits', $service_units->IdServiceUnits, 43200);
            session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Unidade alterada com sucesso.', 'color' => 'bg-primary']));
        else:
            session()->flash('modal', json_encode(['title' => "ERRO", 'description' => 'Unidade não existe.', 'color' => 'bg-warning']));
        endif;

        return redirect()->back();
    }
}
