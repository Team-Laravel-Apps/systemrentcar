@extends('layouts.homepage')
@section('homepage')
<style>
    .carousel-inner img {
        object-fit: cover;
        height: 400px;
        width: 100%;
        background-size: cover;
        background-position: center;
    }
</style>

<div class="container row justify-content-center mt-3">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner" style="height: 400px;">
            <div class="carousel-item active d-flex align-items-center">
                <img src="{{ asset('assets/img/slider1.jpg') }}" class="d-block" alt="...">
            </div>
            <div class="carousel-item d-flex align-items-center">
                <img src="{{ asset('assets/img/slider2.jpg') }}" class="d-block" alt="...">
            </div>
            <div class="carousel-item d-flex align-items-center">
                <img src="{{ asset('assets/img/slider3.jpg') }}" class="d-block" alt="...">
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

    <div class="container col-md-12 mt-4" style="border-radius: 10px;">
        <p class="text-secondary" style="font-size: 20px;">Kategori Kendaraan</p>
        <div class=" pt-3">
            <div style="display: flex; overflow-x : auto;" id="pot">
                @foreach($kategori as $item)
                <div class="card mx-auto border-0" style="min-width: 6rem; height: 8rem; line-height: 2rem; min-height: 2rem; display: block;">
                    <a class="px-auto" href="#" style="text-decoration: none;">
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
        <div class="col-md-3 mb-3">
            <div class="card">
                <img src="{{ asset('drive/cars/'. $data->img_kendaraan) }}" class="card-img-top" alt="{{ $data->nama_kendaraan }}" style="background-size: cover; background-position: center; min-height: 200px; max-width: 100%; object-fit: cover;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="card-title">{{ $data->nama_kendaraan }}</h5>
                        </div>
                        <div class="col-12">
                            <h5 class="float-right"><b>Rp. {{ number_format($data->biaya_sewa) }}</b></h5>
                        </div>
                    </div>
                    <p class="card-text">Type : {{ $data->category }}</p>
                    <a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Rental Sekarang</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection
