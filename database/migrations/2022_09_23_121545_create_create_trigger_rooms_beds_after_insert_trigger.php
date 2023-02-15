<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateTriggerRoomsBedsAfterInsertTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER rooms_beds_BEFORE_INSERT BEFORE INSERT ON rooms_beds FOR EACH ROW BEGIN
                INSERT INTO rooms_beds_historic (created_at, updated_at, IdRooms, IdRoomsBeds, status, IdServiceUnits, IdUsers, note) VALUES (NOW(), NOW(), NEW.IdRooms, NEW.IdRoomsBeds, NEW.status, NEW.IdServiceUnits, NEW.IdUsers, NEW.note_users);
            END 
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms_beds_BEFORE_INSERT');
    }
}