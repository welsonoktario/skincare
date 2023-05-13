<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('toko_id')->constrained();
            $table->foreignId('ekspedisi_id')->constrained();
            $table->foreignId('alamat_id')->constrained();
            $table->integer('total_harga')->default(0);
            $table->integer('ongkos_pengiriman')->default(0);
            $table->enum('jenis_pembayaran', ['saldo', 'transfer'])->default('saldo');
            $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai', 'batal'])->default('pending');
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
