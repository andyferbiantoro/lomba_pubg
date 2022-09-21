<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('team');
            $table->string('logo');
            $table->string('bukti')->nullable();
            $table->enum('status', ['pending', 'waiting', 'reject', 'valid'])->default('pending');
            $table->string('tournament');
            $table->string('peserta');
            $table->string('penyelenggara');
            $table->unsignedBigInteger('id_tournament');
            $table->unsignedBigInteger('id_penyelenggara');
            $table->unsignedBigInteger('id_peserta');
            $table->timestamps();

            $table->foreign('id_tournament')->references('id_tournament')->on('tournament');
            $table->foreign('id_penyelenggara')->references('id_user')->on('user');
            $table->foreign('id_peserta')->references('id_user')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('transaksi');
    }
}
