<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    /**
     * Nama tabel MySQL secara eksplisit.
     *
     * @var string
     */

    /**
     * Atribut yang boleh diisi secara massal (Mass Assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_tiket',
        'kategori',
        'deskripsi',
        'pelapor',
        'status',
        'foto_bukti',
    ];
}