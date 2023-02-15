<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SpecialtyCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use DB;

class SpecialtyCategoriesController extends Controller
{
    protected $specialty_categories;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->specialty_categories = new SpecialtyCategories();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $specialty_categories = $this->specialty_categories->list($request);

        return view('admin.specialty_categories.list', [
            'specialty_categories' => $specialty_categories,
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
            'status' => ['required', 'string', 'max:1'],
        ]);

        if($validator->fails()):
            return redirect(route('specialty_categories.form'))->withErrors($validator)->withInput();
        endif;

        SpecialtyCategories::create([
            'title' => $data['title'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('specialty_categories');
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
            'status' => ['required', 'string', 'max:1'],
        ]);

        if($validator->fails()):
            return redirect(route('specialty_categories.form_modal'))->withErrors($validator)->withInput();
        endif;

        SpecialtyCategories::create([
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
    public function show($IdSpecialtyCategories = null)
    {
        $specialty_categories = $this->specialty_categories->list_current(base64_decode($IdSpecialtyCategories));

        return view('admin.specialty_categories.form', [
            'title' => " Classificações Medicamentos | ".env('APP_NAME'),
            'mask' => $this->mask,
            'specialty_categories' => $specialty_categories
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_modal($IdSpecialtyCategories = null)
    {
        return view('admin.specialty_categories.form_modal', [
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
        $user = SpecialtyCategories::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1'],
        ]);
        
        if($validator->fails()):
            return redirect(route('specialty_categories.form', ['IdSpecialtyCategories' => base64_encode($user->IdSpecialtyCategories)]))->withErrors($validator)->withInput();
        endif;

        $user->title = $data['title'];
        $user->status = $data['status'];
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('specialty_categories');
    }

    /**
     * Remove the specified resource from index.
     * @return \Illuminate\Http\Response
     */
    public function query_json(Request $request)
    {
        $data = $request->all();
        $medicines = SpecialtyCategories::limit(env('PAGE_NUMBER'));

        if(!empty($data) AND (!empty($data['title']))):
            $medicines = $medicines->where('title', 'LIKE', "{$data['title']}%");
        endif;

        if(!empty($data) AND (!empty($data['IdSpecialtyCategories']))):
            $medicines = $medicines->where('IdSpecialtyCategories', $data['IdSpecialtyCategories']);
        endif;

        return json_encode($medicines->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SpecialtyCategories::find(base64_decode($id))->delete();
    }
}
