<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class MedicalSpecialties extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'code',
        'status',
    ];

    protected $primaryKey = 'IdMedicalSpecialties';

    public function list($filter)
    {
        $medical_specialties = DB::table('medical_specialties');

        if($filter['IdMedicalSpecialties']):
            $medical_specialties = $medical_specialties->where('IdMedicalSpecialties', $filter['IdMedicalSpecialties']);
        endif;

        if($filter['status']):
            $medical_specialties = $medical_specialties->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $medical_specialties = $medical_specialties->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $medical_specialties->paginate(env('PAGE_NUMBER')), "count" => $medical_specialties->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('medical_specialties')->where('IdMedicalSpecialties', $id)->first();
        endif;
    }

    public function list_select()
    {
        return MedicalSpecialties::where('status', 'a')->get();
    }
}
