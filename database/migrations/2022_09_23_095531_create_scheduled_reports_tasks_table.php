<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledReportsTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_reports_tasks', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('schedule_id');
            $table->dateTime('run_time');
            $table->dateTime('executed_time')->nullable();
            $table->boolean('success')->default(false);
            $table->string('response', 4000)->nullable();
            $table->string('notified', 4000)->nullable();
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
        Schema::dropIfExists('scheduled_reports_tasks');
    }
}
