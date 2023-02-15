<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Cid10 extends Model
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

    protected $primaryKey = 'IdCid10';
    protected $table = "cid10";

    public function list($filter)
    {
        $cid10 = DB::table('cid10');

        if($filter['IdCid10']):
            $cid10 = $cid10->where('IdCid10', $filter['IdCid10']);
        endif;

        if($filter['status']):
            $cid10 = $cid10->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $cid10 = $cid10->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $cid10->paginate(env('PAGE_NUMBER')), "count" => $cid10->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('cid10')->where('IdCid10', $id)->first();
        endif;
    }

    public function list_select()
    {
        return Cid10::where('status', 'a')->get();
    }

    //existe
    public function existe_code($code, $code_current)
    {
        return (!empty($code)) && $code != $code_current
            ?  Cid10::where('code', $code)->doesntExist()
            : true;
    }
}
