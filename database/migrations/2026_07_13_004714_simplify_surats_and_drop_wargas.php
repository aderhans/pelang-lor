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
        Schema::table('surats', function (Blueprint $table) {
            // Drop foreign key if it exists
            $table->dropForeign(['warga_id']);
            $table->dropColumn('warga_id');
        });

        Schema::dropIfExists('wargas');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not easily reversible since wargas data is lost, but we recreate schema
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('email')->unique();
            $table->string('whatsapp')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('surats', function (Blueprint $table) {
            $table->unsignedBigInteger('warga_id')->nullable()->after('id');
            $table->foreign('warga_id')->references('id')->on('wargas')->onDelete('set null');
        });
    }
};
