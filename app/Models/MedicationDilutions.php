<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class MedicationDilutions extends Model
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

    protected $primaryKey = 'IdMedicationDilutions';

    public function list($filter)
    {
        $medication_dilutions = DB::table('medication_dilutions');

        if($filter['IdMedicationDilutions']):
            $medication_dilutions = $medication_dilutions->where('IdMedicationDilutions', $filter['IdMedicationDilutions']);
        endif;

        if($filter['status']):
            $medication_dilutions = $medication_dilutions->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $medication_dilutions = $medication_dilutions->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return $medication_dilutions->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('medication_dilutions')->where('IdMedicationDilutions', $id)->first();
        endif;
    }

    public function list_select()
    {
        return MedicationDilutions::where('status', 'a')->get();
    }
}
