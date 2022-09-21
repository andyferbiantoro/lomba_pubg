<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama');
            $table->string('no_hp', 15)->nullable();
            $table->string('email')->unique();
            $table->text('alamat')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'peserta', 'penyelenggara'])->default('peserta');
            $table->boolean('request_penyelenggara')->default(false);
            $table->string('bukti_tf')->nullable();
            $table->string('biaya_request')->nullable();
            $table->rememberToken();
            $table->string('foto')->nullable();
            $table->integer('max_post')->default(4);
            $table->boolean('active')->default(true);
            $table->string('google_foto')->nullable();
            $table->string('google_id')->nullable();
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
        Schema::dropIfExists('user');
    }
};
