<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Clinics;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use DB;

class ClinicsController extends Controller
{
    protected $clinics;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->clinics = new Clinics();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clinics = $this->clinics->list($request);

        return view('admin.clinics.list', [
            'clinics' => $clinics,
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
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);

        if($validator->fails()):
            return redirect(route('clinics.form'))->withErrors($validator)->withInput();
        endif;

        Clinics::create([
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'title' => $data['title'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('clinics');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdClinics = null)
    {
        $clinics = $this->clinics->list_current(base64_decode($IdClinics));

        return view('admin.clinics.form', [
            'mask' => $this->mask,
            'clinics' => $clinics
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_modal($IdClinics = null)
    {
        return view('admin.clinics.form_modal', [
            'mask' => $this->mask,
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
        $user = Clinics::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('clinics.form', ['IdClinics' => base64_encode($user->IdClinics)]))->withErrors($validator)->withInput();
        endif;

        $user->title = $data['title'];
        $user->status = $data['status'];
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('clinics');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Clinics::find(base64_decode($id))->delete();
    }
}
