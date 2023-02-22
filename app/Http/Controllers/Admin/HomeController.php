<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmergencyServices;
use App\Models\EmergencyServicesForwardInternal;
use App\Models\HospitalizationObservation;

class HomeController extends Controller
{

    protected $mask;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('home',[
            'emergency_services_screenings' => EmergencyServices::where('status', 'a')->where('types', 'acol')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits ?? 0)->count(),
            'emergency_services_forward_internal' => EmergencyServicesForwardInternal::where('status', 'a')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits ?? 0)->count(),
            'observation' => HospitalizationObservation::where('status', 'a')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits ?? 0)->where('type', 'o')->count(),
            'internal' => HospitalizationObservation::where('status', 'h')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits ?? 0)->where('type', 'o')->count(),
        ]);
    }
}