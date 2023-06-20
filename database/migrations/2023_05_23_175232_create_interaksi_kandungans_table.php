<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteraksiKandungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interaksi_kandungans', function (Blueprint $table) {
            $table->foreignId('kandungan_satu_id')
                ->constrained('kandungans')
                ->cascadeOnDelete();
            $table->foreignId('kandungan_dua_id')
                ->constrained('kandungans')
                ->cascadeOnDelete();
            $table->enum('jenis_interaksi', ['baik', 'buruk']);
            $table->text('deskripsi_interaksi')->nullable();
            $table->text('sumber')->nullable();
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
        Schema::dropIfExists('interaksi_kandungans');
    }
}
