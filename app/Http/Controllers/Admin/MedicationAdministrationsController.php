<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MedicationAdministrations;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

class MedicationAdministrationsController extends Controller
{
    protected $medication_administrations;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->medication_administrations = new MedicationAdministrations();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medication_administrations = $this->medication_administrations->list($request);

        return view('admin.medication_administrations.list', [
            'medication_administrations' => $medication_administrations,
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
            return redirect(route('medication_administrations.form'))->withErrors($validator)->withInput();
        endif;

        MedicationAdministrations::create([
            'title' => $data['title'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('medication_administrations');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_modal(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);

        if($validator->fails()):
            return redirect(route('medication_administrations.form_modal'))->withErrors($validator)->withInput();
        endif;

        MedicationAdministrations::create([
            'title' => $data['title'],
            'status' => $data['status'],
        ]);

        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdMedicationAdministrations = null)
    {
        $medication_administrations = $this->medication_administrations->list_current(base64_decode($IdMedicationAdministrations));

        return view('admin.medication_administrations.form', [
            'title' => " Classificações Medicamentos | ".env('APP_NAME'),
            'medication_administrations' => $medication_administrations
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_modal($IdMedicationAdministrations = null)
    {
        return view('admin.medication_administrations.form_modal', [
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
        $user = MedicationAdministrations::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('medication_administrations.form', ['IdMedicationAdministrations' => base64_encode($user->IdMedicationAdministrations)]))->withErrors($validator)->withInput();
        endif;

        $user->title = $data['title'];
        $user->status = $data['status'];
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('medication_administrations');
    }

    /**
     * Remove the specified resource from index.
     * @return \Illuminate\Http\Response
     */
    public function query_json(Request $request)
    {
        $data = $request->all();
        $medicines = MedicationAdministrations::limit(env('PAGE_NUMBER'));

        if(!empty($data) AND (!empty($data['title']))):
            $medicines = $medicines->where('title', 'LIKE', "{$data['title']}%");
        endif;

        if(!empty($data) AND (!empty($data['IdMedicationAdministrations']))):
            $medicines = $medicines->where('IdMedicationAdministrations', $data['IdMedicationAdministrations']);
        endif;

        return json_encode($medicines->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MedicationAdministrations::find(base64_decode($id))->delete();
    }
}
