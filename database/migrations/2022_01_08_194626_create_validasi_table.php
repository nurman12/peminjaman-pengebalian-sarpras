<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validasi', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('keperluan');
            $table->string('proposal');
            $table->date('tanggal_start');
            $table->date('tanggal_finish');
            $table->integer('validasi_ktu')->default(0);
            $table->integer('validasi_koor')->default(0);
            $table->integer('validasi_bmn')->default(0);
            $table->integer('status')->default(0);
            $table->integer('notif')->default(0);
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
        Schema::dropIfExists('validasi');
    }
}
