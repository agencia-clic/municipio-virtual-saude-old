<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class ProtocolsCid10 extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdCid10',
        'IdProtocols',
        'status',
    ];

    protected $primaryKey = 'IdProtocolsCid10';
    protected $table = 'protocols_cid10';

    public function list($IdProtocols)
    {
        $protocols_cid10 = DB::table('protocols_cid10')->select('protocols_cid10.*', 'cid10.title as cid10', 'cid10.code')->join('cid10', 'protocols_cid10.IdCid10', '=', 'cid10.IdCid10')->where('protocols_cid10.IdProtocols', $IdProtocols);

        return array("data" => $protocols_cid10->paginate(env('PAGE_NUMBER')), "count" => $protocols_cid10->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('protocols_cid10')->where('IdProtocolsCid10', $id)->first();
        endif;
    }

    //existe
    public function existe_email($email, $email_current)
    {
        return (!empty($email)) && $email != $email_current
            ?  DB::table('protocols_cid10')->where('email', $email)->doesntExist()
            : true;
    }
}
