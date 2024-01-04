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
                                Pengembalian Kendaraan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count }}</div>
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
                        <table class="table table-striped" id="dataTable" width="100%" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Kendaraan</th>
                                    <th>Pengembalian</th>
                                    <th>Lama Sewa</th>
                                    <th>Denda</th>
                                    <th>Total Biaya</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengembalian as $data)
                                    @php
                                        $start_date = new \DateTime($data->start_date);
                                        $end_date = new \DateTime($data->end_date);
                                        $hari = $start_date->diff($end_date)->days;

                                        $outdate = new \DateTime(now());
                                        $expired = $end_date->diff($outdate)->days;

                                        $extend = $start_date->diff($outdate)->days;

                                        $denda = 100000 * $expired;
                                    @endphp
                                    <tr>
                                        <td>{{ $data->id_transaction }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->nama_kendaraan }}</td>
                                        <td>
                                            @if($data->status_rental == 'dikembalikan')
                                                {{ \Carbon\Carbon::parse($data->end_date)->isoFormat('LL') }}
                                            @else
                                                @if($data->end_date < now())
                                                    <span class="badge badge-danger" style="font-size: 13px;">Expired {{ $expired }} hari</span>
                                                @else
                                                    <span class="badge badge-primary" style="font-size: 13px;">{{ \Carbon\Carbon::parse($data->end_date)->isoFormat('LL') }}</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->status_rental == 'dikembalikan')
                                                @if($hari == 0)
                                                    1 Hari
                                                @else
                                                    {{ $hari }} Hari
                                                @endif
                                            @else
                                                @if($data->end_date < now())
                                                    {{ $extend }} Hari
                                                @else
                                                    {{ $hari }} Hari
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            ( +{{$expired}} hari ) <br> @currency($denda)
                                        </td>
                                        <td>@currency($data->biaya + $denda)</td>
                                        <td>
                                            @if($data->status_rental == 'dikembalikan')
                                                <span class="badge badge-primary" style="font-size: 13px;">Diterima</span>
                                            @else
                                                <span class="badge badge-warning text-dark" style="font-size: 13px;">Rental</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->status_rental == 'selesai')
                                            <div class="tooltip-container">
                                                <button class="btn btn-sm btn-primary proses" onclick="event.preventDefault(); document.getElementById('proses-form');">
                                                    <i class="bi bi-arrow-left-right"></i>
                                                </button>
                                                <span class="tooltip-text">Mobil diterima</span>
                                            </div>
                                            @endif
                                            <div class="tooltip-container">
                                                <a class="btn btn-sm btn-warning text-dark" href="{{ route('denda.print', $data->id_transaction) }}"><i class="bi bi-currency-dollar"></i></a>
                                                <span class="tooltip-text">Biaya denda</span>
                                            </div>
                                        </td>
                                        <form id="proses-form" action="{{ route('diterima.transaksi') }}" method="POST" class="d-none">
                                            @csrf
                                            <input type="hidden" name="id_rental" value="{{ $data->id_rental }}">
                                            <input type="hidden" name="id_car" value="{{ $data->id_car }}">
                                            <input type="hidden" name="status" value="dikembalikan">
                                            <input type="hidden" name="is_complete" value="1">
                                        </form>
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
