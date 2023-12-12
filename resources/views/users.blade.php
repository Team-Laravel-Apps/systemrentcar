@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usersmanager</h1>

    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-3">
                            <i class="bi bi-people-fill" style="font-size: 40px; color: rgb(2, 59, 124);"></i>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Jumlah Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count->count() }}</div>
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
                    <a href="{{ route('add.users') }}" class="btn btn-sm mb-3 text-white" style="background-color: rgb(2, 59, 124);">Tambah Users <i class="bi bi-database-add"></i></a>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Users</th>
                                    <th>Username</th>
                                    <th>Posisi</th>
                                    <th>Telpon</th>
                                    <th>Alamat</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($user as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td>{{ $data->nama_role }}</td>
                                        <td>{{ $data->no_telpon }}</td>
                                        <td class="col-3">{{ $data->alamat }}</td>
                                        <td class="col-2">
                                            @if(auth()->user()->id_role != '1')
                                            <p class="mb-0" style="font-style: italic;">aksi dibatasi</p>
                                            @else
                                            <a href="{{ route('delete.users', $data->id) }}" data-nama="{{ $data->nama }}" class="btn btn-sm btn-danger delete-button"><i class="bi bi-trash-fill"></i> Hapus</a>
                                            <a href="{{ route('up.users', $data->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i> Edit</a>
                                            @endif
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
