<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->datetime('scheduled_start_time');
            $table->datetime('scheduled_finish_time');
            $table->datetime('actual_start_time')->nullable();
            $table->datetime('actual_finish_time')->nullable();
            $table->longText('comments')->nullable();
            $table->integer('service_id');
            $table->integer('client_id');
            $table->integer('user_id');
            $table->integer('location_id');
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
        Schema::dropIfExists('appointments');
    }
}
