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
        Schema::create('laypels', function (Blueprint $table) {
            $table->id();
            $table->string('id_laypel')->unique();
            $table->string('id_pelanggan');
            $table->string('id_layanan');
            $table->date('tanggal')->nullable();
            $table->string('pajak')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laypels');
    }
};
