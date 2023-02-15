<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmergencyServices;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class MedicalCareLottery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdUsers',
        'IdEmergencyServices',
        'status',
    ];

    protected $primaryKey = 'IdMedicalCareLottery';
    protected $table = 'medical_care_lottery';

    public function list()
    {
        $medical_care_lottery_count = MedicalCareLottery::select('medical_care_lottery.IdEmergencyServices')->where('medical_care_lottery.IdUsers', auth()->user()->IdUsers)->whereIn('medical_care_lottery.status', ['a'])->join('emergency_services', 'medical_care_lottery.IdEmergencyServices', '=', 'emergency_services.IdEmergencyServices')->where(function($q) {
            $q->where('medical_care_lottery.created_at', '>=', $this->date())->orWhere('emergency_services.IdUsersResponsibleMedicare', auth()->user()->IdUsers);
        })->groupBy('medical_care_lottery.IdEmergencyServices')
        ->count();

        if(($medical_care_lottery_count == 0) AND (auth()->user()->active_attendance == "a")):
            $this->lottery();
        endif;

        $medical_care_lottery = MedicalCareLottery::select('medical_care_lottery.IdEmergencyServices')->where('medical_care_lottery.IdUsers', auth()->user()->IdUsers)->whereIn('medical_care_lottery.status', ['a', 'p'])->
        join('emergency_services', 'medical_care_lottery.IdEmergencyServices', '=', 'emergency_services.IdEmergencyServices')->

        where(function($q) {
            $q->where('medical_care_lottery.created_at', '>=', $this->date())->orWhere('emergency_services.IdUsersResponsibleMedicare', auth()->user()->IdUsers);
        })->get()->toArray();

        $data = array();
        if(!empty($medical_care_lottery)):
            foreach ($medical_care_lottery as $value):
                $data[] = $value['IdEmergencyServices'];
            endforeach;
        endif;

        return $data;
    }

    protected function lottery()
    {
        $specialties_care = auth()->user()->specialties_care_array();

        if($specialties_care):
            $emergency_services = DB::table('view_emergency_services_medical_care')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->whereIn('IdMedicalSpecialties', $specialties_care)->
            whereNotExists(function ($query) {
                $query->select(DB::raw(true))->from('medical_care_lottery')->
                whereColumn('medical_care_lottery.IdEmergencyServices', 'view_emergency_services_medical_care.IdEmergencyServices')->
                whereIn('medical_care_lottery.status', ['a', 'p'])->where(function($q) {
                    $q->where('medical_care_lottery.created_at', '>=', $this->date())->orWhere('view_emergency_services_medical_care.IdUsersResponsibleMedicare', auth()->user()->IdUsers);
                });
            })->get()->toArray();

            if((!empty($emergency_services)) and (!empty($emergency_services[0]))):
                MedicalCareLottery::create([
                    'IdEmergencyServices' => $emergency_services[0]->IdEmergencyServices,
                    'status' => 'a',
                    'IdUsers' => auth()->user()->IdUsers
                ]);
            endif;
        endif;
    }

    protected function date()
    {
        $date = new \DateTime;
        $date->modify('-10 minutes');
        return $date->format('Y-m-d H:i:s');
    }
}
