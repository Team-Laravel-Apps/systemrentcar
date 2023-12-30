@extends('layouts.homepage')
@section('homepage')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-12 mb-3">
            <nav class="navbar navbar-light" style="background: rgb(2, 59, 124);">
                <div class="container-fluid">
                    <p class="navbar-brand mb-0 text-white">Keranjang Saya ({{ $rental->count() }})</p>
                </div>
            </nav>
        </div>

        <div class="col-lg-6 col-12">
            @forelse ($rental as $item)
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 col-5">
                                <a href="{{ route('detail.produk', $item->id) }}" style="text-decoration: none; color: black;">
                                    <img src="{{ asset('drive/cars/' . $item->img_kendaraan) }}" alt="Travel image" class="img-fluid" alt="{{$item->nama_kendaraan}}">
                                </a>
                            </div>

                            <div class="col-md-7 col-7 row g-1">
                                <div class="col-lg-12">
                                    <a href="{{ route('detail.produk', $item->id) }}" style="text-decoration: none; color: black;">
                                        <span class="text-secondary">{{ $item->category }}</span>
                                        <h5 class="mb-1">{{ $item->nama_kendaraan }}</h5>
                                        <p class="text-dark mb-1" style="font-size: 20px;">@currency($item->biaya_sewa)</p>
                                    </a>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <a href="{{ route('checkout', $item->id_car) }}" class="btn btn-sm text-white" style="background: rgb(2, 59, 124);">Checkout <i class="bi bi-inboxes-fill"></i></a>
                                    <a href="{{ route('delete.keranjang', $item->id_rental) }}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h1 class="px-4 h6 text-center">
                            <img src="{{ URL::to('assets/img/icon.gif') }}" width="200">
                            <p>Tidak ada produk di rental</p>
                        </h1>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <div class="col-lg-6 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
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
            </div>
        </div>
    </div>
</div>

@endsection
