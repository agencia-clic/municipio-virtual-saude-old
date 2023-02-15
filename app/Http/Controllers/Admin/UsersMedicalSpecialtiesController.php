<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\UsersMedicalSpecialties;
use App\Models\UsersService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\MedicalSpecialties;
use DB;

class UsersMedicalSpecialtiesController extends Controller
{
    protected $users_medical_specialties;
    protected $medical_specialties;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->users_medical_specialties = new UsersMedicalSpecialties();
        $this->medical_specialties = new MedicalSpecialties();
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
        $users_medical_specialties = $this->users_medical_specialties->list($IdUsers);
        return view('admin.users_medical_specialties.list', [
            'mask' => $this->mask,
            'users_medical_specialties' => $users_medical_specialties
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
            'IdMedicalSpecialties' => ['required', 'int', 'max:11'],
        ]);

        if($validator->fails()):
            return redirect(route('users_medical_specialties.form', ['IdUsers' => $IdUsers]))->withErrors($validator)->withInput();
        endif;

        UsersMedicalSpecialties::create([
            'IdMedicalSpecialties' => $data['IdMedicalSpecialties'],
            'IdUsers' => base64_decode($IdUsers),
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdUsers, $IdUsersMedicalSpecialties = null)
    {
        //select from units
        $medical_specialties = $this->medical_specialties::whereNotExists(function ($query) use ($IdUsers) {
            $query->select(DB::raw(1))->from('users_medical_specialties')->whereColumn('users_medical_specialties.IdMedicalSpecialties', 'medical_specialties.IdMedicalSpecialties')->where('IdUsers', base64_decode($IdUsers));
        })->get();

        $users_medical_specialties = $this->users_medical_specialties->list_current(base64_decode($IdUsersMedicalSpecialties));
        return view('admin.users_medical_specialties.form', [
            'medical_specialties' => $medical_specialties,
            'users_medical_specialties' => $users_medical_specialties
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
        $users_medical_specialties = UsersMedicalSpecialties::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdMedicalSpecialties' => ['required', 'int', 'max:11'],
        ]);
        
        if($validator->fails()):
            return redirect(route('users_medical_specialties.form', ['IdUsers' => $IdUsers]))->withErrors($validator)->withInput();
        endif;

        $users_medical_specialties->IdMedicalSpecialties = $data['IdMedicalSpecialties'];
        $users_medical_specialties->IdUsers = base64_decode($IdUsers);
        $users_medical_specialties->save();

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
        UsersMedicalSpecialties::find(base64_decode($id))->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function existe_email(Request $request)
    {
        return json_encode($this->users_medical_specialties->existe_email($request->input('email'), $request->input('email_current')));
    }
}
