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
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->string('id_mitra')->unique();
            $table->string('nama');
            $table->string('username');
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('nik')->nullable();
            $table->string('npwp')->nullable();
            $table->string('jalan')->nullable();
            $table->string('nomor')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kodepos')->nullable();
            $table->string('website')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->tinyInteger('statusmitra')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitras');
    }
};
