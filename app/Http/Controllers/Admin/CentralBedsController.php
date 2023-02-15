<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdmitPatientRequests;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\HospitalizationObservation;
use App\Models\EmergencyServicesConducts;
use App\Models\FunctionalUnits;
use App\Models\EmergencyServices;
use Illuminate\Http\Request;
use App\Models\RoomsBeds;
use App\Models\User;
use App\Helpers\Mask;
use DB;

class CentralBedsController extends Controller
{
    protected $mask;
    protected $users;
    protected $functional_units;

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
        $this->users = new User();
        $this->functional_units = new FunctionalUnits();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms_beds = $this->rooms_beds->list_central($request->all());

        return view('admin.central_beds.list', [
            'rooms_beds' => $rooms_beds,
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table(Request $request)
    {
        return view('admin.central_beds.table', [
            'rooms_beds' => $this->rooms_beds->list_central($request->all()),
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function interning(Request $request, $IdRooms, $IdRoomsBeds)
    {
        return view('admin.central_beds.interning', [
            'rooms_beds' => $this->rooms_beds->list_current(base64_decode($IdRoomsBeds)),
            'IdRooms' => $IdRooms,
            'IdRoomsBeds' => $IdRoomsBeds,
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function interning_store(Request $request, $IdRooms, $IdRoomsBeds)
    {
        $IdRooms = base64_decode($IdRooms);
        $IdRoomsBeds = base64_decode($IdRoomsBeds);

        $validator = Validator::make($request->all(), [
            'IdUsers' => ['required', 'string', 'max:11'],
            'IdAdmitPatientRequests' => ['required', 'string', 'max:11'],
        ]);

        //emergency services
        $emergency_services = EmergencyServices::where('IdUsers', $request->input('IdUsers'))->where('status', 'a')->first();

        if($validator->fails() OR (empty($emergency_services))):
            return redirect(route('central_beds.interning', ['IdRooms' => base64_encode($IdRooms), 'IdRoomsBeds' => base64_encode($IdRoomsBeds)]))->withErrors($validator)->withInput();
        endif;

        //admit patient requests
        $admit_patient_requests = AdmitPatientRequests::find($request->input('IdAdmitPatientRequests'));
        $admit_patient_requests->status = "h";
        $admit_patient_requests->save();

        //save rooms beds
        $rooms_beds = RoomsBeds::find($IdRoomsBeds);
        $rooms_beds->status = "o";
        $rooms_beds->IdUsers = $request->input('IdUsers');
        $rooms_beds->note_users = $request->input('note');
        $rooms_beds->save();

        //tira o paciente da observação
        $emergency_servicesConducts = EmergencyServicesConducts::find($admit_patient_requests->IdEmergencyServicesConducts);
        $emergency_servicesConducts->observation = NULL;
        $emergency_servicesConducts->save();

        //bloqueia qualquer registro em aberto
        HospitalizationObservation::where('IdEmergencyServices', $emergency_services->IdEmergencyServices)->update(['status' => 'b']);

        //new hospitalization observation
        HospitalizationObservation::create([
            'status' => 'a',
            'type' => 'h',
            'IdUsersResponsible' => auth()->user()->IdUsers,
            'IdUsers' => $request->input('IdUsers'),
            'IdEmergencyServices' => $emergency_services->IdEmergencyServices,
            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
            'IdRoomsBeds' => $IdRoomsBeds,
            'IdRooms' => $IdRooms,
        ]);

        return "success";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cleaning(Request $request, $IdRooms, $IdRoomsBeds)
    {
        return view('admin.central_beds.cleaning', [
            'rooms_beds' => $this->rooms_beds->list_current(base64_decode($IdRoomsBeds)),
            'IdRooms' => $IdRooms,
            'IdRoomsBeds' => $IdRoomsBeds,
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cleaning_store(Request $request, $IdRooms, $IdRoomsBeds)
    {
        $IdRooms = base64_decode($IdRooms);
        $IdRoomsBeds = base64_decode($IdRoomsBeds);

        //save rooms beds
        $rooms_beds = RoomsBeds::find($IdRoomsBeds);
        $rooms_beds->status = "l";
        $rooms_beds->IdUsers = NULL;
        $rooms_beds->note_users = $request->input('note');
        $rooms_beds->save();

        return "success";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cleaning_finish(Request $request, $IdRooms, $IdRoomsBeds)
    {
        $IdRooms = base64_decode($IdRooms);
        $IdRoomsBeds = base64_decode($IdRoomsBeds);

        $rooms_beds_historic = \DB::table('rooms_beds_historic')->where('IdRoomsBeds', $IdRoomsBeds)->where('IdRooms', $IdRooms)->limit(2)->orderBy('IdRoomsBedsHistoric', 'DESC')->get()->toArray();

        if(!empty($rooms_beds_historic[1])):
            //save rooms beds
            $rooms_beds = RoomsBeds::find($IdRoomsBeds);
            $rooms_beds->status = $rooms_beds_historic[1]->status;
            $rooms_beds->IdUsers = $rooms_beds_historic[1]->IdUsers;
            $rooms_beds->note_users = $rooms_beds_historic[1]->note;
            $rooms_beds->save();

            return "success";
        endif;

        //save rooms beds
        $rooms_beds = RoomsBeds::find($IdRoomsBeds);
        $rooms_beds->status = 'd';
        $rooms_beds->IdUsers = NULL;
        $rooms_beds->note_users = NULL;
        $rooms_beds->save();

        return "success";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function block_store(Request $request, $IdRooms, $IdRoomsBeds)
    {
        $IdRooms = base64_decode($IdRooms);
        $IdRoomsBeds = base64_decode($IdRoomsBeds);

        //save rooms beds
        $rooms_beds = RoomsBeds::find($IdRoomsBeds);
        $rooms_beds->status = $request->input('status');
        $rooms_beds->IdUsers = NULL;
        $rooms_beds->note_users = Null;
        $rooms_beds->save();

        return "success";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request, $IdRooms, $IdRoomsBeds)
    {
        $rooms_beds = $this->rooms_beds->list_current(base64_decode($IdRoomsBeds));

        return view('admin.central_beds.transfer', [
            'rooms_beds' => $rooms_beds,
            'users' => $this->users->list_current($rooms_beds->IdUsers),
            'IdRooms' => $IdRooms,
            'IdRoomsBeds' => $IdRoomsBeds,
            'functional_units' => $this->functional_units->list_select(),
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transfer_store(Request $request, $IdRooms, $IdRoomsBeds)
    {
        $IdRooms = base64_decode($IdRooms);
        $IdRoomsBeds = base64_decode($IdRoomsBeds);
        $list_rooms_beds = $this->rooms_beds->list_current($IdRoomsBeds);

        $validator = Validator::make($request->all(), [
            'IdRoomsBeds_transfer' => ['required', 'string', 'max:11'],
            'IdRooms' => ['required', 'string', 'max:11'],
            'note' => ['required', 'string'],
        ]);

        if($validator->fails()):
            return redirect(route('central_beds.transfer', ['IdRooms' => base64_encode($IdRooms), 'IdRoomsBeds' => base64_encode($IdRoomsBeds)]))->withErrors($validator)->withInput();
        endif;

        //libera leito
        $rooms_beds = RoomsBeds::find($IdRoomsBeds);
        $rooms_beds->status = 'd';
        $rooms_beds->IdUsers = NULL;
        $rooms_beds->note_users = Null;
        $rooms_beds->save();

        //libera leito
        $rooms_beds = RoomsBeds::find($request->input('IdRoomsBeds_transfer'));
        $rooms_beds->status = 'o';
        $rooms_beds->IdUsers = $list_rooms_beds->IdUsers;
        $rooms_beds->note_users = $request->input('note');
        $rooms_beds->save();

        return "success";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transfer_beds(Request $request, $IdRooms, $IdRoomsBeds)
    {
        $rooms_beds = $this->rooms_beds->list_current(base64_decode($IdRoomsBeds));

        return view('admin.central_beds.transfer_bads', [
            'rooms_beds' => $rooms_beds,
            'IdRooms' => $IdRooms,
            'IdRoomsBeds' => $IdRoomsBeds,
            'functional_units' => $this->functional_units->list_select(),
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transfer_store_beds(Request $request, $IdRooms, $IdRoomsBeds)
    {
        $IdRooms = base64_decode($IdRooms);
        $IdRoomsBeds = base64_decode($IdRoomsBeds);

        $validator = Validator::make($request->all(), [
            'IdRooms' => ['required', 'string', 'max:11'],
            'title' => ['required', 'string'],
        ]);

        if($validator->fails()):
            return redirect(route('central_beds.transfer', ['IdRooms' => base64_encode($IdRooms), 'IdRoomsBeds' => base64_encode($IdRoomsBeds)]))->withErrors($validator)->withInput();
        endif;

        //libera leito
        $rooms_beds = RoomsBeds::find($IdRoomsBeds);
        $rooms_beds->IdRooms = $request->input('IdRooms');
        $rooms_beds->status = 'd';
        $rooms_beds->IdUsers = NULL;
        $rooms_beds->note_users = Null;
        $rooms_beds->save();

        return "success";
    }
}
