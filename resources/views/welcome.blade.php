<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Toko Bu Dani</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Nunito', sans-serif;
    }

    .hero-section {
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1604719312566-8912e9227c6a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80');
      background-size: cover;
      background-position: center;
      height: 80vh;
      display: flex;
      align-items: center;
      color: white;
    }

    .feature-icon {
      font-size: 2.5rem;
      color: #0d6efd;
      margin-bottom: 1rem;
      transition: transform 0.3s ease;
    }

    .card:hover .feature-icon {
      transform: scale(1.2);
    }

    .navbar {
      background-color: rgba(255, 255, 255, 0.95) !important;
      transition: all 0.3s ease;
    }

    .navbar.scrolled {
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .product-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      border: none;
      border-radius: 15px;
      overflow: hidden;
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .product-image {
      height: 250px;
      object-fit: cover;
    }

    .carousel-item {
      height: 300px;
    }

    .carousel-item img {
      height: 100%;
      object-fit: cover;
    }

    .counter-box {
      text-align: center;
      padding: 30px;
      background: #ffffff;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
    }

    .counter-box:hover {
      transform: translateY(-5px);
    }

    .counter {
      font-size: 2.5rem;
      font-weight: bold;
      color: #0d6efd;
      margin-bottom: 10px;
    }

    .testimonial-img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border: 3px solid #fff;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .category-banner {
      height: 200px;
      background-size: cover;
      background-position: center;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      margin-bottom: 30px;
      position: relative;
      overflow: hidden;
    }

    .category-banner::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.4);
      transition: background 0.3s ease;
    }

    .category-banner:hover::before {
      background: rgba(0, 0, 0, 0.6);
    }

    .category-content {
      position: relative;
      z-index: 1;
      text-align: center;
    }

    @media (max-width: 768px) {
      .hero-section {
        height: 60vh;
      }
    }

  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">
        <i class="bi bi-shop me-2"></i>Toko Bu Dani
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          @if (Route::has('login'))
          @auth
          <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link">Home</a>
          </li>
          @else
          <li class="nav-item">
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
          </li>
          @if (Route::has('register'))
          <li class="nav-item">
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
          </li>
          @endif
          @endauth
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8" data-aos="fade-right">
          <h1 class="display-4 fw-bold mb-4">Selamat Datang di Toko Bu Dani</h1>
          <p class="lead mb-4">Temukan berbagai kebutuhan sehari-hari dengan harga terjangkau dan kualitas terbaik</p>
          <a href="#products" class="btn btn-primary btn-lg me-3">Mulai Belanja</a>
          <a href="#about" class="btn btn-outline-light btn-lg">Tentang Kami</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Category Banners -->
  <section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="category-banner" style="background-image: url('https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80')">
            <div class="category-content">
              <h3 class="fw-bold">Sembako & Kebutuhan Pokok</h3>
              <a href="#" class="btn btn-light">Lihat Produk</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="category-banner" style="background-image: url('https://images.unsplash.com/photo-1621939514649-280e2ee25f60?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80')">
            <div class="category-content">
              <h3 class="fw-bold">Makanan & Minuman</h3>
              <a href="#" class="btn btn-light">Lihat Produk</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-3">
          <div class="counter-box" data-aos="fade-up">
            <div class="counter" data-target="5000">0</div>
            <p class="mb-0">Pelanggan Puas</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="counter-box" data-aos="fade-up" data-aos-delay="100">
            <div class="counter" data-target="1000">0</div>
            <p class="mb-0">Produk Tersedia</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="counter-box" data-aos="fade-up" data-aos-delay="200">
            <div class="counter" data-target="15">0</div>
            <p class="mb-0">Tahun Pengalaman</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="counter-box" data-aos="fade-up" data-aos-delay="300">
            <div class="counter" data-target="24">0</div>
            <p class="mb-0">Jam Pelayanan</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-5" id="features">
    <div class="container">
      <h2 class="text-center mb-5" data-aos="fade-up">Mengapa Memilih Kami?</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm" data-aos="fade-up">
            <div class="card-body text-center p-4">
              <i class="bi bi-currency-dollar feature-icon"></i>
              <h4 class="card-title mb-3">Harga Terjangkau</h4>
              <p class="card-text">Dapatkan produk berkualitas dengan harga yang bersahabat untuk semua kalangan</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm" data-aos="fade-up" data-aos-delay="100">
            <div class="card-body text-center p-4">
              <i class="bi bi-bag-check feature-icon"></i>
              <h4 class="card-title mb-3">Produk Lengkap</h4>
              <p class="card-text">Tersedia berbagai kebutuhan sehari-hari dalam satu tempat untuk kemudahan Anda</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-sm" data-aos="fade-up" data-aos-delay="200">
            <div class="card-body text-center p-4">
              <i class="bi bi-star feature-icon"></i>
              <h4 class="card-title mb-3">Pelayanan Prima</h4>
              <p class="card-text">Pelayanan ramah dan memuaskan untuk setiap pelanggan yang berbelanja</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Products Section -->
  <section class="py-5 bg-light" id="products">
    <div class="container">
      <h2 class="text-center mb-5" data-aos="fade-up">Produk Unggulan</h2>
      <div class="row g-4">
        <div class="col-md-3">
          <div class="card product-card" data-aos="fade-up">
            <img src="https://images.unsplash.com/photo-1607349913338-fca6f7fc42d0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" class="card-img-top product-image" alt="Sembako">
            <div class="card-body">
              <h5 class="card-title">Sembako</h5>
              <p class="card-text">Berbagai kebutuhan pokok dengan harga terjangkau</p>
              <a href="#" class="btn btn-primary">Lihat Detail</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card product-card" data-aos="fade-up" data-aos-delay="100">
            <img src="https://images.unsplash.com/photo-1621939514649-280e2ee25f60?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" class="card-img-top product-image" alt="Snack">
            <div class="card-body">
              <h5 class="card-title">Snack</h5>
              <p class="card-text">Aneka makanan ringan untuk semua usia</p>
              <a href="#" class="btn btn-primary">Lihat Detail</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card product-card" data-aos="fade-up" data-aos-delay="200">
            <img src="https://images.unsplash.com/photo-1527960471264-932f39eb5846?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" class="card-img-top product-image" alt="Minuman">
            <div class="card-body">
              <h5 class="card-title">Minuman</h5>
              <p class="card-text">Berbagai minuman segar dan kemasan</p>
              <a href="#" class="btn btn-primary">Lihat Detail</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card product-card" data-aos="fade-up" data-aos-delay="300">
            <img src="https://images.unsplash.com/photo-1568205612837-017257d2310a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" class="card-img-top product-image" alt="Alat Tulis">
            <div class="card-body">
              <h5 class="card-title">Alat Tulis</h5>
              <p class="card-text">Perlengkapan sekolah dan kantor</p>
              <a href="#" class="btn btn-primary">Lihat Detail</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="py-5 bg-light" style="border-top: 1px solid #ddd;">
    <div class="container">
      <h2 class="text-center mb-5" data-aos="fade-up">Testimoni Pelanggan</h2>
      <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" class="rounded-circle testimonial-img mb-4" alt="Customer" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                <p class="lead">"Pelayanan sangat ramah dan produk lengkap dengan harga terjangkau."</p>
                <h5>Ani Susanti</h5>
                <p class="text-muted">Ibu Rumah Tangga, Jakarta</p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" class="rounded-circle testimonial-img mb-4" alt="Customer" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                <p class="lead">"Tempat belanja favorit keluarga, semua kebutuhan tersedia dengan kualitas terbaik."</p>
                <h5>Budi Santoso</h5>
                <p class="text-muted">Karyawan Swasta, Bandung</p>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer class="bg-dark text-light py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>Toko Bu Dani</h5>
          <p>Melayani dengan sepenuh hati sejak 2010</p>
          <div class="social-links">
            <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>
        <div class="col-md-4">
          <h5>Link Cepat</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light text-decoration-none">Tentang Kami</a></li>
            <li><a href="#" class="text-light text-decoration-none">Produk</a></li>
            <li><a href="#" class="text-light text-decoration-none">Kontak</a></li>
            <li><a href="#" class="text-light text-decoration-none">FAQ</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5>Hubungi Kami</h5>
          <p><i class="bi bi-geo-alt me-2"></i>Jl. Contoh No. 123</p>
          <p><i class="bi bi-telephone me-2"></i>(021) 123-4567</p>
          <p><i class="bi bi-envelope me-2"></i>contact@tokoBuDani.com</p>
        </div>
      </div>
      <hr>
      <div class="text-center">
        <p class="mb-0">&copy; 2025 Toko Bu Dani. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS Animation -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script>
    // Initialize AOS
    AOS.init({
      duration: 1000
      , once: true
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.querySelector('.navbar').classList.add('scrolled');
      } else {
        document.querySelector('.navbar').classList.remove('scrolled');
      }
    });

    // Counter animation
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
      const target = +counter.getAttribute('data-target');
      const increment = target / 200;

      function updateCount() {
        const count = +counter.innerText;
        if (count < target) {
          counter.innerText = Math.ceil(count + increment);
          setTimeout(updateCount, 1);
        } else {
          counter.innerText = target;
        }
      }

      updateCount();
    });

  </script>
</body>
</html>
