<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('buku_id');
            $table->enum('status', ['Dipinjam', 'Dikembalikan']);
            $table->date('tgl_pinjam');
            $table->integer('lama_pinjam');
            $table->date('tgl_balik')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->string('pinjam_id');
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
        Schema::dropIfExists('pinjams');
    }
}
