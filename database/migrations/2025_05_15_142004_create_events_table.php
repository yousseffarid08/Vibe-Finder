<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('label');       // Category (Music, Tech, etc.)
            $table->string('title');       // Event title
            $table->text('desc');          // Description
            $table->string('location');    // City or venue
            $table->string('distance');    // e.g., '12km'
            $table->unsignedBigInteger('organizer_id')->nullable(); // Link to users table
            $table->timestamps();

            // Foreign key constraint (optional but recommended)
            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('set null');
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
