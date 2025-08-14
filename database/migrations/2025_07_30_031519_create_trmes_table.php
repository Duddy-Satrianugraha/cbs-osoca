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
        Schema::create('trmes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jpp_id');
            $table->string('name');
            $table->string('ddewasa');
            $table->string('danak');
            $table->string('rdewasa');
            $table->string('ranak');
            $table->string('file_pp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trmes');
    }
};
