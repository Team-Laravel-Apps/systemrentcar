@extends('layouts.app')
@section('content')
@php
    $iconProfile = asset('drive/profile/' . ($users->profile ?? 'profile.png'));
@endphp
<div class="container-fluid">
    <form action="{{ route('posts.users') }}" method="POST" class="row" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12 mb-3">
            <h1 class="h3 text-capitalize">
                @if(Route::is('up.profile'))
                    Update Profile
                @else
                {{$aksi}}
                @endif
                <i class="bi bi-person-plus"></i>
            </h1>
        </div>

        <div class="col-12 col-lg-6 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <div class="row mb-4 g-1">
                        <div class="col-lg-12">
                            <ul class="text-info">
                                <li style="font-size: 12px;">Isi seluruh format input yang telah tersedia</li>
                                <li style="font-size: 12px;">Data users memiliki beberapa akses dari role yang telah dipilih</li>
                            </ul>
                        </div>

                        <input type="hidden" name="id" value="{{ $users->id ?? '' }}">
                        <input type="hidden" name="aksi" value="{{ $aksi }}">

                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Profile Gambar</label>
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

                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Nama Users</label>
                                <input type="text" name="nama" class="form-control @error ('nama') is-invalid @enderror" placeholder="Masukan nama anda.." value="{{ $users->nama ?? old('nama') }}">
                                @error('nama')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Telpon</label>
                                <input type="number" name="no_telpon" class="form-control @error ('no_telpon') is-invalid @enderror" placeholder="0xxxxxxxxxx" value="{{ $users->no_telpon ?? old('no_telpon') }}">
                                @error('no_telpon')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control @error ('email') is-invalid @enderror" placeholder="example@email.com" value="{{ $users->email ?? old('email') }}">
                                @error('email')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control @error ('username') is-invalid @enderror" placeholder="Masukan username.." value="{{ $users->username ?? old('username') }}">
                                @error('username')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 mb-0">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control @error ('password') is-invalid @enderror" placeholder="**********" value="{{ old('password') }}" autocomplete="off">
                                @error('password')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                                @if($aksi == 'Update users')
                                <p class="form-text mb-0 text-info" style="font-size: 10px;">! Kosongkan input jika tidak melakukan perubahan password</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Role</label>
                                <select name="id_role" class="select form-control @error ('id_role') is-invalid @enderror">
                                    @php
                                        $selectRole = $users['id_role'] ?? old('id_role');
                                    @endphp
                                    <option selected disabled>Pilih role..</option>
                                    @foreach ($role as $item)
                                        <option value="{{ $item->id_role }}" {{ $selectRole == $item->id_role ? 'selected' : '' }}>{{ $item->nama_role }}</option>
                                    @endforeach
                                </select>
                                @error('id_role')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control mb-0 @error('alamat') is-invalid @enderror" placeholder="Masukan alamat users..">{{ $users->alamat ?? old('alamat') }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <a href="{{ route('users') }}" class="btn btn-danger">Kembali <i class="bi bi-x-circle-fill"></i></a>
                            <button type="submit" class="btn btn-primary">Simpan <i class="bi bi-check-circle-fill"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Kode JavaScript Anda disini
        var fileInput = document.getElementById("upload-input");
        var imagePreview = document.getElementById("previewImage");

        fileInput.addEventListener("change", function() {
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.src = "{{ $iconProfile }}";
            }
        });
    });

</script>
@endsection
