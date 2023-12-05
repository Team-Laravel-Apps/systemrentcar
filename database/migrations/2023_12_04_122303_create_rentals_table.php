<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_rental', function (Blueprint $table) {
            $table->id();
            $table->string('id_rental');
            $table->string('id_pelanggan');
            $table->string('car_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('biaya');
            $table->enum('status_rental', ['pendding', 'proses', 'selesai']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_rental');
    }
}
