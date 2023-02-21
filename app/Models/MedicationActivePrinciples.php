<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class MedicationActivePrinciples extends Model
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

    protected $primaryKey = 'IdMedicationActivePrinciples';

    public function list($filter)
    {
        $medication_active_principles = DB::table('medication_active_principles');

        if($filter['IdMedicationActivePrinciples']):
            $medication_active_principles = $medication_active_principles->where('IdMedicationActivePrinciples', $filter['IdMedicationActivePrinciples']);
        endif;

        if($filter['status']):
            $medication_active_principles = $medication_active_principles->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $medication_active_principles = $medication_active_principles->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return $medication_active_principles->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('medication_active_principles')->where('IdMedicationActivePrinciples', $id)->first();
        endif;
    }

    public function list_select()
    {
        return MedicationActivePrinciples::where('status', 'a')->get();
    }
}
