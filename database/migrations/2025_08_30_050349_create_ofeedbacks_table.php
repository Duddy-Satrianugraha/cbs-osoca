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
        Schema::create('ofeedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oujian_id');
            $table->foreignId('station_id');
            $table->foreignId('peserta_id');
            $table->string('qrpeserta');
            $table->string('nama');
            $table->string('npm');
            $table->text('feedback')->nullable();
            $table->boolean('is_sent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofeedbacks');
    }
};
