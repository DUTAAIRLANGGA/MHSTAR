
<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="css/style.css">
<link rel="icon"  href="{{ asset('assets/favicon-32x32.png') }}">          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
          <title>Dashboard - MHSTAR</title>

    
</head>
<body>
<div class="sidebar">
        <div class="logo">
            <img src="assets/mhstar.png"/>
        </div>
        <ul class="menu">
               <li class="active"><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li><a href="{{ route('siswa.index') }}"><i class="fa-solid fa-user"></i><span>Siswa</span></a></li>
            <li><a href="{{ route('penilaian.index') }}"><i class="fa-solid fa-file-lines"></i><span>Penilaian</span></a></li>
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
            <p class="h">Dashboard</p>
        </div>
    </div>

    <div class="card-container">
        <div class="card--wrapper">
            <div class="payment--card">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Jumlah Siswa</span>
                        <span class="amount--value">&nbsp;{{ $totalSiswa }}</span>
                    </div>
                    <i class="fa-solid fa-user icon"></i>
                </div>
                <a href="{{ route('siswa.index') }}" class="card--detail">
                    Detail Siswa &nbsp;<i class="fa-solid fa-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="card--wrapper">
            <div class="payment--card light-blue">
                <div class="card--header">
                    <div class="amount">
                        <span class="title">Siswa Terbaik</span>
                        {{-- Menampilkan nama siswa terbaik dari variabel yang baru dibuat --}}
                        <span class="amount--value">
                            @if($siswaTerbaikSatu)
                                &nbsp;{{ $siswaTerbaikSatu->siswa->nama ?? 'Data tidak tersedia' }}
                            @else
                                Belum ada penilaian
                            @endif
                        </span>
                    </div>
                    <i class="fa-solid fa-star icon"></i>
                </div>
                <a href="{{ route('penilaian.index') }}" class="card--detail">
                    Detail Penilaian &nbsp;<i class="fa-solid fa-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card-table">
        <div class="header--title">
            <p class="h">Top 10 Siswa Terbaik</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Nama Siswa</th>
                    <th>Rata-rata Nilai</th>
                </tr>
            </thead>
            <tbody>
                {{-- Menggunakan variabel siswaTerbaik untuk menampilkan 10 siswa terbaik --}}
                @foreach($siswaTerbaik as $siswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $siswa->siswa->nama ?? 'Siswa tidak ditemukan' }}</td>
                    <td>{{ $siswa->total_nilai }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</html>