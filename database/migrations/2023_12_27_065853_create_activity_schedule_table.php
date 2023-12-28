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
        Schema::create('activity_schedule', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name');
            $table->string('description');
            $table->string('image');
            $table->date('activity_date');
            $table->time('activity_time');
            $table->string('location');
            $table->foreignId('author_id')->constrained('users')->where('role', 'contributor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_schedule');
    }
};
