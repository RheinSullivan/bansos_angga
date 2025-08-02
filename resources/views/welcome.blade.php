<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Bansos - Desa Sindangkempeng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                        url('https://source.unsplash.com/1600x600/?village,indonesia') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .footer {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">SPK Bansos</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4 fw-bold">Sistem Pendukung Keputusan</h1>
            <p class="lead">Bantuan Sosial Desa Sindangkempeng, Kecamatan Greged</p>
            <!-- Tombol Login -->
            <a href="#" class="btn btn-light btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
        </div>
    </section>

    <!-- Tentang Desa -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4 text-primary">Tentang Sistem</h2>
            <p class="text-muted">
                Sistem ini dirancang untuk membantu proses pengambilan keputusan penyaluran bantuan sosial
                di Desa Sindangkempeng secara objektif dan transparan berdasarkan kondisi ekonomi dan keluarga.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-3 text-center">
        <div class="container">
            &copy; {{ date('Y') }} SPK Bantuan Sosial - Desa Sindangkempeng. All rights reserved.
        </div>
    </footer>

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('login') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login ke Sistem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Masuk</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
