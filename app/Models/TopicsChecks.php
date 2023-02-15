<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class TopicsChecks extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdTopics',
        'title',
        'classification',
        'status',
    ];

    protected $primaryKey = 'IdTopicsChecks';

    public function list($IdTopics)
    {
        $topics_checks = TopicsChecks::where('topics_checks.IdTopics', $IdTopics);
        return array("data" => $topics_checks->paginate(env('PAGE_NUMBER')), "count" => $topics_checks->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return TopicsChecks::where('IdTopicsChecks', $id)->first();
        endif;
    }
}
