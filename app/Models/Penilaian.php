<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_siswa',
        'kehadiran',
        'kedisiplinan',
        'nilai_raport',
        'kerja_sama_tim',
        'kreativitas',
        'inisiatif',
        'total_nilai'
    ];

 public function siswa()
{
    return $this->belongsTo(Siswa::class, 'id_siswa');
}
    // Accessor for rata-rata nilai
    public function getRataRataNilaiAttribute()
    {
        return round($this->total_nilai / 6, 2);
    }
}
