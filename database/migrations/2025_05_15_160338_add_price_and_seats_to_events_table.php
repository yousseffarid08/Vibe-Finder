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
        $table->decimal('price', 8, 2)->default(0.00);
        $table->integer('seats')->default(0);
    });
    }

    public function down()
    {
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn(['price', 'seats']);
        });
    }

};
