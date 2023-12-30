@extends('layouts.homepage')
@section('homepage')
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
