<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->id('id_absen');
            $table->unsignedBigInteger('fk_id_users')->nullable();
            $table->string('nama_user')->nullable();
            $table->integer('masuk')->nullable();
            $table->integer('telat')->nullable();
            $table->integer('izin')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('tanggal_izin')->nullable();
            $table->time('waktu_absen')->nullable();
            $table->time('waktu_absen_keluar')->nullable();
            $table->string('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('fk_id_users')->references('id_users')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen');
    }
}
