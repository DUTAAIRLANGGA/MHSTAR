<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nama',
        'kelas',
        'jurusan',
        'jenis_kelamin',
    ];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_siswa');
    }
}