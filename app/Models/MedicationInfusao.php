<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class MedicationInfusao extends Model
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

    protected $primaryKey = 'IdMedicationInfusao';
    protected $table = "medication_infusao";

    public function list($filter)
    {
        $medication_infusao = DB::table('medication_infusao');

        if($filter['IdMedicationInfusao']):
            $medication_infusao = $medication_infusao->where('IdMedicationInfusao', $filter['IdMedicationInfusao']);
        endif;

        if($filter['status']):
            $medication_infusao = $medication_infusao->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $medication_infusao = $medication_infusao->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return $medication_infusao->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('medication_infusao')->where('IdMedicationInfusao', $id)->first();
        endif;
    }

    public function list_select()
    {
        return MedicationInfusao::where('status', 'a')->get();
    }
}
