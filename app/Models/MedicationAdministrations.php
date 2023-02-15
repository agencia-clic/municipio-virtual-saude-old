<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class MedicationAdministrations extends Model
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
    ];

    protected $primaryKey = 'IdMedicationAdministrations';

    public function list($filter)
    {
        $medication_administrations = DB::table('medication_administrations');

        if($filter['IdMedicationAdministrations']):
            $medication_administrations = $medication_administrations->where('IdMedicationAdministrations', $filter['IdMedicationAdministrations']);
        endif;

        if($filter['status']):
            $medication_administrations = $medication_administrations->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $medication_administrations = $medication_administrations->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $medication_administrations->paginate(env('PAGE_NUMBER')), "count" => $medication_administrations->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('medication_administrations')->where('IdMedicationAdministrations', $id)->first();
        endif;
    }

    public function list_select()
    {
        return MedicationAdministrations::where('status', 'a')->get();
    }
}
