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
        Schema::create('penerbitan_imb', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_imb')->unique();
            $table->foreignId('permohonanimb_id')->constrained('permohonanimb')->onDelete('cascade');
            $table->date('tanggal_penerbitan');
            $table->string('penanda_tangan');
            $table->string('jabatan_penanda_tangan');
            $table->string('nip_penanda_tangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerbitan_imb');
    }
};
