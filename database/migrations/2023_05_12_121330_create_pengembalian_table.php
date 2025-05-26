<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalianTable extends Migration
{
    public function up()
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('barang_id');
            $table->string('image'); // Kolom image opsional
            $table->unsignedBigInteger('peminjaman_id');
            $table->integer('jumlah');  // Kolom jumlah wajib ada sesuai kebutuhan
            $table->string('status')->default('pending');
            $table->date('tanggal_pengembalian');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('peminjaman_id')->references('id')->on(table: 'peminjamans')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengembalian');
    }
}
