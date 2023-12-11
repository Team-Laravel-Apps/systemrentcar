@extends('layouts.app')
@section('content')
@php
    $iconKategori = asset('drive/kategori/' . ($kategori->icon ?? 'kategori.png'));
@endphp
<div class="container-fluid">
    <form action="{{ route('posts.kategori') }}" method="POST" class="row" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12 mb-3">
            <h1 class="h3 text-capitalize">{{$aksi}} <i class="bi bi-tags-fill"></i></h1>
        </div>

        <div class="col-12 col-lg-6 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <div class="row mb-4 g-1">
                        <div class="col-lg-12">
                            <ul class="text-info">
                                <li style="font-size: 12px;">Isi seluruh format input yang telah tersedia</li>
                            </ul>
                        </div>

                        <input type="hidden" name="id_category" value="{{ $kategori->id_category ?? '' }}">
                        <input type="hidden" name="aksi" value="{{ $aksi }}">

                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Icon Kategori</label>
                                <div class="upload-container">
                                    <div class="icon-kategori-container">
                                        <img src="{{ $iconKategori }}" alt="Profile Image" id="previewImage">
                                        <div class="overlay">
                                            <label for="upload-input" class="upload-button">
                                                <i class="bi bi-camera mr-1"></i> Upload
                                            </label>
                                            <input type="file" id="upload-input" name="icon" accept="image/*" class="@error ('icon') is-invalid @enderror">
                                        </div>
                                    </div>
                                </div>
                                @error('icon')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" name="category" class="form-control @error ('category') is-invalid @enderror" placeholder="Masukan nama kategori..." value="{{ $kategori->category ?? old('category') }}">
                                @error('category')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <a href="{{ route('kategori') }}" class="btn btn-danger">Kembali <i class="bi bi-x-circle-fill"></i></a>
                            <button type="submit" class="btn btn-info">Simpan <i class="bi bi-check-circle-fill"></i></button>
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
                imagePreview.src = "{{ $iconKategori }}";
            }
        });
    });

</script>

@endsection
