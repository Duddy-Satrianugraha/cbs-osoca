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
        Schema::create('otemplates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama_template');
            $table->string('nomor_station');
            $table->string('judul_station');
            $table->longText('soal')->nullable();
            $table->longText('tugas_mhs')->nullable();
            $table->longText('mininotes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otemplates');
    }
};
