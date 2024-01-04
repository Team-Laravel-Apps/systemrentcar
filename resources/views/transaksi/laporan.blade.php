@extends('layouts.app')
@section('content')
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #print-section, #print-section * {
            visibility: visible;
        }

        #print-section {
            position: absolute;
            left: 0;
            top: 0;
        }

        .no-print {
            display: none;
        }
    }
</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form class="no-print" action="{{ route('transaksi.laporan') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="start_date">Start Date:</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="end_date">End Date:</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for=""><br></label>
                                <button type="submit" class="btn btn-primary btn-block">Cari data</button>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for=""><br></label>
                                <a href="javascript:void(0);" onclick="printLaporan()" class="btn btn-primary no-print btn-block">Cetak disini <i class="bi bi-printer"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12" id="print-section">
            <div class="card shadow mb-4">
                <div class="card-body mt-4">
                    <h2 class="text-right" style="color: rgb(2, 59, 124);"><i class="bi bi-car-front-fill"></i> SiRentCar</h2>
                    <h4 class="mb-0" style="color: black;">Laporan Transaksi</h4>
                    <p class="mb-0" style="color: black; font-size: 14px;">Laporan transaksi PT SiRentcar Indonesia</p>
                    <p class="mb-3" style="color: rgb(99, 99, 99); font-size: 14px;">
                        Tanggal : {{ \Carbon\Carbon::parse(request('start_date') ?? \Carbon\Carbon::now())->isoFormat('LL') }} - {{ \Carbon\Carbon::parse(request('end_date') ?? \Carbon\Carbon::now())->isoFormat('LL') }}
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped" width="100%" cellspacing="0" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Kendaraan</th>
                                    <th>Biaya</th>
                                    <th>Tgl Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $data)
                                    <tr>
                                        <td>{{ $data->id_transaction }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->nama_kendaraan }}</td>
                                        <td>@currency($data->payment_amount)</td>
                                        <td>{{ \Carbon\Carbon::parse($data->payment_date)->isoFormat('LL') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total Biaya :</td>
                                    <td></td>
                                    <td></td>
                                    <td>@currency($transaksi->sum('payment_amount'))</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-right mt-3">
                        <p class="mt-3 mb-0 text-dark" style="font-size: 12px;"><b>PT SiRentcar Indonesia</b></p>
                        <p class="mb-0" style="font-size: 12px; color: gray;"><b>Jl. Nangka Growong Jl. H. Linan No.100, Klp. Dua Wetan,<br> Kec. Ciracas, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13730</b></p>
                        <p class="mb-5" style="font-size: 12px; color: gray;"><b>089827351127</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function printLaporan() {
        // Memanggil fungsi print bawaan browser
        window.print();
    }
</script>

@endsection
