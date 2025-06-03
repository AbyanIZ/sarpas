<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained()->onDelete('cascade');
            $table->string('nama_barang'); // Simpan nama barang snapshot saat perubahan stok
            $table->string('gambar')->nullable(); // Simpan path gambar snapshot saat perubahan stok
            $table->integer('perubahan'); // + untuk penambahan stok, - untuk pengurangan stok
            $table->timestamp('created_at')->useCurrent(); // Tanggal perubahan tercatat (otomatis waktu sekarang)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_stoks');
    }
};
