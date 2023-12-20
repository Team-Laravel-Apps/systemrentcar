@extends('layouts.homepage')
@section('homepage')
<style>
    .image-preview {
        text-align: center;
        margin-top: 10px;
    }

    #previewImage {
        max-width: 100%;
        max-height: 200px;
    }

    #previewImage1 {
        max-width: 100%;
        max-height: 200px;
    }

    .upload-container {
        position: relative;
    }

    .profile-image-container {
        position: relative;
        width: 150px;
        height: 150px;
        overflow: hidden;
        border-radius: 50%;
        border: 1px solid black;
    }

    .profile-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumbnail-container {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        /* border-radius: 50%; */
        border: 1px solid rgb(194, 194, 194);
    }

    .thumbnail-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumbnail-container:hover .overlay {
        opacity: 1;
    }


    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.6);
        color: #fff;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        cursor: pointer;
    }

    .profile-image-container:hover .overlay {
        opacity: 1;
    }

    .upload-button {
        padding: 100px 100px;
        margin: 5px 0 0 0;
        /* background-color: #3897f0; */
        border: none;
        border-radius: 5px;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .upload-button .icon {
        margin-right: 8px;
    }

    #upload-input {
        display: none;
    }

    #drop-area {
        position: relative;
        border: 2px dashed #ccc;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
    }

    #upload-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    #fileInput {
        display: none;
    }

    #preview-container {
        margin-top: 20px;
        text-align: center;
    }

    #preview {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        margin-bottom: 10px;
    }
</style>

@php
    $iconProfile = asset('drive/profile/' . (auth()->user()->profile ?? 'profile.png'));
@endphp
<form action="{{ route('myprofile.posts') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container mt-4 mb-5">
        <div class="col-lg-12 mb-3">
            <nav class="navbar navbar-light" style="background: rgb(2, 59, 124);">
                <div class="container-fluid">
                    <p class="navbar-brand mb-0 text-white">Profile Saya</p>
                </div>
            </nav>
        </div>

        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8 row g-0">
                <div class="col-lg-12">
                    <ul style="color: rgb(2, 59, 124);;">
                        <li style="font-size: 12px;">Isi seluruh format input yang telah tersedia</li>
                        <li style="font-size: 12px;">Data users memiliki beberapa akses dari role yang telah dipilih</li>
                    </ul>
                </div>

                <div class="col-lg-3 col-sm-12 mb-2">
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-group">
                            <label class="mb-3 text-center">Profile Gambar</label>
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
                            <label>Username</label>
                            <input type="text" name="username" class="form-control @error ('username') is-invalid @enderror" placeholder="Masukan username.." value="{{ auth()->user()->username ?? old('username') }}">
                            @error('username')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 mb-0">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control @error ('password') is-invalid @enderror" placeholder="**********" value="{{ old('password') }}" autocomplete="off">
                            @error('password')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                            <p class="form-text mb-0" style="font-size: 12px; color: rgb(2, 59, 124);;">! Kosongkan input jika tidak melakukan perubahan password</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-9 row">
                    <input type="hidden" name="id" value="{{ auth()->user()->id ?? '' }}">
                    <input type="hidden" name="aksi" value="Update profile">
                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-group">
                            <label>Nama Anda</label>
                            <input type="text" name="nama" class="form-control @error ('nama') is-invalid @enderror" placeholder="Masukan nama anda.." value="{{ auth()->user()->nama ?? old('nama') }}">
                            @error('nama')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control @error ('nik') is-invalid @enderror" placeholder="Masukan nik anda.." value="{{ auth()->user()->nik ?? old('nik') }}">
                            @error('nik')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                            @if(auth()->user()->nik == null)
                                <p class="form-text mb-0" style="font-size: 12px; color: rgb(255, 0, 17);;">! Lengkapi data nik terlebih dahulu</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 mb-2">
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="number" name="no_telpon" class="form-control @error ('no_telpon') is-invalid @enderror" placeholder="0xxxxxxxxxx" value="{{ auth()->user()->no_telpon ?? old('no_telpon') }}">
                            @error('no_telpon')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 mb-2">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control @error ('email') is-invalid @enderror" placeholder="example@email.com" value="{{ auth()->user()->email ?? old('email') }}">
                            @error('email')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="select form-control @error ('gender') is-invalid @enderror">
                                @php
                                    $selectRole = auth()->user()->gender ?? old('gender');
                                @endphp
                                <option selected disabled>Pilih Gender..</option>
                                <option value="Perempuan" {{ $selectRole == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                <option value="Laki - laki" {{ $selectRole == 'Laki - laki' ? 'selected' : '' }}>Laki - laki</option>
                                <option value="Lainnya" {{ $selectRole == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('gender')
                                <small class="form-text text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                            @if(auth()->user()->gender == null)
                                <p class="form-text mb-0" style="font-size: 12px; color: rgb(255, 0, 17);;">! Lengkapi data gender terlebih dahulu</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 mb-2">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control mb-0 @error('alamat') is-invalid @enderror" placeholder="Masukan alamat users..">{{ auth()->user()->alamat ?? old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @if(auth()->user()->alamat == null)
                                <p class="form-text mb-0" style="font-size: 12px; color: rgb(255, 0, 17);;">! Lengkapi data alamat terlebih dahulu</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-12 text-end">
                        <button type="submit" class="btn btn-primary">Simpan <i class="bi bi-check-circle-fill"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
