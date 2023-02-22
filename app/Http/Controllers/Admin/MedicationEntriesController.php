<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MedicationEntries;
use App\Models\MedicationEntriesRegistrations;
use App\Models\Medicines;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

class MedicationEntriesController extends Controller
{
    protected $medication_entries;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->medication_entries = new MedicationEntries();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medication_entries = $this->medication_entries->list($request);
        return view('admin.medication_entries.list', [
            'medication_entries' => $medication_entries,
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
            'receipt_date' => ['required', 'date'],
        ]);

        if($validator->fails()):
            return redirect(route('medication_entries.form'))->withErrors($validator)->withInput();
        endif;

        $medication_entries = MedicationEntries::create([
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'receipt_date' => date('Y-m-d', strtotime($data['receipt_date'])),
            'text' => $data['text'],
            'type' => "m",
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('medication_entries.form', ['IdMedicationEntries' => base64_encode($medication_entries->IdMedicationEntries)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdMedicationEntries = null)
    {
        $medication_entries = $this->medication_entries->list_current(base64_decode($IdMedicationEntries));

        return view('admin.medication_entries.form', [
            'title' => " Classificações Medicamentos | ".env('APP_NAME'),
            'medication_entries' => $medication_entries
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
        $medication_entries = MedicationEntries::find(base64_decode($id));
        $data = $request->all();

        $medication_entries->status = "b";
        $medication_entries->text = $request->input('text');
        $medication_entries->save();

        // soma quantiadade medicamento
        $medication_entries_registrations = MedicationEntriesRegistrations::where('IdMedicationEntries', base64_decode($id))->get();

        if(!empty($medication_entries_registrations)):
            foreach($medication_entries_registrations as $val):

                //active registrations
                $b = MedicationEntriesRegistrations::find($val->IdMedicationEntriesRegistrations);
                $b->status = "a";
                $b->save();

                //soma
                $a = MedicationEntriesRegistrations::where('status', 'a')->where('IdMedicines', $val->IdMedicines)->sum('amount');
                $medicines = Medicines::find($val->IdMedicines);
                $medicines->amount = $a;
                $medicines->save();

            endforeach;
        endif;

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('medication_entries');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function existe_code(Request $request)
    {
        return json_encode($this->medication_entries->existe_code($request->input('code'), $request->input('code_current')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MedicationEntries::find(base64_decode($id))->delete();
        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro deltado com sucesso.', 'color' => 'bg-primary']));
    }
}
