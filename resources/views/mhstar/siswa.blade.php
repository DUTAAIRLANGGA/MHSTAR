<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon"  href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Manajemen siswa - MHSTAR</title>
</head>
<body>
<div class="sidebar">
        <div class="logo">
            <img src="assets/mhstar.png"/>
        </div>
        <ul class="menu">
            <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li class="active"><a href="{{ route('siswa.index') }}"><i class="fa-solid fa-user"></i><span>Siswa</span></a></li>
            <li ><a href="{{ route('penilaian.index') }}"><i class="fa-solid fa-file-lines"></i><span>Penilaian</span></a></li>
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
            <p class="h">Manajemen siswa</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-table">
        <div class="action">
            <div class="tambah">
                <i class="fa-solid fa-plus">&nbsp;</i>
                <a class="tambah-button" href="#" id="tambah-siswa-button">Tambah siswa</a>
            </div>
               </div>
         <div class="filter--form">
            <form action="{{ route('siswa.index') }}" method="GET">
                <input type="text" name="search" placeholder="Cari Nama atau Kelas..." value="{{ request('search') }}">
                <select name="jurusan">
                    <option value="">-- Semua Jurusan --</option>
                    <option value="PPLG" {{ request('jurusan') == 'PPLG' ? 'selected' : '' }}>PPLG</option>
                    <option value="TJKT" {{ request('jurusan') == 'TJKT' ? 'selected' : '' }}>TJKT</option>
                    <option value="AKL" {{ request('jurusan') == 'AKL' ? 'selected' : '' }}>AKL</option>
                     <option value="DKV" {{ request('jurusan') == 'DKV' ? 'selected' : '' }}>DKV</option>
                      <option value="Seni Tari" {{ request('jurusan') == 'Seni Tari' ? 'selected' : '' }}>Seni Tari</option>
                </select>
                <select name="jenis_kelamin">
                    <option value="">-- Semua Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <button type="submit">Filter</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama siswa</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Jenis Kelamin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswas as $siswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>{{ $siswa->jurusan }}</td>
                    <td>{{ $siswa->jenis_kelamin }}</td>
                    <td>
                        <a class="edit edit-button" href="#"
                           data-id="{{ $siswa->id }}"
                           data-nama="{{ $siswa->nama }}"
                           data-kelas="{{ $siswa->kelas }}"
                           data-jurusan="{{ $siswa->jurusan }}"
                           data-jenis-kelamin="{{ $siswa->jenis_kelamin }}"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="post" style="display:inline;">
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
      <div class="pagination-buttons">
    @if ($siswas->onFirstPage())
        <button disabled class="prev-button disabled">Previous</button>
    @else
        <a href="{{ $siswas->previousPageUrl() }}" class="prev-button">Previous</a>
    @endif

    <span class="page-info">Showing {{ $siswas->firstItem() }} to {{ $siswas->lastItem() }} of {{ $siswas->total() }} entries</span>

    @if ($siswas->hasMorePages())
        <a href="{{ $siswas->nextPageUrl() }}" class="next-button">Next</a>
    @else
        <button disabled class="next-button disabled">Next</button>
    @endif
</div>
    </div>
</div>

{{-- MODAL TAMBAH SISWA --}}
<div id="tambahSiswaModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Tambah Siswa</h2>
        <form action="{{ route('siswa.store') }}" method="POST">
            @csrf
            <label for="nama">Nama siswa:</label>
            <input type="text" name="nama" id="nama" placeholder="isi...." required>
            <label for="kelas">Kelas:</label>
            <select name="kelas" id="kelas" required>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <label for="jurusan">Jurusan:</label>
            <select name="jurusan" id="jurusan" required>
                <option value="PPLG">PPLG</option>
                <option value="TJKT">TJKT</option>
                <option value="DKV">DKV</option>
                <option value="Seni Tari">Seni Tari</option>
                <option value="AKL">AKL</option>
            </select>
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <button type="submit">Tambah</button>
        </form>
    </div>
</div>

{{-- MODAL EDIT SISWA --}}
<div id="editSiswaModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Edit Siswa</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit-id-siswa">
            <label for="edit-nama">Nama siswa:</label>
            <input type="text" name="nama" id="edit-nama" placeholder="isi...." required>
            <label for="edit-kelas">Kelas:</label>
            <select name="kelas" id="edit-kelas" required>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <label for="edit-jurusan">Jurusan:</label>
            <select name="jurusan" id="edit-jurusan" required>
                <option value="PPLG">PPLG</option>
                <option value="TJKT">TJKT</option>
                <option value="DKV">DKV</option>
                <option value="Seni Tari">Seni Tari</option>
                <option value="AKL">AKL</option>
            </select>
            <label for="edit-jenis-kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" id="edit-jenis-kelamin" required>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <button type="submit">Update</button>
        </form>
    </div>
</div>

<script>
    // Logika untuk menampilkan dan menyembunyikan modal
    var tambahModal = document.getElementById("tambahSiswaModal");
    var editModal = document.getElementById("editSiswaModal");
    var tambahBtn = document.getElementById("tambah-siswa-button");
    var closeBtns = document.querySelectorAll(".close-button");
    var editBtns = document.querySelectorAll(".edit-button");

    tambahBtn.onclick = function() {
        tambahModal.style.display = "flex";
    }

    closeBtns.forEach(btn => {
        btn.onclick = function() {
            tambahModal.style.display = "none";
            editModal.style.display = "none";
        }
    });

    window.onclick = function(event) {
        if (event.target == tambahModal) {
            tambahModal.style.display = "none";
        }
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
    }

    // Logika untuk mengisi data pada modal edit
    editBtns.forEach(btn => {
        btn.onclick = function(e) {
            e.preventDefault();
            var id = this.getAttribute("data-id");
            var nama = this.getAttribute("data-nama");
            var kelas = this.getAttribute("data-kelas");
            var jurusan = this.getAttribute("data-jurusan");
            var jenis_kelamin = this.getAttribute("data-jenis-kelamin");
            
            // Mengisi data ke input modal
            document.getElementById('edit-id-siswa').value = id;
            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-kelas').value = kelas;
            document.getElementById('edit-jurusan').value = jurusan;
            document.getElementById('edit-jenis-kelamin').value = jenis_kelamin;
            
            // Mengatur action form
            var form = document.getElementById("editForm");
            form.action = "{{ route('siswa.update', '') }}/" + id;
            
            // Menampilkan modal edit
            editModal.style.display = "flex";
        }
    });
</script>
</body>
</html>