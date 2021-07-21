<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 255);
            $table->unsignedBigInteger('id_tamu');
            $table->foreign('id_tamu')->references('id')->on('users')->onDelete('cascade');
            $table->integer('tagihan_kamar');
            $table->integer('tagihan_fnb');
            $table->integer('tagihan_ruang');
            $table->integer('tagihan_laundry');
            $table->string('status', 10);
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
        Schema::dropIfExists('billing');
    }
}
