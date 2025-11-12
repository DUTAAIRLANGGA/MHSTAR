<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon"  href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Leaderboard - MHSTAR</title>

    <script>
        function confirmlogout(){
            if(confirm('apakah anda yakin untuk keluar?')){
                window.location.href = 'logout.php';
            }
        }      
    </script>
</head>
<body>
  <div class="sidebar">   
      <div class="logo">
            <img src="assets/mhstar.png"/>
      </div>
                    <ul class="menu">

                        <li class="active">
                              <a href="{{ route('home') }}" >
                                        <i class="fas fa-trophy"></i>
                                        <span>Leaderboard</span>
                              </a>
                        </li>       
                        <li>
                              <a href="{{ route('about') }}">
                                        <i class="fa-solid fa-address-card"></i>
                                        <span>About</span>
                              </a>
                        </li> 
                          <li >
                              <a href="{{ route('rekomendasi') }}">
                                        <i class="fa-solid fa-star"></i>
                                        <span>Rekomendasi</span>
                              </a>
                        </li> 
                        <li>
                              <a href="{{ route('login') }}">
                                        <i class="fa-solid fa-right-from-bracket" ></i>
                                        <span> Login</span>
                              </a>
                        </li>  
                    </ul>
          </div>

<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">
            <p class="h">Leaderboard</p> 
        </div>
        <div class="user--info">
            <div class="search--box">
                <i class="fa-solid fa-search"></i>
                <input type="text" placeholder="search" />
            </div> 
        </div>
    </div>
    
    <div class="card-container">
     <div class="leaderboard-wrapper">
    <h1 class="leaderboard-title">Leaderboard</h1>
    <h2 class="leaderboard-subtitle">Peringkat Siswa Terbaik</h2>

    <div class="top-ranks-cards">
        @foreach($penilaians->take(3) as $penilaian)
            <div class="top-rank-card">
                <div class="trophy"><i class="fa-solid fa-trophy"></i></div>
                <div class="info">
                    <p class="name">{{ $penilaian->siswa->nama }}</p>
                    <p class="score">{{ number_format($penilaian->total_nilai, 2) }}</p>
                    <p class="peringkat">Peringkat {{ $loop->iteration }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="other-ranks">
        @foreach($penilaians->skip(3)->take(7) as $penilaian)
            <div class="rank-item">
                <span class="rank-number">{{ $loop->iteration + 3 }}.</span>
                <span class="name-siswa">{{ $penilaian->siswa->nama }}</span>
                <span class="nilai-angka">{{ number_format($penilaian->total_nilai, 2) }}</span>
            </div>
        @endforeach
    </div>
</div>
    </div>
</div>
</body>
</html>