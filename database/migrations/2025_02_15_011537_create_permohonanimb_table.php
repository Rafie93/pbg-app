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
        Schema::create('permohonanimb', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->unique();
            $table->date('tanggal_permohonan');
            $table->bigInteger('pemohon_id');
            $table->string('jenis_permohonan');
            $table->string('pemilik_bangunan');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('alamat')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->integer('fungsi_bangunan')->nullable();
            $table->string('luas_bangunan');
            $table->integer('jumlah_lantai');
            $table->integer('tinggi_bangunan')->nullable();
            $table->string('jenis_bangunan');
            $table->string('kondisi_bangunan')->default('Sudah Berdiri')->comment('Sudah Berdiri, Belum Berdiri, Sedang Dibangun, Renovasi');
            $table->string('durasi_pemanfaatan')->default('> 5 Tahun')->comment('< 5 Tahun, > 5 Tahun');
            $table->string('status_permohonan')->default('Diajukan')->comment('Diajukan,Diproses, Diterima, Ditolak');
            $table->string('foto_bangunan')->nullable();
            $table->string('keterangan')->nullable();
            // foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonanimb');
    }
};
