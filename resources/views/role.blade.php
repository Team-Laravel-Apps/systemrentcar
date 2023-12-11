@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Role Users</h1>

    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-3">
                            <i class="bi bi-key-fill" style="font-size: 40px; color: rgb(2, 124, 93);"></i>
                        </div>

                        <div class="col">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Jumlah Role Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $role->count() }}</div>
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
                    <a type="button" data-toggle="modal" data-target=".add" class="btn btn-sm btn-success mb-3">Tambah Role Users <i class="bi bi-database-add"></i></a>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($role as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama_role }}</td>
                                    <td>
                                        @if($data->id_role == '1')
                                        <p class="mb-0" style="font-style: italic;">aksi dibatasi</p>
                                        @else
                                        <a type="button" data-toggle="modal" data-target=".edit{{ $data->id_role ?? '' }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i> Edit</a>
                                        <a href="{{ route('delete.role', $data->id_role) }}" data-nama="{{ $data->nama_role }}" class="btn btn-sm btn-danger delete-button"><i class="bi bi-trash-fill"></i> Hapus</a>
                                        @endif
                                    </td>
                                </tr>

                                <div class="modal fade edit{{ $data->id_role ?? '' }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-between mb-3">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Role Baru</h5>
                                                <button type="button" class="btn-close bg-transparent" data-dismiss="modal" aria-label="Close" style="border: none; color: red;"><i class="bi bi-x-lg"></i></button>
                                            </div>
                                            <form action="{{ route('update.role') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_role" value="{{ $data->id_role ?? '' }}">
                                                <div class="mb-3">
                                                    <label for="nama_role" class="col-form-label">Nama Role:</label>
                                                    <input type="text" name="nama_role" class="form-control mb-0 @error ('nama_role') is-invalid @enderror" placeholder="Nama Role" value="{{ $data->nama_role ?? old('name_role') }}">
                                                    @error('nama_role')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </form>
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


<div class="modal fade add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Role Baru</h5>
                <button type="button" class="btn-close bg-transparent" data-dismiss="modal" aria-label="Close" style="border: none; color: red;"><i class="bi bi-x-lg"></i></button>
            </div>
            <form action="{{ route('posts.role') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name_role" class="col-form-label">Nama Role:</label>
                    <input type="text" name="cnama_role" class="form-control mb-0 @error ('cnama_role') is-invalid @enderror" placeholder="Nama Role" value="{{ old('cnama_role') }}">
                    @error('cnama_role')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
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
                text: `Anda akan menghapus role : ${nama}`,
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
