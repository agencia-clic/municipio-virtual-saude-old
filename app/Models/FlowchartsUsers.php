<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class FlowchartsUsers extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdUsers',
        'IdServiceUnits',
        'IdFlowcharts',
        'IdFlowchartsServiceUnits',
        'status',
    ];

    protected $primaryKey = 'IdFlowchartsUsers';
}
