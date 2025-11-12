<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" href="{{ asset('asset/m.png') }}">
    <title>Login -- MHSTAR</title>
</head>
<body>
    <div class="login">
        <div class="star">
        <img src="assets/hitam.png"/>
    </div>
        <hr>

        {{-- Menampilkan pesan error umum dari sesi jika ada --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>Username</p>
            <input type="text" name="username" placeholder="username" value="{{ old('username') }}" required>
            
            {{-- Menampilkan pesan error spesifik untuk username --}}
            
            <p>Password</p>
            <input type="password" name="password" placeholder="password" required>
            
            {{-- Menampilkan pesan error spesifik untuk password --}}
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <br>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
