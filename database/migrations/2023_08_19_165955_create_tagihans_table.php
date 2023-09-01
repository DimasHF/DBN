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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('id_tagihan')->nullable();
            $table->string('id_laypel')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->date('tanggal_deadline')->nullable();
            $table->string('pajak')->nullable();
            $table->string('telat')->nullable();
            $table->string('bayar')->nullable();
            $table->string('sisa')->nullable();
            $table->tinyInteger('statustagihan')->default(0)->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
