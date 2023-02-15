<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics_checks', function (Blueprint $table) {
            $table->id('IdTopicsChecks');
            $table->text('title');
            $table->integer('IdTopics');
            $table->index(['IdTopics']);
            $table->enum('classification', ['zero_priority', 'one_priority', 'two_priority', 'tree_priority'])->default('zero_priority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics_checks');
    }
}
