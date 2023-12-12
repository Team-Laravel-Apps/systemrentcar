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
                    <a href="{{ route('add.mobil') }}" class="btn btn-sm mb-3 text-white" style="background-color: rgb(2, 59, 124);">Tambah Kategori <i class="bi bi-database-add"></i></a>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($mobil as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama_kendaraan }}</td>
                                    <td>
                                        <a href="{{ route('up.kategori', $data->id_car) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i> Edit</a>
                                        <a href="{{ route('delete.kategori', $data->id_car) }}" data-nama="{{ $data->nama_kendaraan }}" class="btn btn-sm btn-danger delete-button"><i class="bi bi-trash-fill"></i> Hapus</a>
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
                text: `Anda akan menghapus kategori : ${nama}`,
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
