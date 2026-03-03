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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // FK ke users
            $table->string('title')->nullable();
            $table->string('groom_name');
            $table->string('bride_name');
            $table->date('event_date');
            $table->string('location_name');
            $table->text('location_maps_url')->nullable();
            $table->string('theme')->nullable();
            $table->timestamps();

            // Mendefinisikan Foreign Key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
