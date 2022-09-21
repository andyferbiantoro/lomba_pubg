<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tournament extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tournament', function (Blueprint $table) {
            $table->id('id_tournament');
            $table->string('nama')->unique();
            $table->string('slug')->unique();
            $table->text('lokasi');
            $table->boolean('online')->default(true);
            $table->integer('biaya_pendaftaran');
            $table->integer('jumlah_slot');
            $table->integer('sisa_slot');
            $table->string('link_room')->nullable();
            $table->date('tgl_valid');
            $table->date('tgl_tournament');
            $table->longText('deskripsi');
            $table->string('thumbnail');
            $table->string('file')->nullable();
            $table->enum('type', ['solo', 'duo', 'squad'])->default('squad');
            $table->foreignId('id_penyelenggara')->references('id_user')->on('user');
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
        Schema::dropIfExists('tournament');
    }
}
