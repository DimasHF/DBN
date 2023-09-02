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
        Schema::create('bayars', function (Blueprint $table) {
            $table->id();
            $table->string('id_bayar');
            $table->string('id_laypel');
            $table->date('tanggal_bayar');
            $table->date('tanggal_telat');
            $table->integer('total');
            $table->string('statusbayar')->default('1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bayars');
    }
};
