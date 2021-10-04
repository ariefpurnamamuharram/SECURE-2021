<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->date('tanggal_pembelian');
            $table->time('jam_pembelian');
            $table->string('nama');
            $table->string('pekerjaan')->nullable()->default(null);
            $table->string('instansi')->nullable()->default(null);
            $table->string('email');
            $table->string('nomor_telepon');
            $table->integer('jenis_tiket')->default(0);
            $table->string('deskripsi_tiket')->nullable()->default(null);
            $table->string('yang_mendaftarkan')->nullable()->default(null);
            $table->timestamps();

            $table->primary(['nama', 'deskripsi_tiket']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesertas');
    }
}
