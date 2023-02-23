<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UsersPatients;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersPatientsController extends Controller
{
    protected $users;
    protected $_users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->users = new UsersPatients();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $data['level'] = "p";

        return view('admin.users_patients.list', [
            'title' => " Usuários | ".env('APP_NAME'),
            'users' => $this->users->list($data),
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
        $data['cpf_cnpj'] = preg_replace('/[^0-9]/', '', $data['cpf_cnpj']);

        if(!empty($data['date_birth'])):
            $data['date_birth'] = date('Y-m-d', strtotime($data['date_birth']));
        endif;

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mother' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:1'],
            'date_birth' => ['date', 'required'],
            'cpf_cnpj' => ['string', 'max:255', 'unique:users', 'required'],
        ]);
        
        if($validator->fails()):
            return redirect(route('users_patients.form',['module' => $request->input('module')]))->withErrors($validator)->withInput();
        endif;

        if(!empty($data['cpf_cnpj'])):
            $data['cpf_cnpj'] = preg_replace('/[^0-9]/', '', $data['cpf_cnpj']);
        else:
            $data['cpf_cnpj'] = Null;
        endif;

        $users = UsersPatients::create([
            'name' => $data['name'],
            'social_name' => $data['social_name'],
            'mother' => $data['mother'],
            'email' => $data['email'],
            'cpf_cnpj' => $data['cpf_cnpj'],
            'cell' => preg_replace('/[^0-9]/', '', $data['cell']),
            'phone' => preg_replace('/[^0-9]/', '', $data['phone']),
            'rg' => $data['rg'],
            'crm' => $request->input('crm'),
            'crn' => $request->input('crn'),
            'uf_crm' => $request->input('uf_crm'),
            'uf_rg' => $data['uf_rg'],
            'date_birth' => date("Y-m-d", strtotime($data['date_birth'])),
            'zip_code' => $data['zip_code'],
            'address' => $data['address'],
            'number' => $data['number'],
            'complement' => $data['complement'],
            'district' => $data['district'],
            'city' => $data['city'],
            'uf' => $data['uf'],
            'uf_naturalness' => $data['uf_naturalness'],
            'naturalness' => $data['naturalness'],
            'origin' => $data['origin'],
            'voter_registration' => $data['voter_registration'],
            'cns' => $data['cns'],
            'breed' => $data['breed'],
            'sex' => $data['sex'],
            'sanguine' => $data['sanguine'],
            'marital_status' => $data['marital_status'],
            'schooling' => $data['schooling'],
            'occupation' => $data['occupation'],
            'api_token' => Str::random(80),
        ]);

        session()->flash('modal-close-users', "#modal_iframe");
        return redirect()->route('users_patients.form', ['IdUsers' => base64_encode($users->IdUsers), 'module' => $request->input('module')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdUsers = null)
    {
        $users = $this->users->list_current(base64_decode($IdUsers));

        return view('admin.users_patients.form', [
            'title' => " Usuários | ".env('APP_NAME'),
            'layout' => ['menu' => true, 'header' => true],
            'users' => $users
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
        $user = UsersPatients::find(base64_decode($id));

        $data = $request->all();
        $data['cpf_cnpj'] = preg_replace('/[^0-9]/', '', $data['cpf_cnpj']);

        if(!empty($data['date_birth'])):
            $data['date_birth'] = date('Y-m-d', strtotime($data['date_birth']));
        endif;

        if(!empty($data['cpf_cnpj'])):
            $data['cpf_cnpj'] = preg_replace('/[^0-9]/', '', $data['cpf_cnpj']);
        else:
            $data['cpf_cnpj'] = Null;
        endif;

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mother' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:1'],
            'date_birth' => ['date', 'required'],
            'cpf_cnpj' => "unique:users,cpf_cnpj,{$user->IdUsers},IdUsers",
        ]);
        
        if($validator->fails()):
            return redirect(route('users_patients.form', ['module' => $request->input('module'), 'IdUsers' => base64_encode($user->IdUsers)]))->withErrors($validator)->withInput();
        endif;

        $user->name = $data['name'];
        $user->mother = $data['mother'];
        $user->email = $data['email'];
        $user->cpf_cnpj = $data['cpf_cnpj'];
        $user->cell = preg_replace('/[^0-9]/', '', $data['cell']);
        $user->phone = preg_replace('/[^0-9]/', '', $data['phone']);
        $user->rg = $data['rg'];
        $user->crm = $request->input('crm');
        $user->crn = $request->input('crn');
        $user->uf_crm = $request->input('uf_crm');
        $user->uf_rg = $data['uf_rg'];
        $user->date_birth = date("Y-m-d", strtotime($data['date_birth']));
        $user->zip_code = $data['zip_code'];
        $user->address = $data['address'];
        $user->complement = $data['complement'];
        $user->number = $data['number'];
        $user->district = $data['district'];
        $user->city = $data['city'];
        $user->uf = $data['uf'];
        $user->uf_naturalness = $data['uf_naturalness'];
        $user->naturalness = $data['naturalness'];
        $user->origin = $data['origin'];
        $user->voter_registration = $data['voter_registration'];
        $user->cns = $data['cns'];
        $user->breed = $data['breed'];
        $user->sex = $data['sex'];
        $user->sanguine = $data['sanguine'];
        $user->marital_status = $data['marital_status'];
        $user->schooling = $data['schooling'];
        $user->occupation = $data['occupation'];
        
        $user->save();

        session()->flash('modal-close-users', "#modal_iframe");
        return redirect()->route('users_patients.form', ['IdUsers' => base64_encode($user->IdUsers), 'module' => $request->input('module')]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function merger(Request $request, $IdUsers)
    {
        $IdUsers = base64_decode($IdUsers);
        return view('admin.users_patients.merger', [
            'users' => $this->users->list_current($IdUsers),
        ]);
    }
}
