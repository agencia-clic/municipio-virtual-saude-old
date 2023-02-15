<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\HospitalizationObservation;
use App\Models\User;
use App\Http\Controllers\Controller;

use App\Helpers\Mask;

class InpatientsController extends Controller
{
    protected $mask;
    protected $hospitalization_observation;
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->mask = new Mask();
        $this->hospitalization_observation = new HospitalizationObservation();
        $this->users = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.inpatients.list', [
            'hospitalization_observation' => $this->hospitalization_observation->list(),
            'users' => $this->users,
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function observation(Request $request)
    {
        return view('admin.inpatients.list_observation', [
            'hospitalization_observation' => $this->hospitalization_observation->list_observation(['type' => ['o']]),
            'users' => $this->users,
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function revaluation(Request $request)
    {
        return view('admin.inpatients.list_revaluation', [
            'hospitalization_observation' => $this->hospitalization_observation->list_observation(['type' => ['r']]),
            'users' => $this->users,
            'mask' => $this->mask,
        ]);
    }
}
