<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id')->index('FK_user_locations');
            $table->string('firstname', 25)->nullable();
            $table->string('lastname', 25)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('password')->nullable();
            $table->string('api_token', 80)->nullable()->unique();
            $table->integer('department_id')->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('photo', 500)->nullable();
            $table->boolean('user_type')->default(true)->comment('1=officer, 2=staff, 3=client, 5=admin');
            $table->string('remember_token')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('otp', 20)->nullable();
            $table->boolean('status')->default(true)->comment('1=active,2=inactive');
            $table->string('user_token', 500)->nullable();
            $table->dateTime('token_date')->nullable();
            $table->boolean('push_notifications')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
