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
    Schema::create('menu_gizis', function (Blueprint $table) {
        $table->id();
        // Membuat relasi foreign key ke tabel sekolahs
        $table->foreignId('sekolah_id')->constrained('sekolahs')->onDelete('cascade');
        
        $table->string('nama_menu');
        $table->integer('porsi');
        $table->date('tanggal');
        $table->string('kalori');
        $table->string('protein');
        $table->string('lemak');
        $table->string('karbohidrat');
        $table->string('foto_menu')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_gizis');
    }
};
