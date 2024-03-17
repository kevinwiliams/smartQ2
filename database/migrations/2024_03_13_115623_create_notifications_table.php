<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {                        
            $table->id(); // Auto-incremental primary key
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('recipient_id');
            $table->unsignedBigInteger('location_id');
            $table->string('recipient', 200); //Stores customer identifier: email address or phone number
            $table->enum('channel', ['sms', 'email', 'whatsapp','push']);            
            $table->string('subject', 200)->nullable();
            $table->text('message')->nullable();
            $table->timestamp('timestamp')->useCurrent();
            $table->string('status', 20)->default('Pending');
            $table->unsignedBigInteger('interaction_id')->nullable();
            $table->text('interaction_message')->nullable();            
            $table->text('response')->nullable();
                        
            // Indexes
            // $table->index(['sender_id', 'recipient_id', 'channel', 'timestamp','location_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
