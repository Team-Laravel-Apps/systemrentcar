@extends('layouts.homepage')
@section('homepage')
@php
    $start_date = new \DateTime($pay->start_date);
    $end_date = new \DateTime($pay->end_date);
    $hari = $start_date->diff($end_date)->days;

    $outdate = new \DateTime(now());
    $expired = $end_date->diff($outdate)->days;

    $extend = $start_date->diff($outdate)->days;

    $denda = 100000 * $expired;
@endphp
<div class="container mt-3">
    <div class="row justify-content-center align-items-center" style="height: height: 100vh;">
        <div class="col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        @if($pay->payment_date == null)
                        <div class="p-5 mb-3">
                            <div class="text-center mb-3 mt-5">
                                <h5 class="h3 text-gray-900 mb-2 mt-2">Portal Pembayaran</h5>
                                <p>Silakan lakukan pembayaran</p>

                                <div>
                                    <span><img src="{{ asset('assets/bank/bri.png') }}" alt="bank bri" width="100"></span>
                                    <p><b>Aisyah Nadya Wijdan</b> <br> <span class="text-secondary">1364-01-001295-53-6</span></p>
                                </div>

                                <div>
                                    <span><img src="{{ asset('assets/bank/bca.png') }}" alt="bank bri" width="100"></span>
                                    <p><b>Aisyah Nadya Wijdan</b> <br> <span class="text-secondary">5410425787</span></p>
                                </div>

                                <form action="{{ route('payment.posts') }}" class="row justify-content-center align-items-center" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_transaction" value="{{ $pay->id_transaction ?? '' }}">
                                    <input type="hidden" name="id_rental" value="{{ $pay->id_rental ?? '' }}">
                                    <input type="hidden" name="payment_amount" value="{{ $pay->payment_amount ?? '' }}">
                                    <input type="hidden" name="payment_date" value="{{ date('Y-m-d') }}">

                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">Upload Bukti</label>
                                            <input type="file" class="form-control @error ('transfer') is-invalid @enderror" name="transfer">
                                            @error('transfer')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-0">
                                        <a href="{{ route('home') }}" class="btn text-white" style="background: rgb(2, 59, 124);">Kembali ke home</a>
                                        <button type="submit" class="btn text-white" style="background: rgb(2, 59, 124);">Upload <i class="bi bi-upload"></i></button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        @elseif($pay->status_rental == "pending")
                        <div class="p-5 mb-3">
                            <div class="text-center mb-3">
                                <img src="{{ asset('assets/img/proses.gif') }}" alt="" width="400" class="img-fluid mb-0">
                                <h5 class="h3 text-gray-900 mb-2 mt-2">Memproses Pembayaran</h5>
                                <p>Menunggu Pembayaran di proses oleh admin kami...</p>
                                <a href="{{ route('home') }}" class="btn text-white" style="background: rgb(2, 59, 124);">Kembali ke home</a>
                            </div>
                        </div>
                        @elseif($pay->status_rental == "proses")
                        <div class="p-5 mb-3">
                            <div class="text-center mb-3">
                                <img src="{{ asset('assets/img/success.gif') }}" alt="" width="300" class="img-fluid mb-0">
                                <h5 class="h3 text-gray-900 mb-2 mt-2">Pembayaran Telah Diterima</h5>
                                <p>Silakan cetak invoice dibawah ini untuk melanjutkan serah terima kendaraan</p>
                                <a href="{{ route('invoice.pelanggan', $pay->id_transaction) }}" class="btn text-white" style="background: rgb(6, 105, 4);">Invoice</a>
                                <a href="{{ route('home') }}" class="btn text-white" style="background: rgb(2, 59, 124);">Kembali ke home</a>
                            </div>
                        </div>
                        @elseif($pay->status_rental == "selesai")
                        <div class="p-5 mb-3">
                            <div class="text-center mb-3">
                                <img src="{{ asset('assets/img/sewagif.gif') }}" alt="" width="300" class="img-fluid mb-0">
                                <h5 class="h3 text-gray-900 mb-2 mt-2">Transaksi sewa mobil disetujui</h5>
                                <p class="mb-4">Silakan lakukan pengembalian mobil pada waktu yang telah disepakati dan jika melanggar akan dikenakan denda <br> Rp. 100.000/hari</p>
                                <p class="mb-0 text-center">Tanggal Pengembalian : {{ date('l, d F Y', strtotime($pay->end_date)) }}</p>
                                <p class="text-center mb-5">Countdown : <span id="countdown"></span></p>
                                <a href="{{ route('home') }}" class="btn text-white" style="background: rgb(2, 59, 124) ;">Kembali ke home</a>
                                @if($expired)
                                    <a href="{{ route('denda.pelanggan', $pay->id_transaction) }}" class="btn text-white" style="background: rgb(198, 1, 1);">Cek denda sekarang</a>
                                @endif
                                <p class="text-center mb-0 mt-5">Selamat menikmati kendaraan kami :)</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Mendapatkan tanggal mulai dan tanggal berakhir dari PHP
    const startDate = new Date("{{ $pay->start_date }}");
    const endDate = new Date("{{ $pay->end_date }}");


    // Fungsi untuk menghitung waktu yang tersisa dan memperbarui tampilan
    function updateCountdown() {
        var now = new Date();
        var timeRemaining = endDate - now;

        if (timeRemaining > 0) {
            var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
        } else {
            document.getElementById("countdown").innerHTML = "Waktu sudah habis.";
        }
    }

    // Memanggil fungsi updateCountdown setiap detik
    setInterval(updateCountdown, 1000);

    // Memanggil updateCountdown untuk pertama kali saat halaman dimuat
    updateCountdown();
</script>
@endsection
