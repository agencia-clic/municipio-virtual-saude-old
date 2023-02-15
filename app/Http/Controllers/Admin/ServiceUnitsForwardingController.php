<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServiceUnitsForwarding;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\ServiceUnits;
use App\Models\ServiceUnitsRoles;
use DB;

class ServiceUnitsForwardingController extends Controller
{
    protected $service_units_forwarding;
    protected $service_units;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->service_units_forwarding = new ServiceUnitsForwarding();
        $this->service_units = new ServiceUnits();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($IdServiceUnits)
    {
        $IdServiceUnits = base64_decode($IdServiceUnits); 
        $service_units_forwarding = $this->service_units_forwarding->list($IdServiceUnits);

        return view('admin.service_units_forwarding.list', [
            'mask' => $this->mask,
            'service_units_forwarding' => $service_units_forwarding
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IdServiceUnits)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'IdServiceUnitsReceive' => ['required', 'int', 'max:11'],
        ]);

        if($validator->fails()):
            return redirect(route('service_units_forwarding.form', ['IdServiceUnits' => $IdServiceUnits]))->withErrors($validator)->withInput();
        endif;

        ServiceUnitsForwarding::create([
            'IdServiceUnitsReceive' => $data['IdServiceUnitsReceive'],
            'IdServiceUnits' => base64_decode($IdServiceUnits),
        ]);

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $IdServiceUnits, $IdServiceUnitsForwarding = null)
    {
        $IdServiceUnitsForwarding = base64_decode($IdServiceUnitsForwarding);
        $IdServiceUnits = base64_decode($IdServiceUnits);

        //select from units
        $service_units = $this->service_units::whereNotExists(function ($query) use ($IdServiceUnits) {
            $query->select(DB::raw(1))->from('service_units_forwarding')->
            whereColumn('service_units_forwarding.IdServiceUnitsReceive', 'service_units.IdServiceUnits')->
            where('IdServiceUnits', $IdServiceUnits);
        })->where('IdServiceUnits', '<>', $IdServiceUnits)->get();

        $service_units_forwarding = $this->service_units_forwarding->list_current($IdServiceUnitsForwarding);

        return view('admin.service_units_forwarding.form', [
            'service_units' => $service_units,
            'service_units_forwarding' => $service_units_forwarding
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ServiceUnitsForwarding::find(base64_decode($id))->delete();
    }
}
