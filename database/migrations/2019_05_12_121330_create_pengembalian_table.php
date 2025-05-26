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
    $table->unsignedBigInteger('peminjaman_id'); // Ganti peminjaman_id -> borrowing_id
    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('barang_id');
    $table->string('image')->nullable();
    $table->text('keterangan')->nullable(); // Tambahkan ini
    $table->integer('jumlah');
    $table->string('status')->default('pending');
    $table->date('tanggal_pengembalian');
    $table->timestamps();

    // Foreign keys
    $table->foreign('peminjaman_id')->references('id')->on('peminjamen')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users');
    $table->foreign('barang_id')->references('id')->on('barangs');
});
    }

    public function down()
    {
        Schema::dropIfExists('pengembalian');
    }
}
