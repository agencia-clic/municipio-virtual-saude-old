<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MedicationUnits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use DB;

class MedicationUnitsController extends Controller
{
    protected $medication_units;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->medication_units = new MedicationUnits();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medication_units = $this->medication_units->list($request);

        return view('admin.medication_units.list', [
            'medication_units' => $medication_units,
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
            return redirect(route('medication_units.form'))->withErrors($validator)->withInput();
        endif;

        MedicationUnits::create([
            'title' => $data['title'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('medication_units');
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
            return redirect(route('medication_units.form_modal'))->withErrors($validator)->withInput();
        endif;

        MedicationUnits::create([
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
    public function show($IdMedicationUnits = null)
    {
        $medication_units = $this->medication_units->list_current(base64_decode($IdMedicationUnits));

        return view('admin.medication_units.form', [
            'mask' => $this->mask,
            'medication_units' => $medication_units
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_modal($IdMedicationUnits = null)
    {
        return view('admin.medication_units.form_modal', [
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
        $user = MedicationUnits::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('medication_units.form', ['IdMedicationUnits' => base64_encode($user->IdMedicationUnits)]))->withErrors($validator)->withInput();
        endif;

        $user->title = $data['title'];
        $user->status = $data['status'];
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('medication_units');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MedicationUnits::find(base64_decode($id))->delete();
    }

    /**
     * Remove the specified resource from index.
     * @return \Illuminate\Http\Response
     */
    public function query_json(Request $request)
    {
        $data = $request->all();
        $medicines = MedicationUnits::limit(env('PAGE_NUMBER'));

        if(!empty($data) AND (!empty($data['title']))):
            $medicines = $medicines->where('title', 'LIKE', "{$data['title']}%");
        endif;

        if(!empty($data) AND (!empty($data['IdMedicationUnits']))):
            $medicines = $medicines->where('IdMedicationUnits', $data['IdMedicationUnits']);
        endif;

        return json_encode($medicines->get());
    }
}
