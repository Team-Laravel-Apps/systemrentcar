@extends('layouts.homepage')
@section('homepage')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-12 mb-3">
            <nav class="navbar navbar-light" style="background: rgb(2, 59, 124);">
                <div class="container-fluid">
                    <p class="navbar-brand mb-0 text-white">Rental Saya ({{ $rental->count() }})</p>
                </div>
            </nav>
        </div>

        <div class="col-lg-6 col-12">
            @forelse ($rental as $item)
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-4">
                                <a href="{{ route('detail.produk', $item->id) }}" style="text-decoration: none; color: black;">
                                    <img src="{{ asset('drive/cars/' . $item->img_kendaraan) }}" alt="Travel image" class="img-fluid" alt="{{$item->nama_kendaraan}}">
                                </a>
                            </div>

                            <div class="col-md-8 col-8 row g-1">
                                <div class="col-lg-12">
                                    <a href="{{ route('detail.produk', $item->id) }}" style="text-decoration: none; color: black;">
                                        <span class="text-secondary">{{ $item->category }}</span>
                                        <h5 class="mb-1">{{ $item->nama_kendaraan }}</h5>
                                        <p class="text-dark mb-1" style="font-size: 20px;">@currency($item->biaya_sewa)</p>
                                    </a>
                                </div>

                                <div class="col-lg-4 col-7">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <form action="{{ route('keranjang.jumlah') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="car_id" value="{{ $item->car_id }}">
                                                <input type="hidden" name="value" value="min">
                                                <button type="submit" class="btn btn-sm btn-number" style="border: 1px solid gray;">
                                                    <i class="bi bi-dash-lg"></i>
                                                </button>
                                            </form>
                                        </span>
                                        <input type="text" value="{{ $item->qty }}" class="form-control form-control-sm input-number bg-transparent" readonly>
                                        <span class="input-group-btn">
                                            <form action="{{ route('keranjang.jumlah') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="car_id" value="{{ $item->car_id }}">
                                                <input type="hidden" name="value" value="plus">
                                                <button type="submit" class="btn btn-sm btn-number" style="border: 1px solid gray;">
                                                    <i class="bi bi-plus-lg"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-5">
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
                            <p>Tidak ada produk di keranjang</p>
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
                        <label>Subtotal Biaya</label>
                        <h2 class="text-start"><b>Rp. {{ number_format($rental->sum('biaya') ?? 'Rp. 0') }}</b></h2>
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
                        @if(count($rental) == 0)
                        @else
                            <button type="" class="btn text-white" style="background: rgb(2, 59, 124);">Pesan Sekarang <i class="bi bi-send"></i></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
