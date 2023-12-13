<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>App SiRentCar</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white p-4 shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}" style="color: rgb(2, 59, 124);"><i
                    class="bi bi-car-front-fill"></i> SiRentCar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    <a class="nav-link" href="#">Produk Kami</a>
                    <a class="nav-link" href="#">Blog</a>
                    <a class="nav-link" href="#">Kontak Kami</a>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary btn-sm text-white px-3 me-2" href="{{ route('login') }}">
                            <i class="bi bi-person-circle"></i> {{ __('Login') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-dark btn-sm px-3 text-white" href="{{-- route('register') --}}">
                            <i class="bi bi-box-arrow-in-right"></i> {{ __('Register') }}</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container min-vh-100">
        @yield('homepage')
    </div>

    <footer class="container py-5 pt-5 border-top">
        <div class="container row">
            <div class="col-lg-12 col-12 col-md">
                <p class="h2" style="color: rgb(2, 59, 124);"><i class="bi bi-car-front-fill"></i> SiRentCar</p>
                <small class="d-block mb-3 text-muted">&copy; 2022–2023</small>
            </div>
            <div class="col-lg-4 col-6">
                <h5>Menu</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Beranda</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Produk Kami</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Blog</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Kontak Kami</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-6">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Kontak Kami</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Blog</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-6">
                <h5>Social Media</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-instagram"></i> Instagram</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-facebook"></i> Facebook</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-whatsapp"></i> WhatsAap</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-tiktok"></i> TikTok</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js">
    </script>
    @include('sweetalert::alert')
</body>

</html>
