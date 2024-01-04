@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Transaksi Proses <i class="bi bi-arrow-clockwise" style="color: rgb(2, 59, 124);"></i></h1>

    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-3">
                            <i class="bi bi-cash-stack" style="font-size: 40px; color: rgb(2, 59, 124);"></i>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Transaksi proses
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $proses->count() }}</div>
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
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0"
                            style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Telepon</th>
                                    <th>Kendaraan</th>
                                    <th>Pengembalian</th>
                                    <th>Lama Sewa</th>
                                    <th>Total Biaya</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proses as $data)
                                    @php
                                        $start_date = new \DateTime($data->start_date);
                                        $end_date = new \DateTime($data->end_date);
                                        $hari = $start_date->diff($end_date)->days;
                                    @endphp
                                    <tr>
                                        <td>{{ $data->id_transaction }}</td>
                                        <td class="col-2">{{ $data->nama }}</td>
                                        <td>{{ $data->no_telpon }}</td>
                                        <td class="col-2">{{ $data->nama_kendaraan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->end_date)->isoFormat('LL') }}</td>
                                        <td>{{ $hari }} Hari</td>
                                        <td>@currency($data->biaya)</td>
                                        <td>
                                            <div class="tooltip-container">
                                                <button class="btn btn-sm btn-primary proses" onclick="event.preventDefault(); document.getElementById('proses-form');">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                                <span class="tooltip-text">Selesaikan transaksi</span>
                                            </div>
                                            <div class="tooltip-container">
                                                <a class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#bukti{{ $data->id }}"><i class="bi bi-cash"></i></a>
                                                <span class="tooltip-text">Bukti pembayaran</span>
                                            </div>
                                            <div class="tooltip-container">
                                                <a class="btn btn-sm btn-warning text-dark" href="{{ route('invoice.print', $data->id_transaction) }}"><i class="bi bi-receipt-cutoff"></i></a>
                                                <span class="tooltip-text">Invoice</span>
                                            </div>
                                        </td>
                                        <form id="proses-form" action="{{ route('approvel.transaksi') }}" method="POST" class="d-none">
                                            @csrf
                                            <input type="hidden" name="id_rental" value="{{ $data->id_rental }}">
                                            <input type="hidden" name="id_car" value="{{ $data->id_car }}">
                                            <input type="hidden" name="status" value="selesai">
                                            <input type="hidden" name="aksi" value="Menyelesaikan transaksi">
                                            <input type="hidden" name="is_complete" value="1">
                                        </form>
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
    document.querySelectorAll('.proses').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const form = document.getElementById('proses-form');
            const confirmationMessage = 'Ingin menyelesaikan proses ini';

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: confirmationMessage,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Selesaikan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form using JavaScript
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
