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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama_template');
            $table->string('nomor_station');
            $table->string('judul_station');
            $table->string('tingkat_kemampuan_kasus');
            $table->string('komptensi_yang_diujikan');
            $table->string('kategori_sistem_tubuh');
            $table->text('ipu_skenario_klinik')->nullable();
            $table->text('ipu_peserta_tugas')->nullable();
            $table->text('ip_instruksi_umum')->nullable();
            $table->text('ip_ik_anamnesis')->nullable();
            $table->longText('ip_ik_p_fisik')->nullable();
            $table->longText('ip_ik_ttv')->nullable();
            $table->longText('ip_ik_p_penunjang')->nullable();
            $table->string('file_pp')->nullable();
            $table->text('ip_ik_diagnosis')->nullable();
            $table->longText('ip_ik_non_farmakoterapi')->nullable();
            $table->text('ip_ik_farmakoterapi')->nullable();
            $table->text('ip_ik_kom_edu')->nullable();
            $table->text('ip_ik_perilaku')->nullable();
            $table->text('ips_identitas')->nullable();
            $table->text('ips_rp_sekarang')->nullable();
            $table->text('ips_rp_dahulu')->nullable();
            $table->text('ips_rp_keluarga')->nullable();
            $table->text('ips_r_pribadi')->nullable();
            $table->text('ips_pertanyaan_wajib')->nullable();
            $table->text('ips_peran_wajib')->nullable();
            $table->longText('ips_molase')->nullable();
            $table->boolean('use_rmd')->default(false);
            $table->string('j_pasien')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
