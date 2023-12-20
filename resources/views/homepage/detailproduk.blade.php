@extends('layouts.homepage')
@section('homepage')
<style>
    .carousel-inner img {
        /* object-fit: cover; */
        max-height: 600px;
        width: 100%;
        background-size: cover;
        background-position: center;
    }
</style>
<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner" style="max-height: 700px;">
                <div class="carousel-item active d-flex align-items-center">
                    <img src="{{ asset('drive/cars/'. $detail->img_kendaraan) }}" class="d-block" alt="..." style="object-fit: cover;">
                </div>
            </div>
        </div>

        <div class="row mt-4 mb-5">
            <div class="col-lg-8">
                <p class="card-text mb-1 text-secondary">
                    <i class="bi bi-car-front-fill"></i> {{ $detail->category ?? 'tidak ada' }}
                </p>
                <h1>{{ $detail->nama_kendaraan }}</h1>
                <p>Transmisi : {{ $detail->transmisi }}</p>
                <p>Kapasitas kendaraan : {{ $detail->kapasitas }} orang</p>
                <p>Jumlah unit : {{ $detail->unit }} Unit</p>
                <span style="font-size: 14px;" class="@if($detail->status_car == 'tersedia') mb-3 badge bg-primary text-capitalize @else mb-3 badge bg-danger text-capitalize @endif">
                    {{ $detail->status_car == 'tersedia' ? 'tersedia' : 'tidak tersedia' }}
                </span>

                <article>{!! $detail->description !!}</article>
            </div>

            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-body py-3 pt-5 pb-5">
                        <label>Biaya Produk</label>
                        <h2 class="text-start"><b>Rp. {{ number_format($detail->biaya_sewa ?? 'Rp. 0') }}</b><span style="font-size: 14px;">/hari</span></h2>
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
                </div>

                <form action="{{ route('keranjang.posts') }}" method="POST">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $detail->id_car }}">
                    <input type="hidden" name="biaya" value="{{ $detail->biaya_sewa }}">
                    <a class="btn btn-success mb-2">Diskusi <i class="bi bi-whatsapp"></i></a>
                    <button type="submit" class="btn mb-2 text-white" style="background: rgb(18, 72, 0);">Save <i class="bi bi-cart"></i></button>
                    <a href="{{ route('checkout', $detail->id_car) }}" class="btn mb-2 text-white" style="background: rgb(2, 59, 124);">Pesan Sekarang <i class="bi bi-inboxes-fill"></i></a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
