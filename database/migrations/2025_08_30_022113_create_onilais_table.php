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
        Schema::create('onilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oujian_id');
            $table->foreignId('station_id');
            $table->foreignId('sesi_id');
            $table->foreignId('peserta_id');
            $table->string('qrpeserta');
            $table->string('nama');
            $table->string('npm');
            $table->string('skor');
            $table->string('jumlah');
            $table->string('nilai');
            $table->timestamps();

             $table->unique(['oujian_id', 'station_id', 'qrpeserta'], 'onilai_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onilais');
    }
};
