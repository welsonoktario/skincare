<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('toko_id')->constrained();
            $table->foreignId('etalase_id')->nullable()->constrained();
            $table->foreignId('kategori_id')->constrained();
            $table->string('nama');
            $table->text('deskripsi');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->integer('harga')->default(1);
            $table->enum('jenis_diskon', ['persen', 'nominal'])->nullable();
            $table->integer('nominal_diskon')->nullable();
            $table->integer('stok')->default(0);
            $table->integer('berat')->default(0);
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
        Schema::dropIfExists('barangs');
    }
}
