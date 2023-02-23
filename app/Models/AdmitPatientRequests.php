<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class AdmitPatientRequests extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdUsers',
        'IdUsersResponsible',
        'IdEmergencyServices',
        'status',
        'IdUsersResponsibleAdmit',
        'IdEmergencyServicesConducts',
        'IdServiceUnits',
    ];

    protected $primaryKey = 'IdAdmitPatientRequests';
    protected $table = 'admit_patient_requests';

    public function list()
    {
        $admit_patient_requests = AdmitPatientRequests::select('admit_patient_requests.*', 'users_responsible.name as responsible', 'IdUsersResponsibleAdmit', 'IdUsersResponsible', 'users_responsible_admit.name as responsible_admit', 'users_patients.name as patients')->
        leftjoin('users as users_patients', 'admit_patient_requests.IdUsers', '=', 'users_patients.IdUsers')->
        leftjoin('users as users_responsible', 'admit_patient_requests.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        leftjoin('users as users_responsible_admit', 'admit_patient_requests.IdUsersResponsibleAdmit', '=', 'users_responsible_admit.IdUsers')->
        whereIn('admit_patient_requests.status', ['w', 'a'])->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);

        return $admit_patient_requests->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($IdUsers)
    {
        return AdmitPatientRequests::select('admit_patient_requests.*', 'IdUsersResponsible', 'users_responsible.name as responsible', 'users_responsible_admit.name as responsible_admit', 'users_patients.name as patients')->
        leftjoin('users as users_patients', 'admit_patient_requests.IdUsers', '=', 'users_patients.IdUsers')->
        leftjoin('users as users_responsible', 'admit_patient_requests.IdUsersResponsible', '=', 'users_responsible.IdUsers')->
        leftjoin('users as users_responsible_admit', 'admit_patient_requests.IdUsersResponsibleAdmit', '=', 'users_responsible_admit.IdUsers')->
        whereIn('admit_patient_requests.status', ['a'])->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->where('admit_patient_requests.IdUsers', $IdUsers)->first();
    }
}
