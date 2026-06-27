<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimSppg extends Model
{
    use HasFactory;

    /**
     * Nama tabel MySQL secara eksplisit.
     * Disesuaikan dengan tabel di database MySQL Anda.
     *
     * @var string
     */

    /**
     * Kolom yang boleh diisi secara langsung (Mass Assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
    ];
}