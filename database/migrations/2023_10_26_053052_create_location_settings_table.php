<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('location_id');
            $table->string('key', 50);
            $table->string('value', 500)->nullable()->default(null);
            $table->timestamps();
            
            $table->primary('id');
            $table->index(['location_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location_settings');
    }
}
