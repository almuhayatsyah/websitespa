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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Identitas Situs
            $table->string('nama_situs')->nullable();
            $table->string('slogan')->nullable();
            $table->text('deskripsi_situs')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('gambar_og')->nullable();

            // Informasi Perusahaan
            $table->string('nama_perusahaan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('telepon')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();

            // Jam Operasional (JSON: [{hari: "Senin-Jumat", jam: "08:00-17:00"}, ...])
            $table->json('jam_operasional')->nullable();

            // Media Sosial (JSON: {facebook: "", instagram: "", youtube: "", tiktok: ""})
            $table->json('media_sosial')->nullable();

            // SEO (JSON: {keywords: "", author: "", google_analytics: ""})
            $table->json('meta_seo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
