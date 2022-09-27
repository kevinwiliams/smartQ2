<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduledReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_reports', function (Blueprint $table) {            
            $table->integer('id', true);
            $table->string('name', 50);
            $table->string('email_to', 4000);
            $table->boolean('active')->default(true);
            $table->integer('report_id');
            $table->string('schedule_type', 50);
            $table->dateTime('start_date');
            $table->string('schedule_info',4000);
            $table->integer('user_id');                        
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
        Schema::dropIfExists('scheduled_reports');
    }
}
