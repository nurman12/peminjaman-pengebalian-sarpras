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
            $table->integer('sarpras_id');
            $table->integer('sarpras_masuk_id')->nullable();
            $table->integer('sarpras_keluar_id')->nullable();
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
