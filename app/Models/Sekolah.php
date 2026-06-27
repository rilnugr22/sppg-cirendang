<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sekolah extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi (Mass Assignment)
    protected $fillable = ['nama_sekolah', 'alamat'];

    /**
     * Relasi ke model MenuGizi (One-to-Many)
     * Sebuah sekolah memiliki banyak menu gizi.
     */
    public function menuGizis(): HasMany
    {
        return $this->hasMany(MenuGizi::class, 'sekolah_id', 'id');
    }
}