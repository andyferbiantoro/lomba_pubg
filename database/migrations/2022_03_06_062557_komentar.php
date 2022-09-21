<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Komentar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('komentar', function (Blueprint $table) {
            $table->id('id_komentar');
            $table->text('komentar');
            $table->foreignId('id_berita')->references('id_berita')->on('berita')->onDelete('cascade');
            $table->foreignId('id_user')->references('id_user')->on('user')->onDelete('cascade');
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
        Schema::dropIfExists('komentar');
    }
}
