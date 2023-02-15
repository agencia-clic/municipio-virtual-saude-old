<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Procedures extends Model
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

    protected $primaryKey = 'IdProcedures';
    protected $table = "procedures";

    public function list($filter)
    {
        $procedures = new Procedures();

        if($filter['IdProcedures']):
            $procedures->where('IdProcedures', $filter['IdProcedures']);
        endif;

        if($filter['status']):
            $procedures->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $procedures->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $procedures->paginate(env('PAGE_NUMBER')), "count" => $procedures->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return Procedures::where('IdProcedures', $id)->first();
        endif;
    }

    public function list_select()
    {
        return Procedures::where('status', 'a')->get();
    }

    //existe
    public function existe_code($code, $code_current)
    {
        return (!empty($code)) && $code != $code_current
            ?  Procedures::where('code', $code)->doesntExist()
            : true;
    }
}
