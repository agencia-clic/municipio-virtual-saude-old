<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Cid10;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use DB;

class Cid10Controller extends Controller
{
    protected $cid10;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->cid10 = new Cid10();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cid10 = $this->cid10->list($request);
        return view('admin.cid10.list', [
            'cid10' => $cid10,
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
            'code' => ['required', 'string', 'max:255', 'unique:cid10'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);

        if($validator->fails()):
            return redirect(route('cid10.form'))->withErrors($validator)->withInput();
        endif;

        Cid10::create([
            'title' => $data['title'],
            'code' => $data['code'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('cid10');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdCid10 = null)
    {
        $cid10 = $this->cid10->list_current(base64_decode($IdCid10));

        return view('admin.cid10.form', [
            'title' => " Classificações Medicamentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'cid10' => $cid10
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
        $cid10 = Cid10::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'code' => "required|unique:cid10,code,{$cid10->IdCid10},IdCid10",
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('cid10.form', ['IdCid10' => base64_encode($cid10->IdCid10)]))->withErrors($validator)->withInput();
        endif;

        $cid10->title = $data['title'];
        $cid10->code = $data['code'];
        $cid10->status = $data['status'];
        
        $cid10->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('cid10');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function existe_code(Request $request)
    {
        return json_encode($this->cid10->existe_code($request->input('code'), $request->input('code_current')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cid10::find(base64_decode($id))->delete();
        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro deltado com sucesso.', 'color' => 'bg-primary']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list_json(Request $request)
    {
        $cid10 = Cid10::where('status', 'a')->limit(env('PAGE_NUMBER'));
        
        if(!empty($request['title'])):
            $cid10 = $cid10->where('title', 'LIKE', "%{$request['title']}%");
        endif;
        
        if(!empty($request['code'])):
            $cid10 = $cid10->where('code', 'LIKE', "%{$request['code']}%");
        endif;

        if(empty($request['title']) AND empty($request['code']) AND !empty($request['IdCid10'])):
            $cid10 = $cid10->where('IdCid10', $request['IdCid10']);
        endif;

        return json_encode($cid10->get()->toArray());
    }
}
