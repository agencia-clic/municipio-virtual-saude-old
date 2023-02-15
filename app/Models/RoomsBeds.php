<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use DB;

class RoomsBeds extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'IdRooms',
        'status',
        'title',
        'note',
        'code',
        'IdServiceUnits',
    ];

    protected $primaryKey = 'IdRoomsBeds';

    public function list($IdRooms)
    {
        $rooms_beds = RoomsBeds::where('rooms_beds.IdRooms', $IdRooms)->where('rooms_beds.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits);

        return array("data" => $rooms_beds->paginate(env('PAGE_NUMBER')), "count" => $rooms_beds->count());
    }

    public function list_central()
    {
        $rooms_beds = RoomsBeds::
        
        select('rooms_beds.*', 
        'rooms.title as rooms', 'rooms.determining_sex',
        'accommodations.title as accommodations', 
        'rooms_beds_historic.created_at as last_update',
        'users.name', 'users.sex'
        
        )->where('rooms_beds.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->

        join('rooms', 'rooms_beds.IdRooms', '=', 'rooms.IdRooms')->
        leftjoin('rooms_beds_historic', 'rooms_beds.IdRoomsBeds', '=', 'rooms_beds_historic.IdRoomsBeds')->
        leftjoin('users', 'rooms_beds_historic.IdUsers', '=', 'users.IdUsers')->
        leftjoin('accommodations', 'rooms.IdAccommodations', '=', 'accommodations.IdAccommodations')->
        groupBy('rooms_beds.IdRoomsBeds')->orderByRaw('CASE WHEN rooms_beds.status = "o" THEN 1 WHEN rooms_beds.status <> "o" THEN 2 end ASC');

        return array("data" => $rooms_beds->paginate(env('PAGE_NUMBER')), "count" => $rooms_beds->count());
    }

    public function list_current($id)
    {
        $rooms_beds = RoomsBeds::
        
        select('rooms_beds.*', 
        'rooms.title as rooms', 'rooms.determining_sex',
        'accommodations.title as accommodations', 
        'rooms_beds_historic.created_at as last_update',
        'users.name', 'users.sex'
        
        )->where('rooms_beds.IdServiceUnits', auth()->user()->units_current()->IdServiceUnits)->

        join('rooms', 'rooms_beds.IdRooms', '=', 'rooms.IdRooms')->
        leftjoin('rooms_beds_historic', 'rooms_beds.IdRoomsBeds', '=', 'rooms_beds_historic.IdRoomsBeds')->
        leftjoin('users', 'rooms_beds_historic.IdUsers', '=', 'users.IdUsers')->
        leftjoin('accommodations', 'rooms.IdAccommodations', '=', 'accommodations.IdAccommodations')->
        groupBy('rooms_beds.IdRoomsBeds')->orderBy('IdRoomsBedsHistoric', 'DESC');

        return $rooms_beds->where('rooms_beds.IdRoomsBeds', $id)->first();
    }

    //existe
    public function existe_email($email, $email_current)
    {
        return (!empty($email)) && $email != $email_current
            ?  DB::table('rooms_beds')->where('email', $email)->doesntExist()
            : true;
    }
}
