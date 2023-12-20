@extends('layouts.homepage')
@section('homepage')
<div class="container mt-3">
    <div class="row justify-content-center align-items-center" style="height: height: 100vh;">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block " style="background-image: url('assets/img/bg-login.jpg'); background-size: cover; background-position: left;"></div>
                    <div class="col-lg-6">
                        <div class="p-5 mb-5">

                            <div class="text-center mb-3 mt-5">
                                <h5 class="h3 text-gray-900 mb-2 mt-2">Login SiRentCar</h5>
                                <p>Selamat datang di system SiRentCar</p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
