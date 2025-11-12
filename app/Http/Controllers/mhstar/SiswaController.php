<?php

namespace App\Http\Controllers\mhstar;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Penilaian;
class SiswaController extends Controller
{
    /**
     * Menampilkan daftar semua siswa dengan paginasi dan fitur filter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    
   public function index(Request $request): View
{
    // Ambil input filter dari URL
    $jurusan = $request->query('jurusan');
    $jenisKelamin = $request->query('jenis_kelamin');
    $search = $request->query('search'); // Tambahan untuk pencarian nama & kelas

    // Query awal
    $query = Siswa::query();

    // Filter jurusan
    if ($jurusan) {
        $query->where('jurusan', $jurusan);
    }

    // Filter jenis kelamin
    if ($jenisKelamin) {
        $query->where('jenis_kelamin', 'LIKE', trim($jenisKelamin));
    }

    // Filter pencarian nama dan kelas
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('nama', 'LIKE', "%{$search}%")
              ->orWhere('kelas', 'LIKE', "%{$search}%");
        });
    }

    // Pagination
    $siswas = $query->orderBy('nama')
        ->paginate(10)
        ->appends(request()->query());

    return view('mhstar.siswa', compact('siswas', 'jurusan', 'jenisKelamin', 'search'));
}


    /**
     * Menyimpan data siswa baru ke database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
   public function store(Request $request): RedirectResponse
{
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'kelas' => 'required|string',
        'jurusan' => 'required|string',
        'jenis_kelamin' => 'required|string',
    ]);

    // Simpan siswa baru
    $siswa = Siswa::create($validatedData);

    // Buat data penilaian default dengan nilai 0
    Penilaian::create([
        'id_siswa'       => $siswa->id,   // FK ke tabel siswa
        'kehadiran'      => 0,
        'kedisiplinan'   => 0,
        'nilai_raport'   => 0,
        'kerja_sama_tim' => 0,
        'kreativitas'    => 0,
        'inisiatif'      => 0,
        'total_nilai'=> 0,
    ]);

    return redirect()->route('siswa.index')
        ->with('success', 'Data siswa berhasil ditambahkan dan penilaian awal dibuat.');
}

        // Perbaikan: Gunakan 'siswa' untuk redirect ke halaman daftar siswa

    /**
     * Menampilkan form untuk mengedit data siswa.
     *
     * Catatan: Karena Anda menggunakan modal, method ini mungkin tidak digunakan
     * secara langsung, tetapi kodenya sudah benar jika Anda ingin menggunakannya
     * untuk halaman edit terpisah.
     */
    public function edit(Siswa $siswa): View
    {
        return view('mhstar.siswa', compact('siswa'));
    }

    /**
     * Memperbarui data siswa di database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Siswa $siswa
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Siswa $siswa): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'jenis_kelamin' => 'required|string',
        ]);

        $siswa->update($validatedData);

        // Perbaikan: Gunakan 'siswa' untuk redirect ke halaman daftar siswa
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate.');
    }

    /**
     * Menghapus data siswa dari database.
     *
     * @param \App\Models\Siswa $siswa
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Siswa $siswa): RedirectResponse
    {
        $siswa->delete();

        // Perbaikan: Gunakan 'siswa' untuk redirect ke halaman daftar siswa
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
    
}
