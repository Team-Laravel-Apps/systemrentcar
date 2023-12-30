@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Transaksi Dibatalkan <i class="bi bi-x-lg text-danger"></i></h1>

    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-3">
                            <i class="bi bi-cash-stack" style="font-size: 40px; color: rgb(208, 4, 31);"></i>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Transaksi Dibatalkan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $batal->count() }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Telpon</th>
                                    <th>Alamat</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($batal as $data)
                                    @php
                                        $start_date = new \DateTime($data->start_date);
                                        $end_date = new \DateTime($data->end_date);
                                        $hari = $start_date->diff($end_date)->days;
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->no_telpon }}</td>
                                        <td>{{ $data->nama_kendaraan }}</td>
                                        <td>{{ $data->start_date }}</td>
                                        <td>{{ $data->end_date }}</td>
                                        <td>{{ $hari }} Hari</td>
                                        <td>@currency($data->biaya)</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#bukti{{ $data->id }}"><i class="bi bi-cash"></i> Bukti Transfer</a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="bukti{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                                    <button type="button" class="btn-close bg-close text-danger bg-transparent" style="border: none;" data-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('drive/transfer/'. $data->payment_image) }}" alt="bukti transfer" class="img-fluid">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
