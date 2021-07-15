<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksikamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksikamar', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 255);
            $table->unsignedBigInteger('id_tamu');
            $table->foreign('id_tamu')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_kamar');
            $table->foreign('id_kamar')->references('id')->on('kamar')->onDelete('cascade');
            $table->string('nama', 255);
            $table->date('cek_in');
            $table->date('cek_out');
            $table->string('ktp', 255);
            $table->integer('total_harga');
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
        Schema::dropIfExists('transaksikamar');
    }
}
