<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\RoomsBeds;
use App\Models\RoomsService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\MedicalSpecialties;
use DB;

class RoomsBedsController extends Controller
{
    protected $medical_specialties;
    protected $rooms_beds;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->rooms_beds = new RoomsBeds();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($IdRooms)
    {
        $IdRooms = base64_decode($IdRooms);
        $rooms_beds = $this->rooms_beds->list($IdRooms);
        return view('admin.rooms_beds.list', [
            'mask' => $this->mask,
            'rooms_beds' => $rooms_beds
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdRooms)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails()):
            return redirect(route('rooms_beds.form', ['IdRooms' => $IdRooms]))->withErrors($validator)->withInput();
        endif;

        RoomsBeds::create([
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'status' => 'd',
            'title' => $request->input('title'),
            'note' => $request->input('note'),
            'code' => $request->input('code'),
            'IdRooms' => base64_decode($IdRooms),
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdRooms, $IdRoomsBeds = null)
    {
        $rooms_beds = $this->rooms_beds->list_current(base64_decode($IdRoomsBeds));

        return view('admin.rooms_beds.form', [
            'rooms_beds' => $rooms_beds
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdRooms, $id)
    {
        $rooms_beds = RoomsBeds::find(base64_decode($id));
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
        ]);
        
        if($validator->fails()):
            return redirect(route('rooms_beds.form', ['IdRooms' => $IdRooms, 'IdRoomsBeds' => $id]))->withErrors($validator)->withInput();
        endif;

        $rooms_beds->title = $request->input('title');
        $rooms_beds->code = $request->input('code');
        $rooms_beds->note = $request->input('note');

        $rooms_beds->save();

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
        RoomsBeds::find(base64_decode($id))->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function existe_email(Request $request)
    {
        return json_encode($this->rooms_beds->existe_email($request->input('email'), $request->input('email_current')));
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function query_json(Request $request)
    {
        $rooms_beds = RoomsBeds::where('status', 'd')->limit(env('PAGE_NUMBER'));
    
        if(!empty($request->input('IdRooms'))):
            $rooms_beds = $rooms_beds->where('IdRooms', $request->input('IdRooms'));
        endif;

        if(empty($request['IdRooms']) AND (!empty($request->input('IdRoomsBeds')))):
            $rooms_beds = $rooms_beds->where('IdRoomsBeds', $request->input('IdRoomsBeds'));
        endif;

        return json_encode($rooms_beds->get()->toArray());
    }
}
