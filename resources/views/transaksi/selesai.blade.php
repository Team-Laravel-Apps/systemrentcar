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
                                    <th>ID Transaksi</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Telepon</th>
                                    <th>Kendaraan</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Lama Sewa</th>
                                    <th>Total Biaya</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selesai as $data)
                                    @php
                                        $start_date = new \DateTime($data->start_date);
                                        $end_date = new \DateTime($data->end_date);
                                        $hari = $start_date->diff($end_date)->days;

                                        $outdate = new \DateTime(now());
                                        $expired = $end_date->diff($outdate)->days;
                                    @endphp
                                    <tr>
                                        <td>{{ $data->id_transaction }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->no_telpon }}</td>
                                        <td>{{ $data->nama_kendaraan }}</td>
                                        <td>
                                            @if($data->end_date < now())
                                                <span class="badge badge-danger" style="font-size: 13px;">Expired {{ $expired }} hari</span>
                                            @else
                                                <span class="badge badge-primary" style="font-size: 13px;">{{ \Carbon\Carbon::parse($data->end_date)->isoFormat('LL') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $hari }} Hari</td>
                                        <td>@currency($data->biaya)</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#bukti{{ $data->id }}"><i class="bi bi-cash"></i></a>
                                            <a class="btn btn-sm btn-primary" href="{{ route('invoice.print', $data->id_transaction) }}"><i class="bi bi-receipt-cutoff"></i></a>
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
