<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_tidack_enkripsi');
            $table->integer('nim_nidn')->unique();
            $table->string('roles');
            $table->string('status_mhs')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->text('alamat')->nullable();
            $table->text('rt')->nullable();
            $table->text('rw')->nullable();
            $table->text('desa')->nullable();
            $table->text('kota')->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->string('photo_profile')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
