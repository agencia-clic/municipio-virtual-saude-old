<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class ProtocolsMedication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdMedicines',
        'IdProtocols',
        'status',
    ];

    protected $primaryKey = 'IdProtocolsMedication';
    protected $table = 'protocols_medication';

    public function list($IdProtocols)
    {
        $protocols_medication = DB::table('protocols_medication')->select('protocols_medication.*', 'medicines.title as medicines', 'medication_units.title as units')->
        join('medicines', 'protocols_medication.IdMedicines', '=', 'medicines.IdMedicines')->where('protocols_medication.IdProtocols', $IdProtocols)->
        leftjoin('medication_units', 'medicines.IdMedicationUnits', '=', 'medication_units.IdMedicationUnits')->where('protocols_medication.IdProtocols', $IdProtocols);

        return array("data" => $protocols_medication->paginate(env('PAGE_NUMBER')), "count" => $protocols_medication->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('protocols_medication')->where('IdProtocolsMedication', $id)->first();
        endif;
    }

    //existe
    public function existe_email($email, $email_current)
    {
        return (!empty($email)) && $email != $email_current
            ?  DB::table('protocols_medication')->where('email', $email)->doesntExist()
            : true;
    }
}
