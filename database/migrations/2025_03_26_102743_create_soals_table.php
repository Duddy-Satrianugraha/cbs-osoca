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
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ujian_id')->constrained()->onDelete('cascade');
            $table->foreignId('sesi_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id');
            $table->foreignId('penguji_id')->nullable();
            $table->foreignId('station_id')->nullable();
            $table->string('tmps')->default(false);
            $table->string('urutan');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
