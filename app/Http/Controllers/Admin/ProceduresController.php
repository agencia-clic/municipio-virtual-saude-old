<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Procedures;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use DB;

class ProceduresController extends Controller
{
    protected $procedures;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->procedures = new Procedures();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $procedures = $this->procedures->list($request);
        return view('admin.procedures.list', [
            'procedures' => $procedures,
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
            'code' => ['required', 'string', 'max:255', 'unique:procedures'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);

        if($validator->fails()):
            return redirect(route('procedures.form'))->withErrors($validator)->withInput();
        endif;

        $procedures = Procedures::create([
            'title' => $data['title'],
            'code' => $data['code'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('procedures.form', ['IdProcedures' => $procedures->IdProcedures]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdProcedures = null)
    {
        $procedures = $this->procedures->list_current(base64_decode($IdProcedures));

        return view('admin.procedures.form', [
            'title' => " Classificações Medicamentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'procedures' => $procedures
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
        $procedures = Procedures::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'code' => "required|unique:procedures,code,{$procedures->IdProcedures},IdProcedures",
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('procedures.form', ['IdProcedures' => base64_encode($procedures->IdProcedures)]))->withErrors($validator)->withInput();
        endif;

        $procedures->title = $data['title'];
        $procedures->code = $data['code'];
        $procedures->status = $data['status'];
        
        $procedures->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('procedures');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function existe_code(Request $request)
    {
        return json_encode($this->procedures->existe_code($request->input('code'), $request->input('code_current')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Procedures::find(base64_decode($id))->delete();
        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro deltado com sucesso.', 'color' => 'bg-primary']));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_json(Request $request)
    {
        $procedures = Procedures::where('status', 'a')->limit(env('PAGE_NUMBER'));
        
        if(!empty($request['title'])):
            $procedures = $procedures->where('title', 'LIKE', "%{$request['title']}%");
        endif;
        
        if(!empty($request['code'])):
            $procedures = $procedures->where('code', 'LIKE', "%{$request['code']}%");
        endif;

        if(empty($request['title']) AND empty($request['code']) AND !empty($request['IdProcedures'])):
            $procedures = $procedures->where('IdProcedures', $request['IdProcedures']);
        endif;

        return json_encode($procedures->get()->toArray());
    }
}
