<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MedicalSpecialties;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

class MedicalSpecialtiesController extends Controller
{
    protected $medical_specialties;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->medical_specialties = new MedicalSpecialties();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medical_specialties = $this->medical_specialties->list($request);

        return view('admin.medical_specialties.list', [
            'medical_specialties' => $medical_specialties,
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
            'title' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1'],
        ]);

        if($validator->fails()):
            return redirect(route('medical_specialties.form'))->withErrors($validator)->withInput();
        endif;

        MedicalSpecialties::create([
            'title' => $data['title'],
            'code' => $data['code'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('medical_specialties');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdMedicalSpecialties = null)
    {
        $medical_specialties = $this->medical_specialties->list_current(base64_decode($IdMedicalSpecialties));

        return view('admin.medical_specialties.form', [
            'title' => " Especialidades Medicas | ".env('APP_NAME'),
            'medical_specialties' => $medical_specialties
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
        $user = MedicalSpecialties::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1'],
        ]);
        
        if($validator->fails()):
            return redirect(route('medical_specialties.form', ['IdMedicalSpecialties' => base64_encode($user->IdMedicalSpecialties)]))->withErrors($validator)->withInput();
        endif;

        $user->title = $data['title'];
        $user->code = $request->input('code');
        $user->status = $data['status'];
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('medical_specialties');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MedicalSpecialties::find(base64_decode($id))->delete();
    }
}
