<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSarprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sarpras', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('kategori')->nullable();
            $table->string('nama');
            $table->integer('jumlah');
            $table->text('deskripsi');
            $table->string('photo');
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
        Schema::dropIfExists('sarpras');
    }
}
