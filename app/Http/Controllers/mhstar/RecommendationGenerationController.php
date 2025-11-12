<?php

namespace App\Http\Controllers\mhstar; // Perubahan namespace

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecommendationGenerationController extends Controller // Nama controller lebih spesifik
{
    /**
     * Menghitung dan menampilkan rekomendasi siswa untuk posisi Ketua, Wakil Ketua, dan Staf.
     * Skor dihitung berdasarkan bobot kriteria yang telah ditentukan.
     *
     * @return \Illuminate\View\View
     */
    public function generateRecommendations(): View // Nama method lebih deskriptif
    {
        // Definisikan bobot dasar untuk setiap peran
        $baseWeights = [
            'ketua' => [
                'kehadiran' => 5,
                'kedisiplinan' => 4,
                'nilai_raport' => 5,
                'kerja_sama_tim' => 3,
                'kreativitas' => 4,
                'inisiatif' => 3,
            ],
            'wakil_ketua' => [
                'kehadiran' => 4,
                'kedisiplinan' => 5,
                'nilai_raport' => 4,
                'kerja_sama_tim' => 4,
                'kreativitas' => 3,
                'inisiatif' => 3,
            ],
            'staf' => [
                'kehadiran' => 3,
                'kedisiplinan' => 3,
                'nilai_raport' => 4,
                'kerja_sama_tim' => 5,
                'kreativitas' => 4,
                'inisiatif' => 5,
            ]
        ];

        // Ambil semua data penilaian siswa
        $allPenilaians = Penilaian::with('siswa')->get();

        // Buat array kosong untuk menyimpan hasil rekomendasi
        $recommendedStudents = [];

        // Lakukan perhitungan untuk setiap peran
        foreach ($baseWeights as $role => $weights) {
            $totalWeight = array_sum($weights);

            // Periksa agar tidak ada pembagian dengan nol
            if ($totalWeight === 0) {
                // Handle case where all weights are zero for a role, or set a default.
                // For simplicity, we'll skip this role or set percentageWeights to zero.
                $percentageWeights = array_fill_keys(array_keys($weights), 0);
            } else {
                // Hitung persentase bobot
                $percentageWeights = array_map(function($weight) use ($totalWeight) {
                    return $weight / $totalWeight;
                }, $weights);
            }


            // Hitung skor rekomendasi untuk setiap siswa dan urutkan
     $rankedStudents = $allPenilaians->map(function ($item) use ($percentageWeights) {
    $kehadiran = $item->kehadiran ?? 0;
    $kedisiplinan = $item->kedisiplinan ?? 0;
    $nilai_raport = $item->nilai_raport ?? 0;
    $kerja_sama_tim = $item->kerja_sama_tim ?? 0;
    $kreativitas = $item->kreativitas ?? 0;
    $inisiatif = $item->inisiatif ?? 0;

    $recom_score = 
        ($kehadiran * $percentageWeights['kehadiran']) +
        ($kedisiplinan * $percentageWeights['kedisiplinan']) +
        ($nilai_raport * $percentageWeights['nilai_raport']) +
        ($kerja_sama_tim * $percentageWeights['kerja_sama_tim']) +
        ($kreativitas * $percentageWeights['kreativitas']) +
        ($inisiatif * $percentageWeights['inisiatif']);

    return (object) [
        'siswa' => $item->siswa,
        'recom_score' => round($recom_score, 2),
    ];
})
->sortByDesc('recom_score')
->values();   // reset index dari 0,1,2,3...

            $recommendedStudents[$role] = $rankedStudents;
        }

        // Kirim semua data rekomendasi ke tampilan
        return view('mhstar.rekomendasi-admin', compact('recommendedStudents')); // Perubahan path view di sini
    }
}