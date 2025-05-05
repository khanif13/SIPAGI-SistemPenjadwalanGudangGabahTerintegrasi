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
            $table->int('id')->autoIncrement();
            $table->int('gudang_id');
            $table->date('tanggal_masuk');
            $table->float('berat_gabah');
            $table->float('kadar_air');
            $table->string('sumber');
            $table->timestamps();

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
