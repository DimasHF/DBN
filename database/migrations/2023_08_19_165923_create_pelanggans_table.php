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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('id_pelanggan');
            $table->string('id_mitra');
            $table->string('nama_pel');
            $table->string('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('nik')->nullable();
            $table->string('npwp')->nullable();
            $table->string('foto')->nullable();
            $table->tinyInteger('statuspel')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
