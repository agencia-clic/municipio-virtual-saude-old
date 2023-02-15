<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Materials extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'code',
        'status',
    ];

    protected $primaryKey = 'IdMaterials';

    public function list($filter)
    {
        $materials = DB::table('materials');

        if($filter['IdMaterials']):
            $materials = $materials->where('IdMaterials', $filter['IdMaterials']);
        endif;

        if($filter['status']):
            $materials = $materials->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $materials = $materials->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        if($filter['code']):
            $materials = $materials->where('code', $filter['code']);
        endif;

        return array("data" => $materials->paginate(env('PAGE_NUMBER')), "count" => $materials->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('materials')->where('IdMaterials', $id)->first();
        endif;
    }
}
