@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    </div>


    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-3">
                            <i class="bi bi-car-front-fill" style="font-size: 40px; color: rgb(2, 124, 93);"></i>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Jumlah Kendaraan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cars->count() }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-3">
                            <i class="bi bi-person-standing" style="font-size: 40px; color: rgb(2, 124, 93);"></i>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Jumlah Penyewa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pelanggan->count() }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-3">
                            <i class="bi bi-cash-stack" style="font-size: 40px; color: rgb(2, 124, 93);"></i>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Jumlah Transaksi
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">@currency($transaksi->sum('payment_amount'))</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
