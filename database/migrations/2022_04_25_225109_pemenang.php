<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pemenang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemenang', function (Blueprint $table) {
            $table->id('id_pemenang');
            $table->string('judul')->unique();
            $table->string('slug')->unique();
            $table->longText('isi');
            $table->string('thumbnail');
            $table->string('team')->nullable();
            $table->string('bukti_point')->nullable();
            $table->string('norek_pemenang')->nullable();
            $table->foreignId('id_user')->references('id_user')->on('user');
            $table->foreignId('id_tournament')->references('id_tournament')->on('tournament')->nullable();
            $table->foreignId('id_peserta')->references('id_user')->on('user')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('pemenang');
    }
}
