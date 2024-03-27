<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerRatingsTable extends Migration
{
/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_ratings', function (Blueprint $table) {
            $table->id();            
            $table->string('user_id');
            $table->string('mobile');
            $table->integer('token_id')->nullable();
            $table->integer('current_step');
            $table->integer('max_step');
            $table->text('config');
            $table->string('last_context')->nullable();
            $table->enum('status', ['Pending', 'Completed', 'Rejected'])->default('Pending');
            $table->text('additional_comments')->nullable();
            
            $table->timestamps();
        });

        Schema::create('rating_metrics', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_rating_id');
            $table->integer('metric_id');
            $table->unsignedTinyInteger('rating');
            $table->timestamps();
        });

        Schema::create('metrics_setup', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->integer('step');
            $table->text('description')->nullable();
            $table->text('config')->nullable();
            $table->boolean('active');
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
        Schema::dropIfExists('metrics_setup');
        Schema::dropIfExists('rating_metrics');
        Schema::dropIfExists('customer_ratings');
    }
}
