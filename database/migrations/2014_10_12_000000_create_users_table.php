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
            $table->string('id_users');
            $table->string('id_role');
            $table->string('nama');
            $table->string('no_telpon', 20);
            $table->text('alamat');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('ktp');
            $table->string('nik');
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
