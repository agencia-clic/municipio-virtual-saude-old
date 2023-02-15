<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class Topics extends Model
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

    protected $primaryKey = 'IdTopics';

    public function list($filter)
    {
        $topics = DB::table('topics');

        if($filter['IdTopics']):
            $topics = $topics->where('IdTopics', $filter['IdTopics']);
        endif;

        if($filter['status']):
            $topics = $topics->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $topics = $topics->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $topics->paginate(env('PAGE_NUMBER')), "count" => $topics->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('topics')->where('IdTopics', $id)->first();
        endif;
    }

    public function list_select()
    {
        return Topics::where('status', 'a')->get();
    }

    public function topics_checks()
    {
        return $this->hasOne(TopicsChecks::class, 'IdTopics')->select('title', 'IdTopicsChecks');
    }
}
