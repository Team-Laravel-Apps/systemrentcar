@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kendaraan</h1>

    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-3">
                            <i class="bi bi-car-front-fill" style="font-size: 40px; color: rgb(2, 59, 124);"></i>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Jumlah Kendaraan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mobil->count() }}</div>
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
                    <a href="{{ route('add.mobil') }}" class="btn mb-3 text-white" style="background-color: rgb(2, 59, 124);">Tambah Kendaraan <i class="bi bi-database-add"></i></a>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kendaraan</th>
                                    <th>ID Kendaraan</th>
                                    <th>Biaya</th>
                                    <th>Jumlah Unit</th>
                                    <th>Status Kendaraan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($mobil as $data)
                                <tr>
                                    <td class="align-middle">{{ $no++ }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('drive/cars/'. $data->img_kendaraan) }}" width="50" height="50" class="img-profile rounded-circle mr-2" alt="{{ $data->nama_kendaraan }}">
                                            <span>{{ $data->nama_kendaraan }}</span>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $data->id_car }}</td>
                                    <td class="align-middle">@currency($data->biaya_sewa)</td>
                                    <td class="align-middle">{{ $data->unit }} Unit</td>
                                    <td class="align-middle">
                                        <span style="font-size: 14px;" class="@if($data->status_car == 'tersedia') badge badge-primary text-capitalize @else badge badge-danger text-capitalize @endif">
                                            {{ $data->status_car == 'tersedia' ? 'tersedia' : 'tidak tersedia' }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex">
                                            <a href="{{ route('up.mobil', $data->id) }}" class="btn btn-sm btn-primary mr-2"><i class="bi bi-pencil-fill"></i> Edit</a>
                                            <a href="{{ route('delete.cars', $data->id) }}" data-nama="{{ $data->nama_kendaraan }}" class="btn btn-sm btn-danger delete-button"><i class="bi bi-trash-fill"></i> Hapus</a>
                                        </div>
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
                text: `Anda akan menghapus katalog mobil : ${nama}`,
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
