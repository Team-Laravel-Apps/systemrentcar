@section('title', 'Login')
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website penyedia layanan penyewaan mobil online di bali">
    <meta name="author" content="Aisyah">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/icon.gif') }}" />

    <title>Login App</title>

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
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
        }
        .preloader .loading {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            font: 14px arial;
        }

        .custom-search {
            position: relative;
        }

        .custom-search input {
            padding-right: 30px;
            border-radius: 24px;
            font-size: 15px;
        }

        .custom-search .input-group-text {
            background: none;
            border: none;
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            padding: 10px;
            cursor: pointer;
            transition: color 0.3s ease; /* Tambahkan transisi warna untuk efek yang halus */
        }

        .custom-search input:focus + .input-group-text,
        .custom-search input:not(:placeholder-shown) + .input-group-text {
            color: #000; /* Ganti dengan warna yang diinginkan saat input aktif atau terisi */
        }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="loading">
          <img src="{{URL::to('assets/img/loader.gif')}}" width="300">
        </div>
    </div>

    @include('auth.navbar')

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block " style="background-image: url('assets/img/bg-login.jpg'); background-size: cover; background-position: left;"></div>
                            <div class="col-lg-6">
                                <div class="p-5 mb-5">

                                    <div class="text-center mb-3 mt-5">
                                        <h5 class="h3 text-gray-900 mb-2 mt-2">Login SiRentCar</h5>
                                        <p>Selamat datang di system SiRentCar</p>
                                    </div>

                                    <form class="user" action="{{ route('posts.login') }}" method="POST">
                                        <div class="form-group">
                                            @csrf
                                            <input type="username" name="username" class="form-control p-3 @error('username') is-invalid @enderror" placeholder="Username" autocomplete="off" value="{{ old('username') }}">
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            @csrf
                                            <input type="password" name="password" class="form-control p-3 @error('password') is-invalid @enderror" placeholder="Password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-block p-2 text-white" style="background: rgb(2, 59, 124);">
                                            Login
                                        </button>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small text-dark" href="#">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <small class="text-dark">Belum punya akun?, </small><a class="small text-primary" href="{{ route('register') }}">Register kuy</a>
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
    <script>
        $(document).ready(function(){
          $(".preloader").fadeOut();
        })
    </script>
    @include('sweetalert::alert')
</body>

</html>
