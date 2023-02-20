<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask2;
use Illuminate\Support\Str;
use DB;

class UsersController extends Controller
{
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
        $this->users = new User();
        $this->mask = new Mask2();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->users->list($request);
        return view('admin.users.list', [
            'title' => " Usuários | ".env('APP_NAME'),
            'mask' => $this->mask,
            'users' => $users
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cpf_cnpj' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => 'required_with:password|same:password|min:8'
        ]);
        
        if($validator->fails()):
            return redirect(route('users.form',['module' => $request->input('module')]))->withErrors($validator)->withInput();
        endif;

        $users = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cpf_cnpj' => preg_replace('/[^0-9]/', '', $data['cpf_cnpj']),
            'level' => $data['level'],
            'status' => $data['status'],
            'visible' => $data['visible'],
            'cell' => preg_replace('/[^0-9]/', '', $data['cell']),
            'phone' => preg_replace('/[^0-9]/', '', $data['phone']),
            'rg' => $data['rg'],
            'crm' => $request->input('crm'),
            'crn' => $request->input('crn'),
            'uf_crm' => $request->input('uf_crm'),
            'uf_rg' => $data['uf_rg'],
            'date_birth' => $data['date_birth'],
            'zip_code' => $data['zip_code'],
            'address' => $data['address'],
            'number' => $data['number'],
            'district' => $data['district'],
            'city' => $data['city'],
            'uf' => $data['uf'],
            'uf_naturalness' => $data['uf_naturalness'],
            'naturalness' => $data['naturalness'],
            'origin' => $data['origin'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(80),
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('users.form', ['IdUsers' => base64_encode($users->IdUsers), 'module' => $request->input('module')]);
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
        
        return view('admin.users.form', [
            'title' => " Usuários | ".env('APP_NAME'),
            'mask' => $this->mask,
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
        $user = User::find(base64_decode($id));

        $data = $request->all();
        $data['cpf_cnpj'] = preg_replace('/[^0-9]/', '', $data['cpf_cnpj']);

        if(!empty($data['date_birth'])):
            $data['date_birth'] = date('Y-m-d', strtotime($data['date_birth']));
        endif;

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => "required|email|unique:users,email,{$user->IdUsers},IdUsers",
            'cpf_cnpj' => "required|unique:users,cpf_cnpj,{$user->IdUsers},IdUsers",
        ]);
        
        if($validator->fails()):
            return redirect(route('users.form', ['module' => $request->input('module'), 'IdUsers' => base64_encode($user->IdUsers)]))->withErrors($validator)->withInput();
        endif;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->cpf_cnpj = preg_replace('/[^0-9]/', '', $data['cpf_cnpj']);
        $user->level = $data['level'];
        $user->status = $data['status'];
        $user->visible = $data['visible'];
        $user->cell = preg_replace('/[^0-9]/', '', $data['cell']);
        $user->phone = preg_replace('/[^0-9]/', '', $data['phone']);
        $user->rg = $data['rg'];
        $user->crm = $request->input('crm');
        $user->crn = $request->input('crn');
        $user->uf_crm = $request->input('uf_crm');
        $user->uf_rg = $data['uf_rg'];
        $user->date_birth = $data['date_birth'];
        $user->zip_code = $data['zip_code'];
        $user->address = $data['address'];
        $user->number = $data['number'];
        $user->district = $data['district'];
        $user->city = $data['city'];
        $user->uf = $data['uf'];
        $user->uf_naturalness = $data['uf_naturalness'];
        $user->naturalness = $data['naturalness'];
        $user->origin = $data['origin'];

        if(!empty($data['password'])):
            $user->password = Hash::make($data['password']);
        endif;
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('users', ['module' => $request->input('module')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find(base64_decode($id))->delete();
        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro deltado com sucesso.', 'color' => 'bg-primary']));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function online(User $user)
    {
        $user->online = 'o';
        $user->save();
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function offline(User $user)
    {
        $user->online = 'f';
        $user->save();
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function activeAttendance(User $user, Request $request)
    {
        $user->active_attendance = $request->input('type');
        $user->save();

        DB::table('medical_care_lottery')->where('IdUsers', auth()->user()->IdUsers)->update(['status' => 'b']);
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $cpf_cnpj
     * @return \Illuminate\Http\Response
     */
    public function existe_cpf(Request $request)
    {
        return json_encode($this->users->existe_cpf(preg_replace('/[^0-9]/', '', $request->input('cpf_cnpj')), preg_replace('/[^0-9]/', '', $request->input('cpf_current'))));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function existe_email(Request $request)
    {
        return json_encode($this->users->existe_email($request->input('email'), $request->input('email_current')));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function query(Request $request)
    {
        $users = $this->users->query_select($request->all());
        $option = '<option value="" selected="selected">Nenhum registro encontrado.</option>';
        if($users['count'] > 0):
            $option = null;
            foreach ($users['data'] as $value):
                $option .= "<option value='{$value->IdUsers}'>{$value->name}</option>";
            endforeach;
        endif;
        return $option;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $Id
     * @return \Illuminate\Http\Response
     */
    public function query_json(Request $request)
    {
        $users = $this->users->query_select($request->all());
        $data = array();

        if(!empty($users['data'])):
            foreach ($users['data'] as $val):
                $data[] = array('IdUsers' => $val->IdUsers, 'name' => $val->name, 'cns' => $val->cns, 'cpf_cnpj' => $this->mask->cpf_cnpj($val->cpf_cnpj), 'mother' => $val->mother, 'email' => $val->email, 'phone' => $this->mask->phone($val->phone), 'cell' => $this->mask->phone($val->cell), 'date_birth' => $this->mask->birth($val->date_birth), 'zip_code' => $val->zip_code, 'address' => $val->address, 'number' => $val->number, 'complement' => $val->complement, 'district' => $val->district, 'city' => $val->city, 'uf' => $val->uf);
            endforeach;
        endif;

        return json_encode($data);
    }

    /**
     * Remove the specified resource from index.
     * @return \Illuminate\Http\Response
     */
    public function query_json_responsavel(Request $request)
    {
        $data = $request->all();
        $users = User::limit(env('PAGE_NUMBER'))->select('name', 'IdUsers', 'cpf_cnpj', 'date_birth', 'address', 'zip_code', 'complement', 'number', 'district', 'city', 'uf');

        if(!empty($data) AND (!empty($data['name']))):
            $users = $users->where('name', 'LIKE', "{$data['name']}%");
        endif;

        if(!empty($data) AND (!empty($data['cpf_cnpj']))):
            $users = $users->where('cpf_cnpj', 'LIKE', "{$data['cpf_cnpj']}%");
        endif;

        if((empty($data['name']) AND empty($data['cpf_cnpj'])) AND (!empty($data['IdUsersResponsible']))):
            $users = $users->where('IdUsers', $data['IdUsersResponsible']);
        endif;

        if(!empty($request->input('current'))):

            $users = $users->first()->toArray();
            $users['cpf_cnpj'] = $this->mask->cpf_cnpj($users['cpf_cnpj']);
            $users['date_birth'] = $this->mask->birth($users['date_birth']);

            return json_encode($users);
        endif;

        return json_encode($users->get());
    }
}
