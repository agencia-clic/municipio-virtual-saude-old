<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class UsersDiseases extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdUsers',
        'type',
        'text',
        'IdMedicationActivePrinciples',
        'type_allergies',
        'status',
    ];

    protected $primaryKey = 'IdUsersDiseases';

    public function list($IdUsers, $type)
    {
        $users_diseases = DB::table('users_diseases')->where('type', $type)->
        select('users_diseases.*', 'medication_active_principles.title as medication_active_principles')->
        leftjoin('medication_active_principles', 'users_diseases.IdMedicationActivePrinciples', '=', 'medication_active_principles.IdMedicationActivePrinciples')->
        where('users_diseases.IdUsers', $IdUsers);

        return array("data" => $users_diseases->paginate(env('PAGE_NUMBER')), "count" => $users_diseases->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('users_diseases')->where('IdUsersDiseases', $id)->first();
        endif;
    }
}
