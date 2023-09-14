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
        Schema::create('tagihan_mitras', function (Blueprint $table) {
            $table->id();
            $table->string('id_tagmit');
            $table->string('id_order');
            $table->date('tgl_tagihan')->nullable();
            $table->date('tgl_bayar')->nullable();
            $table->string('bayar')->nullable();
            $table->string('sisa')->nullable();
            $table->string('total')->nullable();
            $table->string('statustag')->default('0')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_mitras');
    }
};
