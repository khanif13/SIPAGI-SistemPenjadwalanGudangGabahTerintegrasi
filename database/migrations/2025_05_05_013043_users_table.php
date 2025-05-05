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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'manager_gudang', 'petani'])->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('gudangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gudang');
            $table->integer('kapasitas');
            $table->timestamps();
        });

        Schema::create('penjadwalans', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gudang_id')->references('id')->on('gudangs')->onDelete('cascade');
            $table->date('tanggal_kirim');
            $table->float('berat_gabah');
            $table->float('kadar_air');
            $table->enum('status', ['diajukan', 'diproses', 'selesai', 'ditolak']);
            $table->timestamps();
        });

        Schema::create('stok_gabahs', function (Blueprint $table) {
            $table->id();
            $table->foreign('gudang_id')->references('id')->on('gudangs')->onDelete('cascade');
            $table->date('tanggal_masuk');
            $table->float('berat_gabah');
            $table->float('kadar_air');
            $table->string('sumber');
            $table->timestamps();
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
