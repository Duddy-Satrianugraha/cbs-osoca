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
        Schema::create('umpanbaliks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('pendaftaran_id');
            $table->foreignId('station_id');
            $table->text('umpanbalik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umpanbaliks');
    }
};
