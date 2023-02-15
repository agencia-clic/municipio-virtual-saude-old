<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class SpecialtyCategories extends Model
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

    protected $primaryKey = 'IdSpecialtyCategories';

    public function list($filter)
    {
        $specialty_categories = DB::table('specialty_categories');

        if($filter['IdSpecialtyCategories']):
            $specialty_categories = $specialty_categories->where('IdSpecialtyCategories', $filter['IdSpecialtyCategories']);
        endif;

        if($filter['status']):
            $specialty_categories = $specialty_categories->where('status', $filter['status']);
        endif;

        if($filter['title']):
            $specialty_categories = $specialty_categories->where('title', 'LIKE', "%{$filter['title']}%");
        endif;

        return array("data" => $specialty_categories->paginate(env('PAGE_NUMBER')), "count" => $specialty_categories->count());
    }

    public function list_current($id)
    {
        if(!empty($id)):
            return DB::table('specialty_categories')->where('IdSpecialtyCategories', $id)->first();
        endif;
    }

    public function list_select()
    {
        return SpecialtyCategories::where('status', 'a')->get();
    }
}
