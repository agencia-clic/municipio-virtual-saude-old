<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Materials;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

class MaterialsController extends Controller
{
    protected $materials;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->materials = new Materials();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $materials = $this->materials->list($request);

        return view('admin.materials.list', [
            'materials' => $materials,
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
            'status' => ['required', 'string', 'max:1'],
        ]);

        if($validator->fails()):
            return redirect(route('materials.form'))->withErrors($validator)->withInput();
        endif;

        Materials::create([
            'title' => $data['title'],
            'code' => $data['code'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('materials');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdMaterials = null)
    {
        $materials = $this->materials->list_current(base64_decode($IdMaterials));

        return view('admin.materials.form', [
            'materials' => $materials
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_modal($IdMaterials = null)
    {
        return view('admin.materials.form_modal');
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
        $user = Materials::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1'],
        ]);
        
        if($validator->fails()):
            return redirect(route('materials.form', ['IdMaterials' => base64_encode($user->IdMaterials)]))->withErrors($validator)->withInput();
        endif;

        $user->title = $data['title'];
        $user->code = $data['code'];
        $user->status = $data['status'];
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('materials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Materials::find(base64_decode($id))->delete();
    }

    /**
     * Remove the specified resource from index.
     * @return \Illuminate\Http\Response
     */
    public function query_json(Request $request)
    {
        $data = $request->all();
        $medicines = Materials::limit(env('PAGE_NUMBER'));

        if(!empty($data) AND (!empty($data['title']))):
            $medicines = $medicines->where('title', 'LIKE', "{$data['title']}%");
        endif;

        if(!empty($data) AND (!empty($data['code']))):
            $medicines = $medicines->where('code', $data['code']);
        endif;

        if(!empty($data) AND (!empty($data['IdMaterials']))):
            $medicines = $medicines->where('IdMaterials', $data['IdMaterials']);
        endif;

        return json_encode($medicines->get());
    }
}
