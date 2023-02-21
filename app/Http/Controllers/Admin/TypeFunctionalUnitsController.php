<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TypeFunctionalUnits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use DB;

class TypeFunctionalUnitsController extends Controller
{
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
        $this->type_functional_units = new TypeFunctionalUnits();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type_functional_units = $this->type_functional_units->list($request);

        return view('admin.type_functional_units.list', [
            'type_functional_units' => $type_functional_units,
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
            return redirect(route('type_functional_units.form'))->withErrors($validator)->withInput();
        endif;

        TypeFunctionalUnits::create([
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'title' => $data['title'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('type_functional_units');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdTypeFunctionalUnits = null)
    {
        $type_functional_units = $this->type_functional_units->list_current(base64_decode($IdTypeFunctionalUnits));

        return view('admin.type_functional_units.form', [
            'mask' => $this->mask,
            'type_functional_units' => $type_functional_units
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
        $user = TypeFunctionalUnits::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('type_functional_units.form', ['IdTypeFunctionalUnits' => base64_encode($user->IdTypeFunctionalUnits)]))->withErrors($validator)->withInput();
        endif;

        $user->title = $data['title'];
        $user->status = $data['status'];
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('type_functional_units');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TypeFunctionalUnits::find(base64_decode($id))->delete();
    }
}
