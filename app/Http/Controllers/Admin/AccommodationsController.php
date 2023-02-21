<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Accommodations;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

class AccommodationsController extends Controller
{
    protected $accommodations;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->accommodations = new Accommodations();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accommodations = $this->accommodations->list($request);

        return view('admin.accommodations.list', [
            'accommodations' => $accommodations,
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
            return redirect(route('accommodations.form'))->withErrors($validator)->withInput();
        endif;

        Accommodations::create([
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'title' => $data['title'],
            'status' => $data['status'],
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('accommodations');
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
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);

        if($validator->fails()):
            return redirect(route('accommodations.form_modal'))->withErrors($validator)->withInput();
        endif;

        Accommodations::create([
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
    public function show($IdAccommodations = null)
    {
        $accommodations = $this->accommodations->list_current(base64_decode($IdAccommodations));

        return view('admin.accommodations.form', [
            'mask' => $this->mask,
            'accommodations' => $accommodations
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_modal($IdAccommodations = null)
    {
        return view('admin.accommodations.form_modal');
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
        $user = Accommodations::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('accommodations.form', ['IdAccommodations' => base64_encode($user->IdAccommodations)]))->withErrors($validator)->withInput();
        endif;

        $user->title = $data['title'];
        $user->status = $data['status'];
        
        $user->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('accommodations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Accommodations::find(base64_decode($id))->delete();
    }

    /**
     * Remove the specified resource from index.
     * @return \Illuminate\Http\Response
     */
    public function query_json(Request $request)
    {
        $data = $request->all();
        $medicines = Accommodations::limit(env('PAGE_NUMBER'));

        if(!empty($data) AND (!empty($data['title']))):
            $medicines = $medicines->where('title', 'LIKE', "{$data['title']}%");
        endif;

        if(!empty($data) AND (!empty($data['IdAccommodations']))):
            $medicines = $medicines->where('IdAccommodations', $data['IdAccommodations']);
        endif;

        return json_encode($medicines->get());
    }
}
