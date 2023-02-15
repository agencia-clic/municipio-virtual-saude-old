<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class ClassificationManchester extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdEmergencyServices',
        'IdUsersResponsible',
        'IdTopics',
        'IdTopicsChecks',
    ];

    protected $primaryKey = 'IdClassificationManchester';
    protected $table = "classification_manchester";

    public function list($IdEmergencyServices)
    {
        $classification_manchester = ClassificationManchester::where('classification_manchester.IdEmergencyServices', $IdEmergencyServices);
        return array("data" => $classification_manchester->paginate(env('PAGE_NUMBER')), "count" => $classification_manchester->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return ClassificationManchester::where('IdClassificationManchester', $id)->select('classification_manchester.*', 'cid10.title', 'cid10.code')->leftjoin('cid10', 'classification_manchester.IdCid10', '=', 'cid10.IdCid10')->first();
        endif;
    }
}