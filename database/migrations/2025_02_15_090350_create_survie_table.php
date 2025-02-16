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
        Schema::create('survie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonanimb_id')->constrained('permohonanimb')->nullable();
            $table->bigInteger('petugas_id')->nullable();
            $table->date('tanggal_berangkat');
            $table->bigInteger('kecamatan_id');
            $table->string('kelurahan_id')->nullable();
            $table->string('alamat')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->integer('fungsi_bangunan')->nullable();
            $table->string('jenis_bangunan');
            $table->string('keterangan')->nullable();
            $table->boolean('is_mangkrak')->default(false);
            $table->boolean('is_kosong')->default(false);
            $table->boolean('is_miring')->default(false);
            $table->string('foto_survie')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survie');
    }
};
