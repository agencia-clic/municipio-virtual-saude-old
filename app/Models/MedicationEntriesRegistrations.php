<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class MedicationEntriesRegistrations extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdMedicines',
        'IdMedicationEntries',
        'lote',
        'date_venc',
        'code',
        'amount',
    ];

    protected $primaryKey = 'IdMedicationEntriesRegistrations';

    public function list($filter)
    {
        $medication_entries_registrations = MedicationEntriesRegistrations::leftjoin('medicines', 'medication_entries_registrations.IdMedicines', '=', 'medicines.IdMedicines')->join('medication_units', 'medicines.IdMedicationUnits', '=', 'medication_units.IdMedicationUnits')->select('medication_entries_registrations.*', 'medicines.title as medicines', 'medication_units.title as units');

        if($filter['IdMedicationEntries']):
            $medication_entries_registrations->where('IdMedicationEntries', $filter['IdMedicationEntries']);
        endif;

        if((!empty($filter)) AND  (!empty($filter['status']))):
            $medication_entries_registrations->where('status', $filter['status']);
        endif;

        return array("data" => $medication_entries_registrations->paginate(env('PAGE_NUMBER')), "count" => $medication_entries_registrations->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('medication_entries_registrations')->where('IdMedicationEntriesRegistrations', $id)->first();
        endif;
    }
}
