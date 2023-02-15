<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Medicines extends Model
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
        'amount',
        'IdMedicationAdministrations',
        'IdMedicationUnits',
        'IdMedicationDilutions',
        'IdMedicationInfusao',
        'IdMedicationActivePrinciples',
    ];

    protected $primaryKey = 'IdMedicines';

    public function list($filter)
    {
        $medicines = Medicines::select('medicines.*', 'medication_units.title as units')->join('medication_units', 'medicines.IdMedicationUnits', '=', 'medication_units.IdMedicationUnits');

        if($filter['IdMedicines']):
            $medicines = $medicines->where('IdMedicines', $filter['IdMedicines']);
        endif;

        if($filter['status']):
            $medicines = $medicines->where('medicines.status', $filter['status']);
        endif;

        if($filter['title']):
            $medicines = $medicines->where('medicines.title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $medicines->paginate(env('PAGE_NUMBER')), "count" => $medicines->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('medicines')->where('IdMedicines', $id)->first();
        endif;
    }
}
