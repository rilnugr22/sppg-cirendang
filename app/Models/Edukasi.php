<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edukasi extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini di database MySQL.
     * * @var string
     */
    protected $table = 'edukasis';

    /**
     * Kolom-kolom (atribut) yang diizinkan untuk diisi secara massal 
     * melalui metode mass assignment seperti Edukasi::create([...]).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'tipe',
        'konten',
        'tanggal_publish',
    ];

    /**
     * Konversi tipe data otomatis (Casting) dari database.
     * * Memastikan kolom 'tanggal_publish' otomatis dibaca sebagai objek Carbon/Date 
     * oleh PHP sehingga mempermudah pemformatan tanggal di halaman Blade.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_publish' => 'date',
    ];
}

