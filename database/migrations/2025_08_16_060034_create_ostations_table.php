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
        Schema::create('ostations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oujian_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('urutan');
            $table->string('name');
            $table->string('qrstation');
            $table->foreignId('penguji_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ostations');
    }
};
