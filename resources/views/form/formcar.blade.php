@extends('layouts.app')
@section('content')
@php
    $thumbnail = asset('drive/cars/' . ($car->img_kendaraan ?? 'cars.png'));
@endphp
<link rel="stylesheet" href="{{ asset('assets/css/upload.css') }}">
<div class="container-fluid">
    <form action="{{ route('posts.car') }}" method="POST" class="row" enctype="multipart/form-data">
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

                        <input type="hidden" name="id_car" value="{{ $car->id_car ?? '' }}">
                        <input type="hidden" name="aksi" value="{{ $aksi }}">

                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Thumbnail kendaraan</label>
                                <div class="upload-container">
                                    <div class="thumbnail-container">
                                        <img src="{{ $thumbnail }}" alt="Profile Image" id="previewImage">
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
                                <label>Nama Kendaraan</label>
                                <input type="text" name="nama_kendaraan" class="form-control @error ('nama_kendaraan') is-invalid @enderror" placeholder="Masukan nama kendaraan..." value="{{ $car->nama_kendaraan ?? old('nama_kendaraan') }}">
                                @error('nama_kendaraan')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Kategori Kendaraan</label>
                                <select name="id_category" class="select form-control @error ('id_category') is-invalid @enderror">
                                    @php
                                        $selectKategori = $car['id_category'] ?? old('id_category');
                                    @endphp
                                    <option selected disabled>Pilih kategori kendaraan..</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id_category }}" {{ $selectKategori == $item->id_category ? 'selected' : '' }}>{{ $item->category }}</option>
                                    @endforeach
                                </select>
                                @error('id_category')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-8 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Biaya sewa (1 hari)</label>
                                <input type="number" name="biaya_sewa" min="0" class="form-control @error ('biaya_sewa') is-invalid @enderror" placeholder="Rp." value="{{ $car->biaya_sewa ?? old('biaya_sewa') }}">
                                @error('biaya_sewa')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Unit Tersedia</label>
                                <input type="number" name="unit" min="0" class="form-control @error ('unit') is-invalid @enderror" placeholder="0" value="{{ $car->unit ?? old('unit') }}">
                                @error('unit')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label>Keterangan kendaraan</label>
                                <textarea name="description" class="form-control @error ('description') is-invalid @enderror" placeholder="Keterangan kendaraan...">{{ $car->description ?? old('description') }}</textarea>
                                @error('description')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 mb-4">
                            <label>Detail gambar kendaraan</label>
                            <div class="upload__box" id="drag-and-drop-box">
                                <div class="upload__btn-box">
                                    <label class="upload__btn" for="file-input">
                                        <p>Letakan gambar disini</p>
                                        <p id="file-label">Upload file</p>
                                        <input type="file" id="file-input" multiple="" data-max_length="20" class="upload__inputfile form-control" name="image[]">
                                    </label>
                                </div>
                                <div class="upload__img-wrap" id="upload-img-wrap"></div>
                                <div id="file-info"></div>
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
<script src="{{ asset('assets/js/upload.js') }}"></script>
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
                imagePreview.src = "{{ $thumbnail }}";
            }
        });
    });

</script>
@endsection
