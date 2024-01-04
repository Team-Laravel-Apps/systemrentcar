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
                    <img src="{{ asset('assets/img/slider1.png') }}" class="d-block" alt="...">
                </div>
                <div class="carousel-item d-flex align-items-center">
                    <img src="{{ asset('assets/img/slider2.png') }}" class="d-block" alt="...">
                </div>
                <div class="carousel-item d-flex align-items-center">
                    <img src="{{ asset('assets/img/slider3.png') }}" class="d-block" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container col-md-12 mt-4">
            <div class="row">
                <div class="col-lg-4 col-4 mb-2">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/img/iklan1.png') }}" alt="Respon cepat" width="200" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-4 mb-2">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/img/iklan2.png') }}" alt="Respon cepat" width="200" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-4 mb-2">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/img/iklan3.png') }}" alt="Respon cepat" width="200" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container col-md-12 mt-4" style="border-radius: 10px;">
            <p class="text-secondary" style="font-size: 20px;">Kategori Kendaraan</p>
            <div class="pt-3">
                <div style="display: flex; overflow-x : auto;" id="pot">
                    @foreach($kategori as $item)
                    <div class="card mx-auto border-0" style="min-width: 6rem; height: 8rem; line-height: 2rem; min-height: 2rem; display: block;">
                        <a class="px-auto" href="{{ route('category.produk', $item->id_category) }}" style="text-decoration: none;">
                            <img src="{{ asset('drive/kategori/'. $item->icon) }}" class="card-img-top img-fluid" alt="#"
                            style="background-size: cover; background-position: center; max-height: 70px; max-width: 150px; object-fit: cover;">
                            <div class="m-auto">
                                <h6 class="card-title text-center font-weight-600 text-dark" style="font-size: 15px;">{{ $item->category }}</h6>
                            </div>

                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="row mt-3 mb-5">
            <h4 class="text-secondary mb-3" style="font-weight: 400;"><i class="bi bi-bookmark-check-fill"></i> Rekomendasi buat anda</h4>
            @foreach ($car as $data)
            <div class="col-xxl-3 col-lg-4 col-md-6 mb-3">
                <div class="card shadow">
                    <a href="{{ route('detail.produk', $data->id_car) }}" style="text-decoration: none; color: black;">
                        <img src="{{ asset('drive/cars/'. $data->img_kendaraan) }}" class="card-img-top" alt="{{ $data->nama_kendaraan ?? 'tidak ada' }}" style="background-size: cover; background-position: center; min-height: 220px; max-width: 100%; object-fit: content;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <small class="card-text mb-1 text-secondary"><i class="bi bi-car-front-fill"></i> {{ $data->category ?? 'tidak ada' }}</small>
                                    <h6 class="card-title">{{ $data->nama_kendaraan ?? 'tidak ada'}}</h6>
                                </div>
                                <div class="col-12">
                                    <small class="float-right">Tersedia : {{ $data->unit ?? 'tidak ada' }} unit</small><br>
                                    <small class="float-right">Kapasitas : {{ $data->kapasitas ?? 'tidak ada' }} orang</small><br>
                                    <small class="float-right">Transmisi : {{ $data->transmisi ?? 'tidak ada' }}</small>
                                </div>
                            </div>
                            <div class="col-12 mb-3 mt-3">
                                <h5 class="text-end"><b>Rp. {{ number_format($data->biaya_sewa ?? 'Rp. 0') }}</b><span style="font-size: 14px;">/hari</span></h5>
                            </div>
                            <form action="{{ route('keranjang.posts') }}" method="POST" class="text-end">
                                @csrf
                                <a href="{{ route('checkout', $data->id_car) }}" class="btn text-white" style="background: rgb(2, 59, 124);">Pesan <i class="bi bi-inboxes-fill"></i></a>
                                <input type="hidden" name="car_id" value="{{ $data->id_car }}">
                                <input type="hidden" name="biaya" value="{{ $data->biaya_sewa }}">
                                <button type="submit" class="btn text-white" style="background: rgb(255, 153, 0);"><i class="bi bi-cart-fill"></i></button>
                            </form>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
