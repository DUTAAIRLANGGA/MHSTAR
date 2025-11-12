<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Manajemen Penilaian - MHSTAR</title>
    
</head>
<body>
   <div class="sidebar">
        <div class="logo">
            <img src="assets/mhstar.png"/>
        </div>
        <ul class="menu">
               <li ><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li><a href="{{ route('siswa.index') }}"><i class="fa-solid fa-user"></i><span>Siswa</span></a></li>
            <li class="active"><a href="{{ route('penilaian.index') }}"><i class="fa-solid fa-file-lines"></i><span>Penilaian</span></a></li>
            <li><a href="{{ url('about-admin') }}"><i class="fa-solid fa-address-card"></i><span>About</span></a></li>
           <li><a href="{{ url('generate-recommendations') }}"><i class="fa-solid fa-star"></i><span>Rekomendasi</span></a></li>
            <li class="logout">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit(); return confirmlogout();">
                    <i class="fa-solid fa-right-from-bracket"></i><span> Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <p class="h">Manajemen Penilaian</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
  
        <div class="card-table">
            <div class="action">
                <div class="filter">
                <a href="#" id="openFilterModalBtn" class="filter-button" >
        <i class="fa fa-filter"></i> Filter Penilaian
</a>
</div>
             
            
           
<!-- MODAL FILTER -->
<div id="filterModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-button" data-modal-id="filterModal">&times;</span>
        <h2>Filter Penilaian</h2>
        <form action="{{ route('penilaian.index') }}" method="GET" id="filter-form-modal">

            <!-- Filter Cari Nama Siswa -->
            <div class="filter-group">
                <label for="search_modal">Cari Nama Siswa:</label>
                <input type="text" name="search" id="search_modal" placeholder="Cari nama siswa..." value="{{ request('search') }}">
            </div>

            <!-- Filter Urutkan -->
            <div class="filter-group">
                <label for="sortBy_modal">Urutkan Berdasarkan:</label>
                <select name="sortBy" id="sortBy_modal">
    <option value="" {{ request('sortBy') == '' ? 'selected' : '' }}>-- Semua / Tanpa Urutan --</option>
    <option value="total_nilai" {{ request('sortBy') == 'total_nilai' ? 'selected' : '' }}>Total Nilai Tertinggi</option>
    <option value="inisiatif" {{ request('sortBy') == 'inisiatif' ? 'selected' : '' }}>Inisiatif Tertinggi</option>
    <option value="kedisiplinan" {{ request('sortBy') == 'kedisiplinan' ? 'selected' : '' }}>Disiplin Tertinggi</option>
    <option value="kehadiran" {{ request('sortBy') == 'kehadiran' ? 'selected' : '' }}>Kehadiran Tertinggi</option>
    <option value="nilai_raport" {{ request('sortBy') == 'nilai_raport' ? 'selected' : '' }}>Nilai Raport Tertinggi</option>
    <option value="kerja_sama_tim" {{ request('sortBy') == 'kerja_sama_tim' ? 'selected' : '' }}>Kerja Sama Tim Tertinggi</option>
    <option value="kreativitas" {{ request('sortBy') == 'kreativitas' ? 'selected' : '' }}>Kreativitas Tertinggi</option>
</select>

            </div>


            <div class="filter-buttons" style="margin-top: 15px; display: flex; gap: 10px; justify-content: flex-end;">
                <button type="submit" class="btn-apply">Terapkan Filter</button>
                <button type="button" class="btn-reset" onclick="resetFiltersModal()">Reset Filter</button>
            </div>
        </form>
    </div>
</div>
            </div>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Nama Siswa</th>
                        <th>Kehadiran</th>
                        <th>Kedisiplinan</th>
                        <th>Nilai Raport</th>
                        <th>Kerja Sama Tim</th>
                        <th>Kreativitas</th>
                        <th>Inisiatif</th>
                        <th>Total Nilai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penilaians as $index => $penilaian)
                        <tr>
                            <td>{{ $penilaians->firstItem() + $loop->index }}</td>
                            <td>{{ $penilaian->siswa->nama ?? 'N/A' }}</td>
                            <td>{{ $penilaian->kehadiran }}</td>
                            <td>{{ $penilaian->kedisiplinan }}</td>
                            <td>{{ $penilaian->nilai_raport }}</td>
                            <td>{{ $penilaian->kerja_sama_tim }}</td>
                            <td>{{ $penilaian->kreativitas }}</td>
                            <td>{{ $penilaian->inisiatif }}</td>
                            <td>{{ $penilaian->total_nilai }}</td>
                            <td>
                                <a class="edit edit-button" href="#" 
                                   data-id="{{ $penilaian->id }}" 
                                   data-kehadiran="{{ $penilaian->kehadiran }}" 
                                   data-kedisiplinan="{{ $penilaian->kedisiplinan }}" 
                                   data-raport="{{ $penilaian->nilai_raport }}" 
                                   data-kerjasama="{{ $penilaian->kerja_sama_tim }}" 
                                   data-kreativitas="{{ $penilaian->kreativitas }}" 
                                   data-inisiatif="{{ $penilaian->inisiatif }}" 
                                   data-id-siswa="{{ $penilaian->id_siswa }}">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('penilaian.destroy', $penilaian->id) }}" method="post" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="delete" class="delete" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{-- Paginasi --}}
             <div class="pagination-buttons">
    @if ($penilaians->onFirstPage())
        <button disabled class="prev-button disabled">Previous</button>
    @else
        <a href="{{ $penilaians->previousPageUrl() }}" class="prev-button">Previous</a>
    @endif

    <span class="page-info">Showing {{ $penilaians->firstItem() }} to {{ $penilaians->lastItem() }} of {{ $penilaians->total() }} entries</span>

    @if ($penilaians->hasMorePages())
        <a href="{{ $penilaians->nextPageUrl() }}" class="next-button">Next</a>
    @else
        <button disabled class="next-button disabled">Next</button>
    @endif
