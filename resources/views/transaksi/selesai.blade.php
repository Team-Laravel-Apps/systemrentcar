@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Transaksi Selesai <i class="bi bi-check2-circle" style="color: rgb(27, 99, 14);"></i></h1>

    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-3">
                            <i class="bi bi-cash-stack" style="font-size: 40px; color: rgb(27, 99, 14);"></i>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Transaksi selesai
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $selesai->count() }}</div>
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
                                    <th>Telepon</th>
                                    <th>Kendaraan</th>
                                    <th>Start Penyewaan</th>
                                    <th>End Penyewaan</th>
                                    <th>Lama Sewa</th>
                                    <th>Total Biaya</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($selesai as $data)
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
                                            <a class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#bukti{{ $data->id }}"><i class="bi bi-receipt-cutoff"></i> Invoice</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const nama = this.getAttribute('data-nama');
            const deleteUrl = this.getAttribute('href');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan menghapus users : ${nama}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        });
    });
</script>
@endsection
