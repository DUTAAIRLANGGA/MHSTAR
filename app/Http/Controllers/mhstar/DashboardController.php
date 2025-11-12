<?php

namespace App\Http\Controllers\mhstar;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Siswa;
use App\Models\Penilaian;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard admin dengan data statistik.
     *
     * @return \Illuminate\View\View
     */
    public function Dashboard(): View
    {
        // Mengambil jumlah total siswa dari database
        $totalSiswa = Siswa::count();

        // Mengambil 10 siswa terbaik berdasarkan total_nilai
        $siswaTerbaik = Penilaian::orderByDesc('total_nilai')
            ->limit(10)
            ->with('siswa')
            ->get();
        
        // Mengambil satu siswa terbaik (yang pertama dari daftar di atas)
        $siswaTerbaikSatu = $siswaTerbaik->first();

        // Mengirimkan data ke view menggunakan fungsi compact()
        return view('mhstar.dashboard', compact('totalSiswa', 'siswaTerbaik', 'siswaTerbaikSatu'));
    }
}