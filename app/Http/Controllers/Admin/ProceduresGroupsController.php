<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProceduresGroups;
use App\Models\EmergencyServicesService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\User;
use App\Models\Procedures;
use DB;

class ProceduresGroupsController extends Controller
{
    protected $procedures_groups;
    protected $procedures;
    protected $mask;
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->procedures_groups = new ProceduresGroups();
        $this->mask = new Mask();
        $this->users = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($IdEmergencyServices)
    {
        $IdEmergencyServices = base64_decode($IdEmergencyServices);
        $procedures_groups = $this->procedures_groups->list($IdEmergencyServices);

        return view('admin.emergency_services_procedures.groups', [
            'mask' => $this->mask,
            'users' => $this->users,
            'procedures_groups' => $procedures_groups
        ]);
    }
}
