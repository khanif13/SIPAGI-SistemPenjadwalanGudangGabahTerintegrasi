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
        Schema::create('stok_gabahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gudang_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('tanggal_masuk');
            $table->float('berat_gabah');
            $table->float('kadar_air');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('gudang_id')->references('id')->on('gudangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_gabahs');
    }
};
