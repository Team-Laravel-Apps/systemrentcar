@extends('layouts.homepage')
@section('homepage')
<style>
    .carousel-inner img {
        /* object-fit: cover; */
        max-height: 700px;
        width: 100%;
        background-size: cover;
        background-position: center;
    }
</style>

<div class="container mt-3">
    <div class="row justify-content-center align-items-center">

        <div class="container col-md-12 mt-4" style="border-radius: 10px;">
            <div class="d-flex flex-row justify-content-between">
                <p class="text-secondary" style="font-size: 20px;">KATEGORI</p>
                @if(Route::is('category.produk'))
                    <a href="{{ route('produk') }}" class="text-danger nav-link"><i class="bi bi-x"></i> Ganti Kategori</a>
                @endif
            </div>
            <div class="pt-3 d-flex justify-content-between">
                <div class="col-lg-12" style="display: flex; overflow-x : auto;" id="pot">
                    @foreach($kategori as $item)
                    <div class="card border-0 col-xxl-2 col-lg-3 col-md-4 col-6" style="min-width: 6rem; height: 8.5rem; line-height: 2rem; min-height: 2rem; display: block;">
                        <div class="card-body">
                            <a class="p-auto" href="{{ route('category.produk', $item->id_category) }}" style="text-decoration: none;">
                                <img src="{{ asset('drive/kategori/'. $item->icon) }}" class="card-img-top img-fluid mb-2" alt="#"
                                style="background-size: cover; background-position: center; max-height: 65px; max-width: 150px; object-fit: cover;">
                                <div class="text-center">
                                    <h6 class="font-weight-500 text-dark" style="max-width: 150px;">{{ $item->category }}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row mt-3 mb-5">
            <h4 class="text-secondary mb-3" style="font-weight: 400;"><i class="bi bi-car-front-fill"></i> Produk Kami</h4>
            @if(isset($cars) && $cars->count() > 0)
                @foreach ($cars as $data)
                    <div class="col-xxl-3 col-md-6 mb-3">
                        <div class="card shadow">
                            <a href="{{ route('detail.produk', $data->id) }}" style="text-decoration: none; color: black;">
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
            @else
                <div class="col-lg-12 col-md-12">
                    <div class="card border-0">
                        <div class="card-body d-flex justify-content-center">
                            <div>
                                <img src="{{ URL::to('assets/img/icon.gif') }}" width="200">
                                <p>Tidak ada produk ditemukan</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-lg-12 mt-4">
                <div class="d-flex justify-content-center">
                    {{ $cars->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
