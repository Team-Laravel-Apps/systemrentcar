<div class="col-lg-12 p-2 d-lg-block d-md-block d-none" style="background: rgb(2, 59, 124);">
    <div class="text-white d-flex justify-content-between container">
        <small class="mb-0"><i class="bi bi-phone"></i> 089827351127</small>
        <small class="mb-0">Rental Terbaik di Bali <i class="bi bi-car-front-fill"></i></small>
        <small class="mb-0"><i class="bi bi-inboxes-fill"></i> Pesan sekarang</small>
    </div>
</div>

<div class="col-lg-12 p-2 d-lg-none d-md-none" style="background: rgb(2, 59, 124);">
    <div class="text-white text-center container">
        <small class="mb-0">Rental Terbaik di Bali <i class="bi bi-car-front-fill"></i></small>
    </div>
</div>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white p-4 shadow">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}" style="color: rgb(2, 59, 124);"><i
                class="bi bi-car-front-fill"></i> SiRentCar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarmenu" data-toggle="collapse" data-target="#navbarmenu"
            aria-controls="navbarmenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarmenu">
            <div class="navbar-nav">
                <span class="nav-link" style="font-size: 20px; color: black;"><b>@yield('title')</b></span>
            </div>

            <ul class="navbar-nav ms-auto ml-auto">
                @guest
                <li class="nav-item py-2">
                    <a class="nav-link btn btn-primary btn-sm text-white px-3 mb-2" href="{{ route('login') }}">
                        <i class="bi bi-person-circle"></i> {{ __('Login') }}
                    </a>
                </li>
                <span class="mx-1"></span>
                <li class="nav-item py-2">
                    <a class="nav-link btn btn-dark btn-sm px-3 text-white mb-2" href="{{ route('register') }}">
                        <i class="bi bi-box-arrow-in-right"></i> {{ __('Register') }}</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
