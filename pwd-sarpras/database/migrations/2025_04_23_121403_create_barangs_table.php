<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable(); // Untuk menyimpan nama file gambar
            $table->unsignedBigInteger('kategori_id')->nullable(); // Menambahkan kolom kategori_id
            $table->integer('stock')->default(0); // Menambahkan kolom stock
            $table->timestamps();

            // Menambahkan foreign key jika ada relasi ke tabel kategoris
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
