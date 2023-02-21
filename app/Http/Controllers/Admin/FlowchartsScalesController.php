<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Flowcharts;
use App\Models\FlowchartsServiceUnits;
use App\Models\FlowchartsUsers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\Mask;
use DB;

class FlowchartsScalesController extends Controller
{
    protected $flowcharts;
    protected $flowcharts_service_units;
    protected $users;
    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->flowcharts = new Flowcharts();
        $this->flowcharts_service_units = new FlowchartsServiceUnits();
        $this->users = new User();
        $this->mask = new Mask();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $flowcharts_service_units_check = array();
        if(!empty($a = $this->flowcharts_service_units->list())):
            foreach($a as $val):
                $flowcharts_service_units_check[] = $val->IdFlowcharts;
            endforeach;
        endif;

        $users_units = User::join('users_service_units', 'users_service_units.IdUsers', '=', 'users.IdUsers')->where('users_service_units.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->whereNotExists(function ($query) {
            $query->select(DB::raw(1))->from('flowcharts_users')->whereColumn('flowcharts_users.IdUsers', 'users.IdUsers')->where('flowcharts_users.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->where('flowcharts_users.status', 'a');
        })->get();

        return view('admin.flowcharts_scales.index', [
            'flowcharts' => $this->flowcharts->list(['status' => 'a']),
            'flowcharts_service_units_check' => $flowcharts_service_units_check,
            'flowcharts_service_units' => $this->flowcharts_service_units->list(),
            'users' => $users_units,
            '_users' => $this->users,
            'mask' => $this->mask,
        ]);
    }

    public function save_flowcharts_itens(Request $request)
    {
        $flowcharts = $this->flowcharts->list(['status' => 'a']);

        if(!empty($flowcharts['data'])):

            foreach($flowcharts['data'] as $val):

                $a = true;

                if((!empty($request->input('IdFlowcharts'))) AND (in_array($val->IdFlowcharts, $request->input('IdFlowcharts'))) AND (FlowchartsServiceUnits::where('IdFlowcharts', $val->IdFlowcharts)->where('status', 'a')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->count() == 0)):
                    
                    $a = false;
                    FlowchartsServiceUnits::create([
                        'IdFlowcharts' => $val->IdFlowcharts,
                        'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
                        'status' => 'a',
                    ]);

                elseif((!empty($request->input('IdFlowcharts'))) AND !in_array($val->IdFlowcharts, $request->input('IdFlowcharts'))):

                    $a = false;
                    DB::table('flowcharts_service_units')->where('IdFlowcharts', $val->IdFlowcharts)->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->update(['status' => 'b']);
                    DB::table('flowcharts_users')->where('IdFlowcharts', $val->IdFlowcharts)->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->update(['status' => 'b']);

                elseif(empty($request->input('IdFlowcharts'))):

                    $a = false;
                    DB::table('flowcharts_service_units')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->update(['status' => 'b']);
                    DB::table('flowcharts_users')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->update(['status' => 'b']);
                endif;

                DB::table('flowcharts_users')->where('IdFlowcharts', $val->IdFlowcharts)->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->update(['status' => 'b']);

                if(($a) AND (!empty($request->input('IdUsers')) AND (!empty($request->input('IdUsers')[$val->IdFlowcharts])))):

                    foreach ($request->input('IdUsers')[$val->IdFlowcharts] as $val_users):

                        $b = explode(",", $val_users);
                        FlowchartsUsers::create([
                            'IdServiceUnits' => auth()->user()->units_current()->IdServiceUnits,
                            'IdFlowcharts' => $val->IdFlowcharts,
                            'IdFlowchartsServiceUnits' => $b[0],
                            'IdUsers' => $b[1],
                            'status' => 'a',
                        ]);
                    endforeach;

                endif;
            endforeach;
        endif;

        return redirect(route('flowcharts-scales'));
    }

    public function flowcharts_itens()
    {
        return view('admin.flowcharts_scales.flowcharts', [
            
            'mask' => $this->mask,
        ]);
    }
}