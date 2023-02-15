<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Accommodations extends Model
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
        'IdServiceUnits',
    ];

    protected $primaryKey = 'IdAccommodations';

    public function list($filter)
    {
        $accommodations = DB::table('accommodations')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);

        if($filter['IdAccommodations']):
            $accommodations = $accommodations->where('IdAccommodations', $filter['IdAccommodations']);
        endif;

        if($filter['status']):
            $accommodations = $accommodations->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $accommodations = $accommodations->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $accommodations->paginate(env('PAGE_NUMBER')), "count" => $accommodations->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('accommodations')->where('IdAccommodations', $id)->first();
        endif;
    }

    public function list_select()
    {
        return Accommodations::where('status', 'a')->get();
    }
}
