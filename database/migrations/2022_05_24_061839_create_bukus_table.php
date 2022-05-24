<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id');
            $table->foreignId('penerbit_id');
            $table->string('judul');
            $table->string('isbn', 25)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('pengarang')->nullable();
            $table->integer('tahun_terbit')->nullable();
            $table->integer('jumlah_buku');
            $table->string('sampul')->nullable();
            $table->string('sampul_path')->nullable();
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
        Schema::dropIfExists('bukus');
    }
}
