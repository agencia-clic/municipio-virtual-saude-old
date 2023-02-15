<?php

namespace App\Http\Controllers\Admin;

use App\Events\channelCall;
use App\Events\channelScreenings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Helpers\Mask;

class CallController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($IdEmergencyServices)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);

        $call = Call::where('IdEmergencyServices', $IdEmergencyServices)->
        select('call.*','users_responsible.name as responsible')->
        leftjoin('users as users_responsible', 'call.IdUsersResponsible', '=', 'users_responsible.IdUsers')
        ->paginate(env('PAGE_NUMBER'));

        return view('admin.call.list', [
            'layout' => ['menu' => true, 'header' => true],
            'call' => $call,
            'mask' => $this->mask,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function screen(Request $request)
    {
        return view('admin/call/screen',[
            'layout' => ['menu' => true, 'header' => true]
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request, $IdEmergencyServices, $IdUsers)
    {
        $call = new call();
        $call->IdServiceUnits = auth()->user()->units_current()->IdServiceUnits;
        $call->IdEmergencyServices = base64_decode($IdEmergencyServices);
        $call->IdUsersResponsible = auth()->user()->IdUsers;
        $call->IdUsers = base64_decode($IdUsers);
        $call->sala = $request->input('sala');
        $call->save();

        broadcast(new channelCall(auth()->user()->units_current()->IdServiceUnits));
        broadcast(new channelScreenings(auth()->user()->units_current()->IdServiceUnits));
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function historic(Request $request)
    {
        return view('admin/call/historic',[
            'call' => Call::where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->select('call.*', 'users.name as user')->leftjoin('users', 'call.IdUsers', '=', 'users.IdUsers')->orderBy('IdCall', 'DESC')->get(),
            'layout' => ['menu' => true, 'header' => true]
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function call_current(Request $request)
    {
        return json_encode(Call::where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->select('call.*', 'users.name as user')->leftjoin('users', 'call.IdUsers', '=', 'users.IdUsers')->limit(1)->orderBy('IdCall', 'desc')->get()->toArray());
    }
}