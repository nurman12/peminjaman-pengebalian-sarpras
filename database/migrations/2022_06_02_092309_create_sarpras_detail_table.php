<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSarprasDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sarpras_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('draft_id')->nullable();
            $table->integer('sarpras_id');
            $table->date('tanggal');
            $table->string('jenis');
            $table->integer('jumlah');
            $table->integer('hilang')->default(0);
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('sarpras_detail');
    }
}
