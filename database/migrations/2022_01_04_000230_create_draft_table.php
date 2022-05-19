<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('sarpras_id');
            $table->integer('qty');
            $table->integer('validasi_id')->default(0);
            $table->integer('kondisi')->default(0);
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
        Schema::dropIfExists('draft');
    }
}
