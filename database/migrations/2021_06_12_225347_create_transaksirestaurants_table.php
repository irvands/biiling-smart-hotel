<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksirestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksirestaurants', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 255);
            $table->unsignedBigInteger('id_tamu');
            $table->foreign('id_tamu')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_makanan');
            $table->foreign('id_makanan')->references('id')->on('restaurant')->onDelete('cascade');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('total_harga');
            $table->string('status', 255);
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
        Schema::dropIfExists('transaksirestaurants');
    }
}
