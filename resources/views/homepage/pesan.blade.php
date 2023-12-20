@extends('layouts.homepage')
@section('homepage')
<form action="{{ route('checkout.posts') }}" method="POST">
    @csrf
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12 mb-3">
                <nav class="navbar navbar-light" style="background: rgb(2, 59, 124);">
                    <div class="container-fluid">
                        <p class="navbar-brand mb-0 text-white">Pesanan Saya</p>
                    </div>
                </nav>
            </div>

            <div class="col-lg-6 col-12">
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-4 mb-2">
                                    <a href="{{ route('detail.produk', $item->id) }}" style="text-decoration: none; color: black;">
                                        <img src="{{ asset('drive/cars/' . $item->img_kendaraan) }}" alt="Travel image" class="img-fluid" alt="{{$item->nama_kendaraan}}">
                                    </a>
                                </div>

                                <div class="col-md-12 col-12 row">
                                    <div class="col-lg-8 mb-2">
                                        <a href="{{ route('detail.produk', $item->id) }}" style="text-decoration: none; color: black;">
                                            <span class="text-secondary">{{ $item->category }}</span>
                                            <h5 class="mb-1">{{ $item->nama_kendaraan }}</h5>
                                            <p class="text-dark mb-1" style="font-size: 20px;">@currency($item->biaya_sewa)</p>
                                        </a>
                                    </div>

                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="">Start Peminjaman</label>
                                            <input type="date" class="form-control @error ('start_date') is-invalid @enderror" name="start_date" value="{{ date('Y-m-d') ?? old('start_date') }}">
                                            @error('start_date')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="">End Peminjaman</label>
                                            <input type="date" class="form-control @error ('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <label>Subtotal Biaya</label>
                            <h2 class="text-start"><b>Rp. {{ number_format($item->biaya_sewa ?? 'Rp. 0') }}</b></h2>
                            <p>Syarat & Ketentuan</p>
                            <p style="font-weight: 600;">Syarat Lepas Kunci ( Domisili Didaerah Rental )</p>
                            <ul>
                                <li>KTP Asli</li>
                                <li>Akun Sosial Media</li>
                                <li>Motor beserta STNK</li>
                            </ul>
                            <p style="font-weight: 600;">Syarat Lepas Kunci ( Luar Domisili )</p>
                            <ul>
                                <li>KTP Asli</li>
                                <li>Akun Sosial Media</li>
                                <li>Deposito Sebesar Rp 1.000.000 <br> ( Dikembalikan Setelah melakukan Rental Mobil )</li>
                            </ul>
                        </div>

                        <div class="text-end">
                            <input type="hidden" name="car_id" value="{{ $item->id_car }}">
                            <input type="hidden" name="biaya" value="{{ $item->biaya_sewa }}">
                            <button type="" class="btn text-white" style="background: rgb(2, 59, 124);">Checkout <i class="bi bi-send"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
