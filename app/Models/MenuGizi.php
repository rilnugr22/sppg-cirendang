<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuGizi extends Model
{
    use HasFactory;

    protected $fillable = [
        'sekolah_id',
        'nama_menu',
        'porsi',
        'tanggal',
        'kalori',
        'protein',
        'lemak',
        'karbohidrat',
        'foto_menu'
    ];

    /**
     * Relasi balik ke model Sekolah (BelongsTo)
     * Menu gizi ini dimiliki oleh sekolah tertentu.
     */
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id', 'id');
    }
}