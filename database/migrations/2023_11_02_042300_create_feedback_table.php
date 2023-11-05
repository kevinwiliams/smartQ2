<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('comment');
            $table->enum('type', ['comment', 'feedback', 'suggestion'])->default('feedback');
            $table->string('user_agent')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('os_version')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('referer')->nullable();
            $table->unsignedTinyInteger('rating')->nullable();
            $table->string('category')->nullable();            
            $table->enum('source', ['web', 'email', 'app', 'other'])->nullable()->default('web');
            $table->enum('status', ['pending', 'in-progress', 'resolved'])->default('pending');            
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->text('feedback_response')->nullable();
            $table->dateTime('resolved_at')->nullable();
            $table->text('resolution_notes')->nullable();

            //timestamps
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
        Schema::dropIfExists('feedback');
    }
}
