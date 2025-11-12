<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon"  href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" xintegrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Rekomendasi - MHSTAR</title>
<style>
    .other-ranks {
    display: flex;             
    gap: 20px;              
    flex-wrap: wrap;        
    margin-top: 20px;
}

.role-section {
    flex: 1;
    min-width: 300px;          
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 15px;
}
.role-section h2 {
    margin-bottom: 10px;
    font-size: 18px;
    text-align: center;
}
.role-section table {
    width: 100%;
    border-collapse: collapse;
}
.role-section table th, 
.role-section table td {
    
    padding: 8px;
    text-align: center;
}
.role-section table th {
    background: #f2f2f2;
}

</style>
 
</head>
<body>
<div class="sidebar">
        <div class="logo">
            <img src="assets/mhstar.png"/>
        </div>
        <ul class="menu">
               <li ><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li><a href="{{ route('siswa.index') }}"><i class="fa-solid fa-user"></i><span>Siswa</span></a></li>
            <li><a href="{{ route('penilaian.index') }}"><i class="fa-solid fa-file-lines"></i><span>Penilaian</span></a></li>
            <li><a href="{{ url('about-admin') }}"><i class="fa-solid fa-address-card"></i><span>About</span></a></li>
           <li class = "active"><a href="{{ url('generate-recommendations') }}"><i class="fa-solid fa-star"></i><span>Rekomendasi</span></a></li>
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
            <p class="h">Rekomendasi</p> 
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
    <h1 class="leaderboard-title">Rekomendasi</h1>
    <h2 class="leaderboard-subtitle">Peringkat Siswa Terbaik</h2>

    
    

    <div class="other-ranks">
            @foreach($recommendedStudents as $role => $students)
        <div class="role-section">
            <h2>Rekomendasi {{ ucwords(str_replace('_', ' ', $role)) }}</h2>
            <table>
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Nama Siswa</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                   
                    @foreach($students as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->siswa->nama }}</td>
                        <td>{{ $student->recom_score }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
    </div>
</div>
    </div>
    </div>
</div>
</body>
</html>
