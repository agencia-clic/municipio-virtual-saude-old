<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProtocolsProcedures;
use App\Models\ProtocolsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\Medicines;
use DB;

class ProtocolsProceduresController extends Controller
{
    protected $protocols_medication;
    protected $medicines;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->protocols_medication = new ProtocolsProcedures();
        $this->medicines = new Medicines();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($IdProtocols)
    {
        $IdProtocols = base64_decode($IdProtocols);
        $protocols_medication = $this->protocols_medication->list($IdProtocols);
        return view('admin.protocols_medication.list', [
            'mask' => $this->mask,
            'protocols_medication' => $protocols_medication
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdProtocols)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdMedicines' => ['required', 'int', 'max:11'],
        ]);

        if($validator->fails()):
            return redirect(route('protocols_medication.form', ['IdProtocols' => $IdProtocols]))->withErrors($validator)->withInput();
        endif;

        ProtocolsProcedures::create([
            'IdMedicines' => $data['IdMedicines'],
            'IdProtocols' => base64_decode($IdProtocols),
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdProtocols, $IdProtocolsProcedures = null)
    {
        //select from units
        $medicines = $this->medicines::whereNotExists(function ($query) use ($IdProtocols) {
            $query->select(DB::raw(1))->from('protocols_medication')->whereColumn('protocols_medication.IdMedicines', 'medicines.IdMedicines')->where('IdProtocols', base64_decode($IdProtocols));
        })->get();

        $protocols_medication = $this->protocols_medication->list_current(base64_decode($IdProtocolsProcedures));
        return view('admin.protocols_medication.form', [
            'medicines' => $medicines,
            'protocols_medication' => $protocols_medication
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdProtocols, $id)
    {
        $protocols_medication = ProtocolsProcedures::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdMedicines' => ['required', 'int', 'max:11'],
        ]);
        
        if($validator->fails()):
            return redirect(route('protocols_medication.form', ['IdProtocols' => $IdProtocols]))->withErrors($validator)->withInput();
        endif;

        $protocols_medication->IdMedicines = $data['IdMedicines'];
        $protocols_medication->IdProtocols = base64_decode($IdProtocols);
        $protocols_medication->save();

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
        ProtocolsProcedures::find(base64_decode($id))->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function existe_email(Request $request)
    {
        return json_encode($this->protocols_medication->existe_email($request->input('email'), $request->input('email_current')));
    }
}
