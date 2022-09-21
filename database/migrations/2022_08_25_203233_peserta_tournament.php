<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PesertaTournament extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_tournament', function (Blueprint $table) {
            $table->id('id_anggota');
            $table->string('team');
            $table->string('logo');
            $table->string('anggota_1');
            $table->string('anggota_2')->nullable();
            $table->string('anggota_3')->nullable();
            $table->string('anggota_4')->nullable();
            $table->string('anggota_5')->nullable();
            $table->enum('type', ['solo', 'duo', 'squad'])->default('squad');
            $table->string('no_rekening')->nullable();
            $table->unsignedBigInteger('id_tournament');
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_peserta');
            $table->timestamps();

            $table->foreign('id_tournament')->references('id_tournament')->on('tournament');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi');
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
        Schema::dropIfExists('peserta_tournament');
    }
}
