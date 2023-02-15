<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Medicines;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\MedicationAdministrations;
use App\Models\MedicationDilutions;
use App\Models\MedicationInfusao;
use App\Models\MedicationUnits;
use App\Models\MedicationActivePrinciples;
use App\Models\UsersDiseases;
use DB;

class MedicinesController extends Controller
{
    protected $medicines;
    protected $mask;
    protected $medication_administrations;
    protected $medication_infusao;
    protected $medication_dilutions;
    protected $medication_units;
    protected $medication_active_principles;
    protected $users_diseases;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->medicines = new Medicines();
        $this->mask = new Mask();
        $this->medication_administrations = new MedicationAdministrations();
        $this->medication_infusao = new MedicationInfusao();
        $this->medication_dilutions = new MedicationDilutions();
        $this->medication_units = new MedicationUnits();
        $this->medication_active_principles = new MedicationActivePrinciples();
        $this->users_diseases = new UsersDiseases();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medicines = $this->medicines->list($request);

        return view('admin.medicines.list', [
            'title' => "Medicamentos | ".env('APP_NAME'),
            'medicines' => $medicines,
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
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'IdMedicationAdministrations' => ['required'],
            'IdMedicationUnits' => ['required', 'string', 'max:11'],
            'status' => ['required', 'string', 'max:1'],
        ]);

        if($validator->fails()):
            return redirect(route('medicines.form'))->withErrors($validator)->withInput();
        endif;

        Medicines::create([
            'title' => $request->input('title'),
            'IdMedicationAdministrations' => implode(',', $request->input('IdMedicationAdministrations') ?? []),
            'IdMedicationUnits' => $request->input('IdMedicationUnits'),
            'IdMedicationDilutions' => implode(',', $request->input('IdMedicationDilutions') ?? []),
            'IdMedicationInfusao' => implode(',', $request->input('IdMedicationInfusao') ?? []),
            'IdMedicationActivePrinciples' => implode(',', $request->input('IdMedicationActivePrinciples') ?? []),
            'status' => $request->input('status'),
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('medicines');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdMedicines = null)
    {
        return view('admin.medicines.form', [
            'title' => "Medicamentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'medication_dilutions' => $this->medication_dilutions->list_select(),
            'medication_infusao' => $this->medication_infusao->list_select(),
            'medication_administrations' => $this->medication_administrations->list_select(),
            'medication_units' => $this->medication_units->list_select(),
            'medicines' => $this->medicines->list_current(base64_decode($IdMedicines)),
            'medication_active_principles' => $this->medication_active_principles->list_select(),
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
        $medicines = Medicines::find(base64_decode($id));

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'IdMedicationAdministrations' => ['required'],
            'IdMedicationUnits' => ['required', 'string', 'max:11'],
            'status' => ['required', 'string', 'max:1'],
        ]);
        
        if($validator->fails()):
            return redirect(route('medicines.form', ['IdMedicines' => base64_encode($medicines->IdMedicines)]))->withErrors($validator)->withInput();
        endif;

        $medicines->IdMedicationAdministrations = implode(',', $request->input('IdMedicationAdministrations') ?? []);
        $medicines->IdMedicationUnits = $request->input('IdMedicationUnits');
        $medicines->IdMedicationDilutions = implode(',', $request->input('IdMedicationDilutions') ?? []);
        $medicines->IdMedicationInfusao = implode(',', $request->input('IdMedicationInfusao') ?? []);
        $medicines->IdMedicationActivePrinciples = implode(',', $request->input('IdMedicationActivePrinciples') ?? []);
        $medicines->status = $request->input('status');
        $medicines->title = $request->input('title');
        $medicines->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('medicines');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Medicines::find(base64_decode($id))->delete();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function query_json(Request $request)
    {
        $medicines = Medicines::where('medicines.status', 'a')->select('medicines.*', 'medication_units.title as units')->join('medication_units', 'medicines.IdMedicationUnits', '=', 'medication_units.IdMedicationUnits')->limit(env('PAGE_NUMBER'));
        
        if(!empty($request['title'])):
            $medicines = $medicines->where('medicines.title', 'LIKE', "%{$request['title']}%");
        endif;

        if(empty($request['title']) AND empty($request['title']) AND !empty($request['IdMedicines'])):
            $medicines = $medicines->where('medicines.IdMedicines', $request['IdMedicines']);
        endif;

        return json_encode($medicines->get()->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selected(Request $request, $IdUsers)
    {
        $data = array();
        if(!empty($request['IdMedicines'])):
            
            $medicines = Medicines::where('medicines.status', 'a')->select('medicines.*', 'medication_units.title as units')->join('medication_units', 'medicines.IdMedicationUnits', '=', 'medication_units.IdMedicationUnits')->where('medicines.IdMedicines', $request['IdMedicines'])->first();

            if(!empty($medicines->IdMedicationAdministrations)):
                $data['medication_administrations'] = MedicationAdministrations::whereIn('IdMedicationAdministrations', explode(',', $medicines->IdMedicationAdministrations))->get()->toArray();
            endif;

            if(!empty($medicines->IdMedicationDilutions)):
                $data['medication_dilutions'] = MedicationDilutions::whereIn('IdMedicationDilutions', explode(',', $medicines->IdMedicationDilutions))->get()->toArray();
            endif;

            if(!empty($medicines->IdMedicationInfusao)):
                $data['medication_infusao'] = MedicationInfusao::whereIn('IdMedicationInfusao', explode(',', $medicines->IdMedicationInfusao))->get()->toArray();
            endif;

            if(!empty($medicines->IdMedicationActivePrinciples)):

                if(UsersDiseases::whereIn('IdMedicationActivePrinciples', explode(',', $medicines->IdMedicationActivePrinciples))->where('IdUsers', base64_decode($IdUsers))->count() > 0):
                    $data['users_diseases'] = "Paciente tem alergia ao medicamento <strong>{$medicines->title} • {$medicines->units}</strong>";
                endif;
                
            endif;

        endif;

        return json_encode($data);
    }
}
