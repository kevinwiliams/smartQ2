<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('location_id');
            $table->string('name', 50)->nullable();
            $table->string('description')->nullable();
            $table->string('key', 1)->nullable();
            $table->timestamps();
            $table->boolean('status')->default(true);
            $table->integer('avg_wait_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department');
    }
}
