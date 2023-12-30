<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/icon.gif') }}" />
    <title>App SiRentCar</title>
    <style>
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

        .icon-keranjang {
            font-size: 24px;
            color: rgb(255, 153, 0);
            position: relative;
        }

        .notif-keranjang {
            font-size: 10px;
            background-color:rgb(255, 153, 0);
            color: #fff;
            border-radius: 50%;
            padding: 2px 6px;
            position: absolute;
        }

        .notif-riwayat {
            font-size: 10px;
            background-color:rgb(1, 43, 106);
            color: #fff;
            border-radius: 50%;
            padding: 3px 6px;
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

    @include('layouts.navbar')

    <div class="container">
        @yield('homepage')
    </div>

    <footer class="container py-5 pt-5 border-top">
        <div class="container row">
            <div class="col-lg-12 col-12 col-md">
                <p class="h2" style="color: rgb(2, 59, 124);"><i class="bi bi-car-front-fill"></i> SiRentCar</p>
                <small class="d-block mb-3 text-muted">&copy; 2022–2023</small>
            </div>
            <div class="col-lg-4 col-12">
                <h5>Menu</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Beranda</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Produk Kami</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Blog</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Kontak Kami</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-12">
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
            <div class="col-lg-4 col-12">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script>
        $(document).ready(function(){
          $(".preloader").fadeOut();
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.querySelectorAll('.logout').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const deleteUrl = this.getAttribute('href');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Ingin logout dari aplikasi',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Logout!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(deleteUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token if needed
                                'Content-Type': 'application/json', // Adjust the content type if necessary
                            },
                            // You can include a request body if needed
                            // body: JSON.stringify({}),
                        })
                        .then(response => {
                            // Handle the response as needed
                            window.location.href = deleteUrl;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    }
                });
            });
        });

    </script>
    @include('sweetalert::alert')
</body>

</html>
