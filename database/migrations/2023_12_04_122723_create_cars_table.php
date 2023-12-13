<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cars', function (Blueprint $table) {
            $table->id();
            $table->string('id_car');
            $table->string('id_category');
            $table->string('nama_kendaraan');
            $table->string('transmisi');
            $table->string('kapasitas');
            $table->string('img_kendaraan');
            $table->string('biaya_sewa');
            $table->integer('unit');
            $table->text('description')->nullable();
            $table->enum('status_car', ['tersedia', 'tidak tersedia']);
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
        Schema::dropIfExists('tbl_cars');
    }
}
