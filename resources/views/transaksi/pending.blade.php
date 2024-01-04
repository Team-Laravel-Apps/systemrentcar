@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Transaksi Pending <i class="bi bi-hourglass-split" style="color: rgb(255, 162, 0);"></i></h1>

    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-3">
                            <i class="bi bi-cash-stack" style="font-size: 40px; color: rgb(255, 162, 0);"></i>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Transaksi pending
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pending->count() }}</div>
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
                                    <th>Tgl. Sewa</th>
                                    <th>Lama Sewa</th>
                                    <th>Total Biaya</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pending as $data)
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
                                        <td>{{ \Carbon\Carbon::parse($data->start_date)->isoFormat('LL') }}</td>
                                        <td>{{ $hari }} Hari</td>
                                        <td>@currency($data->biaya)</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#bukti{{ $data->id }}"><i class="bi bi-cash"></i></a>
                                            <button class="btn btn-sm btn-primary proses" onclick="event.preventDefault(); document.getElementById('proses-form');">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger cancel" onclick="event.preventDefault(); document.getElementById('cancel-form');">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </td>
                                        <form id="proses-form" action="{{ route('approvel.transaksi') }}" method="POST" class="d-none">
                                            @csrf
                                            <input type="hidden" name="id_rental" value="{{ $data->id_rental }}">
                                            <input type="hidden" name="status" value="proses">
                                            <input type="hidden" name="is_complete" value="0">
                                        </form>
                                        <form id="cancel-form" action="{{ route('approvel.transaksi') }}" method="POST" class="d-none">
                                            @csrf
                                            <input type="hidden" name="id_rental" value="{{ $data->id_rental }}">
                                            <input type="hidden" name="id_transaction" value="{{ $data->id_transaction }}">
                                            <input type="hidden" name="status" value="batal">
                                            <input type="hidden" name="is_complete" value="0">
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
            const confirmationMessage = 'Ingin melanjutkan proses ini';

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: confirmationMessage,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjutkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form using JavaScript
                    form.submit();
                }
            });
        });
    });


    document.querySelectorAll('.cancel').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const form = document.getElementById('cancel-form');
            const confirmationMessage = 'Ingin membatalkan proses ini';

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: confirmationMessage,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Batalkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form using JavaScript
                    form.submit();
                }
            });
        });
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

@endsection
