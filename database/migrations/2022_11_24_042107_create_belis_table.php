<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('belis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('id_makanan');
            $table->date('tanggal_pembelian');
            $table->integer('jumlah_pembelian');
            $table->string('jenis_pembayaran');
            $table->integer('jml_pembayaran');
            $table->string('alamat');
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
        Schema::dropIfExists('belis');
    }
}
