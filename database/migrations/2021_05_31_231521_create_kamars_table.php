<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('jumlah_bed', 255);
            $table->string('tipe_bed', 255);
            $table->string('jumlah_tamu', 255);
            $table->string('tipe_tamu', 255);
            $table->enum('wifi', ['1', '0']);
            $table->enum('tv', ['1', '0']);
            $table->enum('dvd', ['1', '0']);
            $table->enum('ac', ['1', '0']);
            $table->enum('sarapan', ['1', '0']);
            $table->enum('housekeeping', ['1', '0']);
            $table->enum('telephone', ['1', '0']);
            $table->string('gambar', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kamar');
    }
}
