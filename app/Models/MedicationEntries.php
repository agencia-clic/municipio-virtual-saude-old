<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class MedicationEntries extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'receipt_date',
        'IdUsersResponsible',
        'IdServiceUnits',
        'text',
        'status',
    ];

    protected $primaryKey = 'IdMedicationEntries';
    protected $table = "medication_entries";

    public function list($filter)
    {
        $medication_entries = new MedicationEntries();
        $medication_entries = $medication_entries::where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);

        if($filter['IdMedicationEntries']):
            $medication_entries = $medication_entries->where('IdMedicationEntries', $filter['IdMedicationEntries']);
        endif;

        if($filter['status']):
            $medication_entries = $medication_entries->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $medication_entries = $medication_entries->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $medication_entries->paginate(env('PAGE_NUMBER')), "count" => $medication_entries->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return MedicationEntries::where('IdMedicationEntries', $id)->first();
        endif;
    }

    public function medication_entries_registrations_count()
    {
        return $this->hasOne(MedicationEntriesRegistrations::class, 'IdMedicationEntries')->count();
    }
}
