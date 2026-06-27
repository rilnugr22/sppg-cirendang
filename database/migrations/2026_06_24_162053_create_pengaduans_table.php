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
    Schema::create('pengaduans', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_tiket')->unique(); // Tidak boleh ada nomor tiket yang kembar
        $table->enum('kategori', ['Porsi', 'Keterlambatan', 'Kualitas Makanan', 'Higienitas', 'Lainnya']);
        $table->text('deskripsi');
        $table->string('foto_bukti')->nullable();
        $table->string('pelapor')->default('Anonim');
        $table->enum('status', ['Terkirim', 'Dibaca', 'Diproses', 'Selesai'])->default('Terkirim');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
