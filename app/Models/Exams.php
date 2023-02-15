<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Exams extends Model
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

    protected $primaryKey = 'IdExams';

    public function list($filter)
    {
        $exams = DB::table('exams');

        if($filter['IdExams']):
            $exams = $exams->where('IdExams', $filter['IdExams']);
        endif;

        if($filter['status']):
            $exams = $exams->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $exams = $exams->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $exams->paginate(env('PAGE_NUMBER')), "count" => $exams->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('exams')->where('IdExams', $id)->first();
        endif;
    }

    public function list_select()
    {
        return Exams::where('status', 'a')->get();
    }
}
