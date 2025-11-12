<?php

namespace App\Http\Controllers\mhstar;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PenilaianController extends Controller
{
    /**
     * Menampilkan daftar penilaian dengan opsi pengurutan dan pencarian dinamis.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
  public function index(Request $request): View
{

    $search = $request->query('search');
    $sortBy = $request->query('sortBy', 'total_nilai');
    $minTotalNilai = $request->query('min_total_nilai');
    $maxTotalNilai = $request->query('max_total_nilai');

    // Filter kriteria nilai
    $minKehadiran    = $request->query('min_kehadiran');
    $minKedisiplinan = $request->query('min_kedisiplinan');
    $minRaport       = $request->query('min_nilai_raport');
    $minKerjaSama    = $request->query('min_kerja_sama_tim');
    $minKreativitas  = $request->query('min_kreativitas');
    $minInisiatif    = $request->query('min_inisiatif');

    $validSortBy = ['total_nilai', 'kehadiran', 'kedisiplinan', 'nilai_raport', 'kerja_sama_tim', 'kreativitas', 'inisiatif'];
    if (!in_array($sortBy, $validSortBy)) {
        $sortBy = 'total_nilai';
    }

    $query = Penilaian::with('siswa');

    // Filter nama siswa
    if ($search) {
        $query->whereHas('siswa', function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $search . '%');
        });
    }
    $penilaians = $query->orderByDesc($sortBy)
        ->paginate(10)
        ->appends($request->query());

    $siswas = Siswa::all();

    return view('mhstar.penilaian', compact('penilaians', 'siswas'));
}


    /**
     * Menyimpan data penilaian baru ke database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    /**
     * Memperbarui data penilaian di database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Penilaian $penilaian
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Penilaian $penilaian): RedirectResponse
    {
        $validatedData = $request->validate([
            'kehadiran' => 'required|integer|min:0|max:100',
            'kedisiplinan' => 'required|integer|min:0|max:100',
            'nilai_raport' => 'required|integer|min:0|max:100',
            'kerja_sama_tim' => 'required|integer|min:0|max:100',
            'kreativitas' => 'required|integer|min:0|max:100',
            'inisiatif' => 'required|integer|min:0|max:100',
        ]);

        $total_sum =
            ( $validatedData['kehadiran'] * 0.10) +
            ( $validatedData['kedisiplinan'] * 0.30) + 
            ( $validatedData['nilai_raport'] * 0.10) +
            ( $validatedData['kerja_sama_tim'] * 0.15) +
            ( $validatedData['kreativitas'] * 0.10) +
            ( $validatedData['inisiatif'] * 0.25);

        $validatedData['total_nilai'] = $total_sum;

        $penilaian->update($validatedData);

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil diperbarui.');
    }

    /**
     * Menghapus data penilaian dari database.
     *
     * @param \App\Models\Penilaian $penilaian
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Penilaian $penilaian): RedirectResponse
    {
        $penilaian->delete();

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil dihapus.');
    }
}
