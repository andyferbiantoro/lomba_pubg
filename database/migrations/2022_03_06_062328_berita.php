<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Berita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->string('judul')->unique();
            $table->string('slug')->unique();
            $table->longText('isi');
            $table->string('tag');
            $table->string('thumbnail');
            $table->foreignId('id_admin')->references('id_user')->on('user');
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
        Schema::dropIfExists('berita');
    }
}
