<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id'); // FK ke events
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('category')->nullable();
            $table->string('qr_token')->unique();
            $table->boolean('checkin_status')->default(false);
            $table->boolean('souvenir_status')->default(false);
            $table->dateTime('checkin_time')->nullable();
            $table->timestamps();

            // Mendefinisikan Foreign Key
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
