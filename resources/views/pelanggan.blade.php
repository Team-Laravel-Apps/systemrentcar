@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pelanggan</h1>

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
                                Jumlah Pelanggan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pelanggan->count() }}</div>
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
                                @foreach ($pelanggan as $data)
                                @php
                                    $iconProfile = asset('drive/profile/' . ($data->profile ?? 'profile.png'));
                                @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->no_telpon }}</td>
                                        <td class="col-3">{{ $data->alamat }}</td>
                                        <td class="col-2">
                                            <a class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#detail{{ $data->id }}"><i class="bi bi-eye-fill"></i> Detail</a>
                                            <a href="{{ route('delete.pelanggan', $data->id) }}" data-nama="{{ $data->nama }}" class="btn btn-sm btn-danger delete-button"><i class="bi bi-trash-fill"></i> Hapus</a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="detail{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Data diri pelanggan</h5>
                                                    <button type="button" class="btn-close bg-close text-danger bg-transparent" style="border: none;" data-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row g-0 mx-2">
                                                        <div class="col-lg-5 col-sm-12 mb-2">
                                                            <div class="form-group">
                                                                <p class="mx-3">Profile Gambar</p>
                                                                <div class="upload-container">
                                                                    <div class="profile-image-container">
                                                                        <img src="{{ $iconProfile }}" alt="Profile Image" id="previewImage">
                                                                        <div class="overlay">
                                                                            <label for="upload-input" class="upload-button">
                                                                                <i class="bi bi-camera mr-1"></i> Upload
                                                                            </label>
                                                                            <input type="file" id="upload-input" name="profile" accept="image/*">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-7 col-sm-12">
                                                            <div class="col-md-12">
                                                                <label for="" class="mb-0" style="font-size: 14px;">Nama Pelanggan</label>
                                                                <p class="text-dark">{{ $data->nama }}</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="" class="mb-0" style="font-size: 14px;">Telepon</label>
                                                                <p class="text-dark">{{ $data->no_telpon ?? 'data kosong' }}</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="" class="mb-0" style="font-size: 14px;">Email</label>
                                                                <p class="text-dark">{{ $data->email ?? 'data kosong' }}</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="" class="mb-0" style="font-size: 14px;">NIK</label>
                                                                <p class="text-dark">{{ $data->nik ?? 'data kosong' }}</p>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="" class="mb-0" style="font-size: 14px;">Gender</label>
                                                                <p class="text-dark">{{ $data->gender ?? 'data kosong' }}</p>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label for="" class="mb-0" style="font-size: 14px;">Tgl. Bergabung</label>
                                                                <p class="text-dark">{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('LL') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
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
