<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register App</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            margin: 0;
            /* display: flex; */
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden; /* Prevent the pseudo-element from overflowing */
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: url('assets/img/latar.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.5; /* Adjust the opacity as needed (0.0 to 1.0) */
            z-index: -1; /* Place the pseudo-element behind the content */
        }

        /* The rest of your styles go here */

    </style>
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
        <div class="container-fluid mx-4">
            <a class="navbar-brand" href="{{ route('home') }}" style="color: rgb(2, 59, 124);;"><i class="bi bi-car-front-fill"></i> SiRentCar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Beranda</a>
                    <a class="nav-link" href="#">Produk Kami</a>
                    <a class="nav-link" href="#">Blog</a>
                    <a class="nav-link" href="#">Kontak Kami</a>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary btn-sm text-white px-3 mr-2" href="{{ route('login') }}">
                                <i class="bi bi-person-circle"></i> {{ __('Login') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-dark btn-sm px-3 text-white" href="{{ route('register') }}">
                                <i class="bi bi-box-arrow-in-right"></i> {{ __('Register') }}</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block " style="background-image: url('assets/img/bg-login.jpg'); background-size: cover; background-position: left;"></div>
                            <div class="col-lg-7">
                                <div class="p-5 mb-5">

                                    <div class="text-center mb-3 mt-5">
                                        <h5 class="h3 text-gray-900 mb-2 mt-2">Register SiRentCar</h5>
                                        <p>Lakukan register untuk jelajihi SiRentCar</p>
                                    </div>

                                    <form class="user" action="{{ route('posts.register') }}" method="POST">
                                        <input type="hidden" name="aksi" value="Register">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    @csrf
                                                    <input type="text" name="nama" class="form-control p-3 @error('nama') is-invalid @enderror" placeholder="Nama anda" autocomplete="off" value="{{ old('nama') }}">
                                                    @error('nama')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    @csrf
                                                    <input type="email" name="email" class="form-control p-3 @error('email') is-invalid @enderror" placeholder="Email anda" autocomplete="off" value="{{ old('nama') }}">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    @csrf
                                                    <input type="number" name="no_telpon" class="form-control p-3 @error('no_telpon') is-invalid @enderror" placeholder="0xxxxxx" autocomplete="off" value="{{ old('no_telpon') }}">
                                                    @error('no_telpon')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    @csrf
                                                    <input type="username" name="username" class="form-control p-3 @error('username') is-invalid @enderror" placeholder="Username" autocomplete="off" value="{{ old('username') }}">
                                                    @error('username')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    @csrf
                                                    <input type="password" name="password" class="form-control p-3 @error('password') is-invalid @enderror" placeholder="Password">
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-block p-2 text-white" style="background: rgb(2, 59, 124);">
                                            Login
                                        </button>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <small class="text-dark">Sudah punya akun?, </small><a class="small text-primary" href="{{ route('login') }}">Login kuy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js')}}"></script>
    @include('sweetalert::alert')
</body>

</html>
