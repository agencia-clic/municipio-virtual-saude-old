<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Clinics extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'status',
        'IdServiceUnits',
    ];

    protected $primaryKey = 'IdClinics';

    public function list($filter)
    {
        $clinics = DB::table('clinics')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);

        if($filter['IdClinics']):
            $clinics = $clinics->where('IdClinics', $filter['IdClinics']);
        endif;

        if($filter['status']):
            $clinics = $clinics->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $clinics = $clinics->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $clinics->paginate(env('PAGE_NUMBER')), "count" => $clinics->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('clinics')->where('IdClinics', $id)->first();
        endif;
    }

    public function list_select()
    {
        return Clinics::where('status', 'a')->get();
    }
}
