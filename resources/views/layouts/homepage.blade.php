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
    <div class="col-lg-12 p-2" style="background: rgb(2, 59, 124);">
        <div class="text-white d-flex justify-content-between container">
            <small class="mb-0"><i class="bi bi-phone"></i> 089827351127</small>
            <small class="mb-0">Rental Terbaik di Bali <i class="bi bi-car-front-fill"></i></small>
            <small class="mb-0"><i class="bi bi-inboxes-fill"></i> Pesan sekarang</small>
        </div>
    </div>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white p-4 shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}" style="color: rgb(2, 59, 124);"><i
                    class="bi bi-car-front-fill"></i> SiRentCar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarmenu"
                aria-controls="navbarmenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarmenu">
                <div class="navbar-nav">
                    <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Beranda</a>
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
                        <a class="nav-link btn btn-dark btn-sm px-3 text-white" href="{{ route('register') }}">
                            <i class="bi bi-box-arrow-in-right"></i> {{ __('Register') }}</a>
                    </li>
                    @endguest

                    @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" type="button" id="usersmenu"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->nama }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="usersmenu">
                            <li>
                                <a class="dropdown-item" href="#">Profil</a>
                                <a class="dropdown-item" href="#">Riwayat Penyewaan</a>
                                <a class="dropdown-item text-danger" href="{{ route('posts.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }} <i class="bi bi-box-arrow-right"></i>
                                </a>
                                <form id="logout-form" action="{{ route('posts.logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endauth
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
                <h5>Jam Operasi</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Senin 09.00 - 18.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Selasa 09.00 - 18.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Rabu 09.00 - 18.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Kamis 09.00 - 18.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Jumat 09.00 - 18.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Sabtu 09.00 - 13.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Minggu Tidak Buka</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-6">
                <h5>Social Media</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i
                                class="bi bi-instagram"></i> Instagram</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i
                                class="bi bi-facebook"></i> Facebook</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i
                                class="bi bi-whatsapp"></i> WhatsAap</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i
                                class="bi bi-tiktok"></i> TikTok</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
    @include('sweetalert::alert')
</body>

</html>
