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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->string('jenis_surat', 100);
            $table->string('nama', 255);
            $table->string('nik', 16);
            $table->string('jenis_kelamin', 50);
            $table->string('tempat_lahir', 100);
            $table->string('tanggal_lahir', 50);
            $table->string('kewarganegaraan', 50);
            $table->string('agama', 50);
            $table->string('pekerjaan', 100);
            $table->text('alamat');
            $table->text('keperluan');
            $table->string('tanggal_surat', 100);
            $table->string('status', 50)->default('Menunggu'); // Menunggu, Disetujui, Ditolak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
