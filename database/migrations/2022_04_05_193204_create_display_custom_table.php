<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplayCustomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_custom', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedInteger('location_id');
            $table->string('name', 128)->nullable();
            $table->string('description', 512)->nullable();
            $table->string('counters', 64)->nullable();
            $table->boolean('status')->nullable()->default(true)->comment('1-active, 2-inactive');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('display_custom');
    }
}
