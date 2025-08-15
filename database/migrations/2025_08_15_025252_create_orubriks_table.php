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
        Schema::create('orubriks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('otemplate_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('urutan');
            $table->string('name');
            $table->text('Nilai_0')->nullable();
            $table->text('Nilai_1')->nullable();
            $table->text('Nilai_2')->nullable();
            $table->text('Nilai_3')->nullable();
            $table->integer('aktif0')->default(0);
            $table->integer('aktif1')->default(0);
            $table->integer('aktif2')->default(0);
            $table->integer('aktif3')->default(0);
            $table->integer('bobot')->default(1);
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orubriks');
    }
};
