<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ttd_settings', function (Blueprint $table) {
            $table->id();
            // 'kades' atau 'sekdes'
            $table->string('jabatan_key', 10)->unique();
            $table->string('nama_pejabat', 100);
            $table->string('jabatan_label', 100);
            // Path ke file gambar TTD (relatif dari storage/app/public)
            $table->string('path_ttd')->nullable();
            // Path ke file gambar stempel desa (shared, hanya satu stempel)
            $table->string('path_stempel')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ttd_settings');
    }
};
