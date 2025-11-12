<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
<link rel="icon"  href="{{ asset('assets/favicon-32x32.png') }}">              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>About - MHSTAR</title>
   
</head>
<body>
  <div class="sidebar">   
      <div class="logo">
            <img src="assets/mhstar.png"/>
      </div>
                    <ul class="menu">

                        <li >
                           <a href="{{ route('home') }}" >
                                        <i class="fas fa-trophy"></i>
                                        <span>Leaderboard</span>
                              </a>
                        </li>       
                        <li class="active">
                              <a href="{{ route('about') }}">
                                        <i class="fa-solid fa-address-card"></i>
                                        <span>About</span>
                              </a>
                        </li> 
                          <li>
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
<div class="main-content">
    <div class="header">
        <h1>About - MHSTAR</h1>
        <p>Informasi lengkap tentang siswa dan sistem penilaian</p>
    </div>

    <div class="about-container">
        <div class="student-card">
            <div class="student-name">Rasya</div>
            <div class="student-info">
                <div class="info-item">
                    <span class="info-label">Kelas:</span>
                    <span class="info-value">XII PPLG 1</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Jabatan:</span>
                    <span class="info-value">Programmer</span>
                </div>
            </div>
            <div class="social-links">
                <a href="https://www.instagram.com/rasya_septian_ramadhan/"  target="_blank" class="fab fa-instagram">
                </a>
                <a href="" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" target="_blank">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </div>

        <div class="student-card">
            <div class="student-name">Rhayzan</div>
            <div class="student-info">
                <div class="info-item">
                    <span class="info-label">Kelas:</span>
                    <span class="info-value">XII PPLG 1</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Jabatan:</span>
                    <span class="info-value">Programmer</span>
                </div>
            </div>
            <div class="social-links">
                <a href="" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" target="_blank">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </div>

        <div class="student-card">
            <div class="student-name">Duta</div>
            <div class="student-info">
                <div class="info-item">
                    <span class="info-label">Kelas:</span>
                    <span class="info-value">XII PPLG 1</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Jabatan:</span>
                    <span class="info-value">Programmer</span>
                </div>
            </div>
            <div class="social-links">
                <a href="" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" target="_blank">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </div>

        <div class="student-card">
            <div class="student-name">Nesky</div>
            <div class="student-info">
                <div class="info-item">
                    <span class="info-label">Kelas:</span>
                    <span class="info-value">XII PPLG 1</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Jabatan:</span>
                    <span class="info-value">Programmer</span>
                </div>
            </div>
            <div class="social-links">
                <a href="" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" target="_blank">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </div>
    </div>

   
        <div class="system-info">
            <h3>Tentang Sistem</h3>
            <p><strong>MHSTAR</strong> adalah platform digital yang dirancang untuk memudahkan pengelolaan dan monitoring nilai siswa secara real-time.</p>
            <p>Sistem ini menyediakan fitur-fitur lengkap untuk tracking progress akademik, ranking siswa, dan analisis performa pembelajaran.</p>
            
          </div>
        </div>

    <script>
        // Add click handlers for navigation
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all items
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                // Add active class to clicked item
                this.classList.add('active');
            });
        });

        // Add hover effects for student cards
        document.querySelectorAll('.student-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>