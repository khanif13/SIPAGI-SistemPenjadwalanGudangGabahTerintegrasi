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
        Schema::create('penjadwalans', function (Blueprint $table) {
            $table->int('id')->autoIncrement();
            $table->int('user_id');
            $table->int('gudang_id');
            $table->date('tanggal_kirim');
            $table->float('berat_gabah');
            $table->float('kadar_air');
            $table->enum('status', ['diajukan', 'diproses', 'selesai', 'ditolak']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gudang_id')->references('id')->on('gudangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
