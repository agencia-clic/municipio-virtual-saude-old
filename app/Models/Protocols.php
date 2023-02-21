<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Protocols extends Model
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
    ];

    protected $primaryKey = 'IdProtocols';

    public function list($filter)
    {
        $protocols = DB::table('protocols');

        if($filter['IdProtocols']):
            $protocols = $protocols->where('IdProtocols', $filter['IdProtocols']);
        endif;

        if($filter['status']):
            $protocols = $protocols->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $protocols = $protocols->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return $protocols->paginate(env('PAGE_NUMBER'));
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('protocols')->where('IdProtocols', $id)->first();
        endif;
    }

    public function list_select()
    {
        return Protocols::where('status', 'a')->get();
    }
}
