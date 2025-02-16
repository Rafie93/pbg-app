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
        Schema::create('retribusi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonanimb_id')->constrained('permohonanimb');
            $table->date('tanggal_tagihan');
            $table->date('tanggal_bayar')->nullable();
            $table->integer('jumlah_tagihan');
            $table->integer('jumlah_bayar')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('status_pembayaran')->default('Belum Dibayar')->comment('Belum Dibayar, Dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retribusi');
    }
};
