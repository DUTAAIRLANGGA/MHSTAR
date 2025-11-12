<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('asset/kepala ayam.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield('title')</title>
</head>
<body>
    <div class="sidebar">   
        <div class="logo">
            <img src="{{ asset('asset/MHS-Registered.png') }}" />
        </div>
        <ul class="menu">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>      
            <li class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                <a href="{{ route('siswa.index') }}">
                    <i class="fa-solid fa-user"></i>
                    <span>Siswa</span>
                </a>
            </li>  
            <li class="{{ request()->routeIs('penilaian.*') ? 'active' : '' }}">
                <a href="{{ route('penilaian.index') }}">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>Penilaian</span>
                </a>
            </li>  
            <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa-solid fa-address-card"></i>
                    <span>About</span>
                </a>
            </li> 
            <li class="logout">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>  
        </ul>
    </div>
    
    {{-- Ini adalah tempat konten spesifik tiap halaman akan dimasukkan --}}
    @yield('content')
</body>
</html>