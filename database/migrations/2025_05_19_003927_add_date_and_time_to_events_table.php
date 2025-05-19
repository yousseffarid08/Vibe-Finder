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
    Schema::table('events', function (Blueprint $table) {
        $table->date('date')->nullable();
        $table->time('time')->nullable();
        $table->dropColumn('distance'); // Only if you want to remove distance from DB
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
};
