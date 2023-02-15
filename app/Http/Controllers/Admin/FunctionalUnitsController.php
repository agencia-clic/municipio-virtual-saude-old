<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\FunctionalUnits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Beds;
use App\Models\Clinics;
use App\Models\TypeFunctionalUnits;
use App\Helpers\Mask;
use DB;

class FunctionalUnitsController extends Controller
{
    protected $functional_units;
    protected $clinics;
    protected $beds;
    protected $type_functional_units;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->functional_units = new FunctionalUnits();
        $this->mask = new Mask();
        $this->beds = new Beds();
        $this->clinics = new Clinics();
        $this->type_functional_units = new TypeFunctionalUnits();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $functional_units = $this->functional_units->list($request);

        return view('admin.functional_units.list', [
            'functional_units' => $functional_units,
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
            'initials' => ['required', 'string', 'max:255'],
            'IdBeds' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1'],
        ]);

        if($validator->fails()):
            return redirect(route('functional_units.form'))->withErrors($validator)->withInput();
        endif;

        $functional_units = FunctionalUnits::create([
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'status' => $request->input('status'),
            'title' => $request->input('title'),
            'initials' => $request->input('initials'),
            'capacity' => $request->input('capacity'),
            'IdBeds' => $request->input('IdBeds'),
            'IdTypeFunctionalUnits' => $request->input('IdTypeFunctionalUnits'),
            'IdClinics' => $request->input('IdClinics'),
            'sector' => $request->input('sector'),
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('functional_units.form', ['IdFunctionalUnits' => $functional_units->IdFunctionalUnits]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdFunctionalUnits = null)
    {
        $functional_units = $this->functional_units->list_current(base64_decode($IdFunctionalUnits));

        return view('admin.functional_units.form', [
            'mask' => $this->mask,
            'beds' => $this->beds->list_select(),
            'clinics' => $this->clinics->list_select(),
            'type_functional_units' => $this->type_functional_units->list_select(),
            'functional_units' => $functional_units
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_modal($IdFunctionalUnits = null)
    {
        return view('admin.functional_units.form_modal', [
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
        $functional_units = FunctionalUnits::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1'],
        ]);
        
        if($validator->fails()):
            return redirect(route('functional_units.form', ['IdFunctionalUnits' => base64_encode($user->IdFunctionalUnits)]))->withErrors($validator)->withInput();
        endif;

        $functional_units->title = $data['title'];
        $functional_units->status = $data['status'];
        $functional_units->initials = $request->input('initials');
        $functional_units->capacity = $request->input('capacity');
        $functional_units->IdBeds = $request->input('IdBeds');
        $functional_units->IdTypeFunctionalUnits = $request->input('IdTypeFunctionalUnits');
        $functional_units->IdClinics = $request->input('IdClinics');
        $functional_units->sector = $request->input('sector');

        $functional_units->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('functional_units');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FunctionalUnits::find(base64_decode($id))->delete();
    }
}
