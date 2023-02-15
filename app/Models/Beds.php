<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Beds extends Model
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

    protected $primaryKey = 'IdBeds';

    public function list($filter)
    {
        $beds = DB::table('beds')->where('IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);

        if($filter['IdBeds']):
            $beds = $beds->where('IdBeds', $filter['IdBeds']);
        endif;

        if($filter['status']):
            $beds = $beds->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $beds = $beds->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $beds->paginate(env('PAGE_NUMBER')), "count" => $beds->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('beds')->where('IdBeds', $id)->first();
        endif;
    }

    public function list_select()
    {
        return Beds::where('status', 'a')->get();
    }
}
