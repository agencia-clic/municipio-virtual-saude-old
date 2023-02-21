<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProcedureSubgroups;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Procedures;
use App\Helpers\Mask;
use DB;

class ProcedureSubgroupsController extends Controller
{
    protected $procedure_subgroups;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->procedure_subgroups = new ProcedureSubgroups();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $IdProcedures)
    {
        $data = $request->all();

        $procedures = Procedures::find(base64_decode($IdProcedures));
        if(empty($procedures)):
            abort(403);
        endif;

        $data['codeGrup'] = $procedures->code;
        $procedure_subgroups = $this->procedure_subgroups->list($data);

        return view('admin.procedure_subgroups.list', [
            'procedures' => $procedures,
            'procedure_subgroups' => $procedure_subgroups,
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
            'code' => ['required', 'string', 'max:255', 'unique:procedure_subgroups'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);

        if($validator->fails()):
            return redirect(route('procedure_subgroups.form'))->withErrors($validator)->withInput();
        endif;

        $procedure_subgroups = ProcedureSubgroups::create([
            'title' => $data['title'],
            'code' => $data['code'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('procedure_subgroups.form', ['IdProcedureSubgroups' => $procedure_subgroups->IdProcedureSubgroups]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdProcedureSubgroups = null)
    {
        $procedure_subgroups = $this->procedure_subgroups->list_current(base64_decode($IdProcedureSubgroups));

        return view('admin.procedure_subgroups.form', [
            'title' => " Classificações Medicamentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'procedure_subgroups' => $procedure_subgroups
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
        $procedure_subgroups = ProcedureSubgroups::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'code' => "required|unique:procedure_subgroups,code,{$procedure_subgroups->IdProcedureSubgroups},IdProcedureSubgroups",
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('procedure_subgroups.form', ['IdProcedureSubgroups' => base64_encode($procedure_subgroups->IdProcedureSubgroups)]))->withErrors($validator)->withInput();
        endif;

        $procedure_subgroups->title = $data['title'];
        $procedure_subgroups->code = $data['code'];
        $procedure_subgroups->status = $data['status'];
        
        $procedure_subgroups->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('procedure_subgroups');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function existe_code(Request $request)
    {
        return json_encode($this->procedure_subgroups->existe_code($request->input('code'), $request->input('code_current')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProcedureSubgroups::find(base64_decode($id))->delete();
        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro deltado com sucesso.', 'color' => 'bg-primary']));
    }
}
