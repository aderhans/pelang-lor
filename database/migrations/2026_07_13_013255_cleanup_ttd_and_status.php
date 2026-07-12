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
        Schema::dropIfExists('ttd_settings');
        
        Schema::table('surats', function (Blueprint $table) {
            if (Schema::hasColumn('surats', 'status')) {
                $table->dropColumn('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('ttd_settings', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan_key')->unique();
            $table->string('jabatan_label');
            $table->string('nama_pejabat');
            $table->string('path_ttd')->nullable();
            $table->string('path_stempel')->nullable();
            $table->timestamps();
        });

        Schema::table('surats', function (Blueprint $table) {
            $table->string('status')->default('Menunggu');
        });
    }
};
