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
        Schema::create('sesis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ujian_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('jml_lokasi');
            $table->string('jml_rotasi');
            $table->string('jml_station');
            $table->string('slug');
            $table->date('tgl_ujian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesis');
    }
};
