<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('token_no', 10)->nullable();
            $table->integer('location_id');
            $table->integer('client_id')->nullable();
            $table->string('client_mobile', 20)->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('counter_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('note', 512)->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->timestamp('started_at')->nullable();
            $table->boolean('is_vip')->nullable();
            $table->boolean('status')->default(false)->comment('0-pending, 1-complete, 2-stop');
            $table->boolean('sms_status')->default(false)->comment('0-pending, 1-sent, 2-quick-send');
            $table->boolean('no_show')->nullable()->default(false);
            $table->string('officer_note')->nullable();
            $table->string('user_token')->nullable();
            $table->dateTime('token_date')->nullable();
            $table->boolean('push_notifications')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token');
    }
}
