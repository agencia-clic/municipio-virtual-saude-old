<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Accommodations;
use App\Models\FunctionalUnits;
use DB;

class RoomsController extends Controller
{
    protected $rooms;
    protected $functional_units;
    protected $accommodations;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->rooms = new Rooms();
        $this->functional_units = new FunctionalUnits();
        $this->accommodations = new Accommodations();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms = $this->rooms->list($request);

        return view('admin.rooms.list', [
            'rooms' => $rooms,
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
            return redirect(route('rooms.form'))->withErrors($validator)->withInput();
        endif;

        Rooms::create([
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'title' => $request->input('title'),
            'status' => $request->input('status'),
            'initials' => $request->input('initials'),
            'IdAccommodations' => $request->input('IdAccommodations'),
            'IdFunctionalUnits' => $request->input('IdFunctionalUnits'),
            'capacity' => $request->input('capacity'),
            'determining_sex' => $request->input('determining_sex'),
            'international_exclusive' => $request->input('international_exclusive'),
        ]);

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro criado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('rooms');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($IdRooms = null)
    {
        $rooms = $this->rooms->list_current(base64_decode($IdRooms));
        return view('admin.rooms.form', [
            'functional_units' => $this->functional_units->list_select(),
            'accommodations' => $this->accommodations->list_select(),
            'rooms' => $rooms
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
        $rooms = Rooms::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:1', 'in:a,b'],
        ]);
        
        if($validator->fails()):
            return redirect(route('rooms.form', ['IdRooms' => base64_encode($user->IdRooms)]))->withErrors($validator)->withInput();
        endif;

        $rooms->title = $data['title'];
        $rooms->status = $data['status'];

        $rooms->initials = $request->input('initials');
        $rooms->IdAccommodations = $request->input('IdAccommodations');
        $rooms->IdFunctionalUnits = $request->input('IdFunctionalUnits');
        $rooms->capacity = $request->input('capacity');
        $rooms->determining_sex = $request->input('determining_sex');
        $rooms->international_exclusive = $request->input('international_exclusive');
        
        $rooms->save();

        session()->flash('modal', json_encode(['title' => "Sucesso", 'description' => 'Registro editado com sucesso.', 'color' => 'bg-primary']));
        return redirect()->route('rooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rooms::find(base64_decode($id))->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function query_json(Request $request)
    {
        $rooms = Rooms::where('status', 'a')->limit(env('PAGE_NUMBER'));
        
        if(!empty($request['IdFunctionalUnits'])):
            $rooms = $rooms->where('IdFunctionalUnits', $request['IdFunctionalUnits']);
        endif;

        if(empty($request['IdFunctionalUnits']) AND (!empty($request['IdRooms']))):
            $rooms = $rooms->where('IdRooms', $request->input('IdRooms'));
        endif;

        return json_encode($rooms->get()->toArray());
    }
}
