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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('id_purchase_order')->unique();
            $table->string('id_mitra');
            $table->date('tanggal');
            $table->string('form')->nullable();
            $table->string('spk')->nullable();
            $table->string('ba')->nullable();
            $table->string('ktp')->nullable();
            $table->string('npwp')->nullable();
            $table->string('akta')->nullable();
            $table->string('izp')->nullable();
            $table->tinyInteger('statuspo')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
