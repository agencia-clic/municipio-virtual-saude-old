<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class MedicationUnits extends Model
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

    protected $primaryKey = 'IdMedicationUnits';

    public function list($filter)
    {
        $medication_units = DB::table('medication_units');

        if($filter['IdMedicationUnits']):
            $medication_units = $medication_units->where('IdMedicationUnits', $filter['IdMedicationUnits']);
        endif;

        if($filter['status']):
            $medication_units = $medication_units->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $medication_units = $medication_units->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $medication_units->paginate(env('PAGE_NUMBER')), "count" => $medication_units->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('medication_units')->where('IdMedicationUnits', $id)->first();
        endif;
    }

    public function list_select()
    {
        return MedicationUnits::where('status', 'a')->get();
    }
}
