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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarmenu"
            data-toggle="collapse" data-target="#navbarmenu" aria-controls="navbarmenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarmenu">
            <ul class="navbar-nav mt-4 mb-3">
                <li class="nav-item d-lg-none">
                    <form action="{{ route('search') }}" method="GET" class="form-inline custom-search">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="px-4 py-3 form-control rounded-pill" name="search"
                                placeholder="Cari mobil anda..." value="{{ request('search') }}">
                            <div class="input-group-text px-4" style="border-radius: 50%; z-index: 100;">
                                <i class="bi bi-search"></i>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>

            <div class="navbar-nav">
                <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('home') }}">Beranda</a>
                <a class="nav-link {{ Route::is('produk', 'detail.produk') ? 'active' : '' }}"
                    href="{{ route('produk') }}">Produk Kami</a>
                <a class="nav-link {{ Route::is('syarat') ? 'active' : '' }}" href="{{ route('syarat') }}">Syarat &
                    Ketentuan</a>
                <a class="nav-link {{ Route::is('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak
                    Kami</a>
            </div>

            <ul class="navbar-nav ms-auto ml-auto">
                <li class="nav-item d-lg-block d-none">
                    <form action="{{ route('search') }}" method="GET" class="form-inline custom-search">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="px-4 py-3 form-control rounded-pill" name="search"
                                placeholder="Cari mobil anda..." value="{{ request('search') }}">
                            <div class="input-group-text px-4" style="border-radius: 50%; z-index: 100;">
                                <i class="bi bi-search"></i>
                            </div>
                        </div>
                    </form>
                </li>
                <span class="mx-1"></span>
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

                @auth
                @php
                    $order = App\Models\Rental::where('id_pelanggan', auth()->user()->id)->where('status_rental','pendding')->first();
                    if (!empty($order)) {
                        $notif_order = App\Models\Rental::where('id_pelanggan', $order->id_pelanggan)->where('status_rental','pendding')->count();
                    } else {
                        $notif_order = '0';
                    }

                    $riwayat = App\Models\Transaction::join('tbl_rental', 'tbl_rental.id_rental', '=', 'transactions.id_rental')->where('id_pelanggan', auth()->user()->id)->where('status_rental','proses')->first();
                    if (!empty($riwayat)) {
                        $notif_riwayat = App\Models\Transaction::join('tbl_rental', 'tbl_rental.id_rental', '=', 'transactions.id_rental')->where('id_pelanggan', $riwayat->id_pelanggan)->where('status_rental','proses')->count();
                    } else {
                        $notif_riwayat = '0';
                    }
                @endphp
                <li class="nav-item dropdown py-2">
                    <a class="nav-link dropdown-toggle" type="button" id="usersmenu" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->username }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usersmenu">
                        <li>
                            <a class="dropdown-item" href="{{ route('myprofile') }}">Profil</a>
                            <a class="dropdown-item" href="{{ route('riwayat', auth()->user()->id) }}">Riwayat
                                Penyewaan <span class="notif-riwayat">{{ $notif_riwayat }}</span></a>
                            <a class="dropdown-item text-danger logout" href="{{ route('posts.logout') }}">
                                {{ __('Logout') }} <i class="bi bi-box-arrow-right"></i>
                            </a>
                            <form id="logout-form" action="{{ route('posts.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>

                <span class="mx-2"></span>

                <li class="nav-item py-2" style="position: relative;">
                    <a href="{{ route('keranjang', auth()->user()->id) }}" class="cart-container">
                        <i class="bi bi-bookmark-fill icon-keranjang">
                            <span class="notif-keranjang">{{ $notif_order }}</span>
                        </i>
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
