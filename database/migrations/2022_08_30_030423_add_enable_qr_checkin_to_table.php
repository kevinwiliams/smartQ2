<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnableQrCheckinToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('display', function (Blueprint $table) {
            $table->boolean('enable_qr_checkin')->default(false);            
            $table->string('title', 100);
            $table->string('timezone',32)->default('America/Bogota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('display', function (Blueprint $table) {
            $table->dropColumn('enable_qr_checkin');
            $table->dropColumn('title');
            $table->dropColumn('timezone');
        });
    }
}
