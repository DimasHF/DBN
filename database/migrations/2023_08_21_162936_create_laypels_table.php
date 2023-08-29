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
            $table->string('id_laypel');
            $table->string('id_transaksi');
            $table->string('id_pelanggan');
            $table->string('id_layanan');
            $table->string('harga')->nullable();
            $table->string('pajak')->nullable();
            $table->string('subtotal')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
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
