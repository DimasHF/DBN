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
        Schema::create('doc_orders', function (Blueprint $table) {
            $table->id();
            $table->string('id_order');
            $table->string('form')->nullable();
            $table->string('ktp')->nullable();
            $table->string('npwp')->nullable();
            $table->string('akta')->nullable();
            $table->string('izp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_orders');
    }
};
