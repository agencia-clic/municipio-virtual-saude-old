<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateTriggerRoomsBedsAfterUpdateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER rooms_beds_AFTER_UPDATE AFTER UPDATE ON rooms_beds FOR EACH ROW BEGIN
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
        Schema::dropIfExists('create_trigger_rooms_beds_after_update_trigger');
    }
}
