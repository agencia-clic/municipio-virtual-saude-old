<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MedicationEntriesRegistrations;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\MedicationEntries;
use App\Helpers\Mask;

class MedicationEntriesRegistrationsController extends Controller
{
    protected $medication_entries_registrations;
    protected $medication_entries;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->medication_entries_registrations = new MedicationEntriesRegistrations();
        $this->medication_entries = new MedicationEntries();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $IdMedicationEntries)
    {
        $data = $request->all();
        $data['IdMedicationEntries'] = base64_decode($IdMedicationEntries);
        $medication_entries_registrations = $this->medication_entries_registrations->list($data);

        return view('admin.medication_entries_registrations.list', [
            'medication_entries_registrations' => $medication_entries_registrations,
            'medication_entries' => MedicationEntries::find($data['IdMedicationEntries']),
            'mask' => $this->mask,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdMedicationEntries)
    {
        $data = $request->all();
        $IdMedicationEntries = base64_decode($IdMedicationEntries);

        $validator = Validator::make($data, [
            'lote' => ['required', 'string', 'max:255'],
            'date_venc' => ['required', 'date', 'max:255'],
            'amount' => ['required', 'string', 'max:255'],
            'IdMedicines' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()):
            return redirect(route('medication_entries_registrations.form', ['IdMedicationEntries' => base64_encode($IdMedicationEntries)]))->withErrors($validator)->withInput();
        endif;

        MedicationEntriesRegistrations::create([
            'lote' => $data['lote'],
            'IdMedicationEntries' => $IdMedicationEntries,
            'date_venc' => date('Y-m-d', strtotime($data['date_venc'])),
            'amount' => $data['amount'],
            'code' => $data['code'],
            'IdMedicines' => $data['IdMedicines'],
        ]);

        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdMedicationEntries, $IdMedicationEntriesRegistrations = null)
    {
        $medication_entries_registrations = $this->medication_entries_registrations->list_current(base64_decode($IdMedicationEntriesRegistrations));

        return view('admin.medication_entries_registrations.form', [
            'title' => " Classificações Medicamentos | ".env('APP_NAME'),
            'medication_entries' => MedicationEntries::find(base64_decode($IdMedicationEntries)),
            'mask' => $this->mask,
            'medication_entries_registrations' => $medication_entries_registrations
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdMedicationEntries, $id)
    {
        $user = MedicationEntriesRegistrations::find(base64_decode($id));
        $data = $request->all();
        $IdMedicationEntries = base64_decode($IdMedicationEntries);

        $validator = Validator::make($data, [
            'lote' => ['required', 'string', 'max:255'],
            'date_venc' => ['required', 'date', 'max:255'],
            'amount' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
        ]);
        
        if($validator->fails()):
            return redirect(route('medication_entries_registrations.form', ['IdMedicationEntries' => $IdMedicationEntries, 'IdMedicationEntriesRegistrations' => base64_encode($user->IdMedicationEntriesRegistrations)]))->withErrors($validator)->withInput();
        endif;

        $user->lote = $data['lote'];
        $user->date_venc = date('Y-m-d', strtotime($data['date_venc']));
        $user->amount = $data['amount'];
        $user->code = $data['code'];
        $user->save();

        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MedicationEntriesRegistrations::find(base64_decode($id))->delete();
    }
}