</div>
    </div>

    {{-- MODAL TAMBAH PENILAIAN --}}


    {{-- MODAL EDIT PENILAIAN --}}
    <div id="editPenilaianModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close-button" data-modal-id="editPenilaianModal">&times;</span>
            <h2>Edit Penilaian</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <label for="edit_siswa">Nama Siswa:</label>
                <select name="id_siswa" id="edit_siswa" disabled>
                    @foreach($siswas as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                    @endforeach
                </select>
                <label for="edit_kehadiran">Kehadiran:</label>
                <input type="number" name="kehadiran" id="edit_kehadiran" min="0" max="100" required>
                <label for="edit_kedisiplinan">Kedisiplinan:</label>
                <input type="number" name="kedisiplinan" id="edit_kedisiplinan" min="0" max="100" required>
                <label for="edit_nilai_raport">Nilai Raport:</label>
                <input type="number" name="nilai_raport" id="edit_nilai_raport" min="0" max="100" required>
                <label for="edit_kerja_sama_tim">Kerja Sama Tim:</label>
                <input type="number" name="kerja_sama_tim" id="edit_kerja_sama_tim" min="0" max="100" required>
                <label for="edit_kreativitas">Kreativitas:</label>
                <input type="number" name="kreativitas" id="edit_kreativitas" min="0" max="100" required>
                <label for="edit_inisiatif">Inisiatif:</label>
                <input type="number" name="inisiatif" id="edit_inisiatif" min="0" max="100" required>
                <button type="submit">Perbarui</button>
            </form>
        </div>
    </div>

   <script>
    // Modal elements
    var tambahModal = document.getElementById("tambahPenilaianModal");
    var editModal = document.getElementById("editPenilaianModal");
    var filterModal = document.getElementById("filterModal");

    // Buttons
    var tambahBtn = document.getElementById("tambah-penilaian-button");
    var openFilterBtn = document.getElementById("openFilterModalBtn");
    var closeButtons = document.querySelectorAll(".close-button");
    var editBtns = document.querySelectorAll(".edit-button");

    // Open modal tambah
    tambahBtn.onclick = function() {
        tambahModal.style.display = "block";
    }

    // Open modal filter
    openFilterBtn.onclick = function() {
        filterModal.style.display = "block";
    }

    // Close modal on close button click
    closeButtons.forEach(btn => {
        btn.onclick = function() {
            var modalId = this.getAttribute('data-modal-id');
            document.getElementById(modalId).style.display = "none";
        }
    });

    // Close modal on outside click
    window.onclick = function(event) {
        if (event.target == tambahModal) {
            tambahModal.style.display = "none";
        }
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
        if (event.target == filterModal) {
            filterModal.style.display = "none";
        }
    }

    // Fill edit modal data
    editBtns.forEach(btn => {
        btn.onclick = function() {
            var id = btn.getAttribute("data-id");
            var idSiswa = btn.getAttribute("data-id-siswa");
            var kehadiran = btn.getAttribute("data-kehadiran");
            var kedisiplinan = btn.getAttribute("data-kedisiplinan");
            var raport = btn.getAttribute("data-raport");
            var kerjasama = btn.getAttribute("data-kerjasama");
            var kreativitas = btn.getAttribute("data-kreativitas");
            var inisiatif = btn.getAttribute("data-inisiatif");

            document.getElementById("edit_siswa").value = idSiswa;
            document.getElementById("edit_kehadiran").value = kehadiran;
            document.getElementById("edit_kedisiplinan").value = kedisiplinan;
            document.getElementById("edit_nilai_raport").value = raport;
            document.getElementById("edit_kerja_sama_tim").value = kerjasama;
            document.getElementById("edit_kreativitas").value = kreativitas;
            document.getElementById("edit_inisiatif").value = inisiatif;

            var form = document.getElementById("editForm");
            form.action = "{{ route('penilaian.update', '') }}/" + id;
            editModal.style.display = "block";
        }
    });

    // Confirm logout
    function confirmlogout() {
        return confirm('Yakin ingin logout?');
    }

    // Reset filter modal form without submit

function resetFiltersModal() {
    // Kosongkan nilai input/select
    const searchInput = document.getElementById('search_modal');
    const sortSelect = document.getElementById('sortBy_modal');

    if (searchInput) searchInput.value = '';
    if (sortSelect) sortSelect.value = ''; // pastikan ada option value=""

    // tutup modal
    const modal = document.getElementById('filterModal');
    if (modal) modal.style.display = 'none';

    // Redirect ke halaman index tanpa query string supaya benar-benar "bersih"
    // Blade akan mengganti route(...) dengan URL nyata.
    window.location.href = "{{ route('penilaian.index') }}";
}

</script>
</body>
</html>