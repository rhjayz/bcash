<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masakans', function (Blueprint $table) {
            $table->increments('id_masakan');
            $table->string('masakan');
            $table->integer('harga');
            $table->string('jenis');
            $table->string('gambar');
            $table->string('status_masakan');
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
        Schema::dropIfExists('masakans');
    }
}
