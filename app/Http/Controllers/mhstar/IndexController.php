<?php
namespace App\Http\Controllers\mhstar;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Siswa;
use App\Models\Penilaian;
class IndexController extends Controller
{
    public function index(): View
    {
        $penilaians = Penilaian::with('siswa')
            ->orderByDesc('total_nilai')
            ->paginate(10);

        $siswas = Siswa::all();

        return view('mhstar.index', compact('penilaians', 'siswas'));
    }

}