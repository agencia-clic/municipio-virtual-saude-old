<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UsersServiceUnits;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\ServiceUnits;
use App\Models\ServiceUnitsRoles;
use DB;

class UsersServiceUnitsController extends Controller
{
    protected $users_service_units;
    protected $service_units;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->users_service_units = new UsersServiceUnits();
        $this->service_units = new ServiceUnits();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($IdUsers)
    {
        $IdUsers = base64_decode($IdUsers); 
        $users_service_units = $this->users_service_units->list($IdUsers);
        $users = User::find($IdUsers);

        return view('admin.users_service_units.list', [
            'mask' => $this->mask,
            'users' => $users,
            'users_service_units' => $users_service_units
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdUsers)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdServiceUnits' => ['required', 'int', 'max:11'],
        ]);

        if($validator->fails()):
            return redirect(route('users_service_units.form', ['IdUsers' => $IdUsers]))->withErrors($validator)->withInput();
        endif;

        $usersService_units = UsersServiceUnits::create([
            'IdServiceUnits' => $data['IdServiceUnits'],
            'IdUsers' => base64_decode($IdUsers),
        ]);

        //loop
        $roles = array();
        if(!empty($data['route'])):
            foreach ($data['route'] as $val):
                $roles[] = array('IdServiceUnits' => $request->input('IdServiceUnits'), 'IdUsersServiceUnits' => $usersService_units->IdUsersServiceUnits, 'IdUsers' => base64_decode($IdUsers),'route' => $val);
            endforeach;

            ServiceUnitsRoles::insert($roles);
        endif;

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdUsers, $IdUsersServiceUnits = null)
    {
        $IdUsersServiceUnits = base64_decode($IdUsersServiceUnits);
        $IdUsers = base64_decode($IdUsers);
        $users = User::find($IdUsers);

        //select from units
        $service_units = $this->service_units::whereNotExists(function ($query) use ($IdUsers) {
            $query->select(DB::raw(1))->from('users_service_units')->
            whereColumn('users_service_units.IdServiceUnits', 'service_units.IdServiceUnits')->
            where('IdUsers', $IdUsers);
        })->get();

        $users_service_units = $this->users_service_units->list_current($IdUsersServiceUnits);

        return view('admin.users_service_units.form', [
            'service_units' => $service_units,
            'users' => $users,
            'users_service_units' => $users_service_units
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdUsers, $id)
    {
        $users_service_units = UsersServiceUnits::find(base64_decode($id));
        $data = $request->all();

        //delete
        ServiceUnitsRoles::where('IdUsersServiceUnits', base64_decode($id))->delete();

        //loop
        $roles = array();
        if(!empty($data['route'])):
            foreach ($data['route'] as $val):
                $roles[] = array('IdServiceUnits' => $users_service_units->IdServiceUnits,'IdUsersServiceUnits' => base64_decode($id),'IdUsers' => base64_decode($IdUsers),'route' => $val);
            endforeach;
            ServiceUnitsRoles::insert($roles);
        endif;

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
        UsersServiceUnits::find(base64_decode($id))->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function existe_email(Request $request)
    {
        return json_encode($this->users_service_units->existe_email($request->input('email'), $request->input('email_current')));
    }
}
