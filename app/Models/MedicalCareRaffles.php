<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MedicalCareRaffles extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'IdUsers',
        'IdEmergencyServices',
        'IdServiceUnits',
        'IdFlowcharts',
    ];

    protected $primaryKey = 'IdMedicalCareRaffles';
}
