<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdmitPatientRequests;
use App\Models\EmergencyServicesConducts;
use App\Helpers\Mask;
use App\Models\User;
use DB;

class ApproveAdmissionsController extends Controller
{
    protected $mask;
    protected $admit_patient_requests;
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
        $this->admit_patient_requests = new AdmitPatientRequests();
        $this->users = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.approve_admissions.list', [
            'admit_patient_requests' => $this->admit_patient_requests->list(),
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
        return view('admin.approve_admissions.table', [
            'admit_patient_requests' => $this->admit_patient_requests->list(),
            'users' => $this->users,
            'mask' => $this->mask,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approve_reprove(Request $request, $IdAdmitPatientRequests)
    {
        $IdAdmitPatientRequests = base64_decode($IdAdmitPatientRequests);

        if($request->input('status') == "n"):
            $admit_patient_requests = AdmitPatientRequests::where('IdAdmitPatientRequests', $IdAdmitPatientRequests)->first();

            $emergency_services_conducts = EmergencyServicesConducts::find($admit_patient_requests->IdEmergencyServicesConducts);
            $emergency_services_conducts->admit_patient = NULL;
            $emergency_services_conducts->save();
        endif;

        $admit_patient_requests = AdmitPatientRequests::find($IdAdmitPatientRequests);
        $admit_patient_requests->IdUsersResponsibleAdmit = auth()->user()->IdUsers;
        $admit_patient_requests->status = $request->input('status');

        $admit_patient_requests->save();
    }

     /**
     * Remove the specified resource from index.
     * @return \Illuminate\Http\Response
     */
    public function query_current(Request $request)
    {
        $admit_patient_requests = $this->admit_patient_requests->list_current($request->input('IdUsers'));

        if(!empty($admit_patient_requests)):

            $admit_patient_requests = $admit_patient_requests->toArray();
            $admit_patient_requests['specialty_responsible'] = "";
            $admit_patient_requests['specialty_admin_responsible'] = "";
            
            if(!empty($specialty_users = $this->users->specialty_users($admit_patient_requests['IdUsersResponsible']))):
                foreach($specialty_users as $val_specialty):
                    $admit_patient_requests['specialty_responsible'] .= "• {$val_specialty->title}";
                endforeach;
            endif;

            if(!empty($specialty_users = $this->users->specialty_users($admit_patient_requests['IdUsersResponsibleAdmit']))):
                foreach($specialty_users as $val_specialty):
                    $admit_patient_requests['specialty_admin_responsible'] .= "• {$val_specialty->title}";
                endforeach;
            endif;

            $admit_patient_requests['created_at'] = date('d-m-Y H:i', strtotime($admit_patient_requests['created_at']));
            $admit_patient_requests['updated_at'] = date('d-m-Y H:i', strtotime($admit_patient_requests['updated_at']));
            return json_encode($admit_patient_requests);

        endif;

       return json_encode([]);
    }
}
