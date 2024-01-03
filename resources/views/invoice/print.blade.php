<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/icon.gif') }}" />
<title>App SiRentCar</title>
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #print-section, #print-section * {
            visibility: visible;
        }

        #print-section {
            position: absolute;
            left: 0;
            top: 0;
        }

        .no-print {
            display: none;
        }
    }
</style>

<div class="container mt-3 mb-3">
    <div class="row justify-content-center align-items-center" style="height: height: 100vh;">
        <div class="col-lg-6" id="print-section">
            <div class="card">
                <div class="card-body mx-4">
                    <div class="container">

                        <div class="my-4 mt-5 row flex-row justify-content-between">
                            <div class="col-lg-6">
                                <h2 style="color: rgb(2, 59, 124);"><i class="bi bi-car-front-fill"></i> SiRentCar</h2>
                            </div>
                            <div class="col-lg-6 text-end">
                                <a href="javascript:void(0);" onclick="goBack()" class="btn btn-danger no-print">Kembali</a>
                                <a href="javascript:void(0);" onclick="printInvoice()" class="btn btn-primary no-print">Cetak disini <i class="bi bi-printer"></i></a>
                            </div>
                        </div>

                        <p class="mb-4 text-center" style="font-size: 25px;">
                            Terima kasih atas pembayaran anda
                        </p>
                        <div class="row">
                            <ul class="list-unstyled">
                                <li class="text-black">{{ $inv->nama }}</li>
                                <li class="text-muted mt-1"><span class="text-black">Invoice</span> #INV{{ preg_replace('/[^0-9]/', '', $inv->id_transaction) }}</li>
                                <li class="text-black mt-1">{{ date('l, d F Y', strtotime($inv->payment_date)) }}</li>
                            </ul>
                            <hr>
                            <label style="font-size: 12px;" class="text-secondary">Nama Kendaraan</label>
                            <div class="col-xl-9 col-sm-9">
                                <p>{{ $inv->nama_kendaraan }}</p>
                            </div>
                            <div class="col-xl-3 col-sm-3">
                                <p class="float-end">@currency($inv->biaya_sewa)
                                </p>
                            </div>
                            <hr>
                        </div>
                        <div class="row">
                            @php
                                $start_date = new \DateTime($inv->start_date);
                                $end_date = new \DateTime($inv->end_date);
                                $hari = $start_date->diff($end_date)->days;
                            @endphp
                            <label style="font-size: 12px;" class="text-secondary">Lama Sewa</label>
                            <div class="col-xl-9 col-sm-9">
                                <p>{{ $hari }} Hari</p>
                            </div>
                            <div class="col-xl-3 col-sm-3">
                                <p class="float-end">x {{ $hari }}
                                </p>
                            </div>
                            <hr>
                        </div>
                        <div class="row">
                            <label style="font-size: 12px;" class="text-secondary">PPN</label>
                            <div class="col-xl-9 col-sm-9">
                                <p>Sudah termasuk ppn didalam harga</p>
                            </div>
                            <div class="col-xl-3 col-sm-3">
                                <p class="float-end">11%
                                </p>
                            </div>
                            <hr style="border: 2px solid black;">
                        </div>
                        <div class="row text-black">

                            <div class="col-xl-12">
                                <p class="float-end fw-bold">Total: @currency($inv->payment_amount)
                                </p>
                            </div>
                            <hr style="border: 2px solid black;">
                        </div>
                        <div class="text-left mt-3">
                            <label style="font-size: 12px;" class="text-secondary">Ketentuan</label>
                            <li style="font-size: 12px;">cetak invoice ini dan lampirkan saat serah terima kendaraan. </li>
                            <li style="font-size: 12px;">Sertakan fotocopy ktp dalam pemberian bukti invoice ini. </li>
                            <p class="mt-3 mb-0" style="font-size: 12px;"><b>PT SiRentcar Indonesia</b></p>
                            <p class="mb-0" style="font-size: 12px; color: gray;"><b>Jl. Nangka Growong Jl. H. Linan No.100, Klp. Dua Wetan,<br> Kec. Ciracas, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13730</b></p>
                            <p class="mb-5" style="font-size: 12px; color: gray;"><b>089827351127</b></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printInvoice() {
        window.print();
    }
    function goBack() {
        window.history.back();
    }
</script>
