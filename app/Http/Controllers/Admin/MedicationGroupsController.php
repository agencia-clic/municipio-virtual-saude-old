<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MedicationGroups;
use App\Models\EmergencyServicesService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Mask;
use App\Models\User;
use App\Models\Medication;
use DB;

class MedicationGroupsController extends Controller
{
    protected $medication_groups;
    protected $medication;
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
        $this->medication_groups = new MedicationGroups();
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
        $medication_groups = $this->medication_groups->list($IdEmergencyServices);

        return view('admin.emergency_services_medications.groups', [
            'mask' => $this->mask,
            'users' => $this->users,
            'medication_groups' => $medication_groups
        ]);
    }
}
