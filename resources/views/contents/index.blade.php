    <head>
        <title>Dashboard - Komunitas Usaha Bersama</title>
    </head>
    <!-- {% extends "base.html" %} -->
    @extends('layouts.base')
    <!-- {% block content %} -->
    @section('content')
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-xl-12 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Silahkan Melakukan Pembayaran</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#" id="toggleDetails">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
    <div id="detailsInfo" class="card border-left-primary shadow p-3 bg-light d-none" style="transition: all 0.3s ease-in-out;">
        <div class="card-body">
            <h5 class="text-danger"><i class="fas fa-file-invoice-dollar"></i> Detail Pembayaran</h5>
            <hr>
            <div class="d-flex align-items-center justify-content-start gap-2 mt-4 mb-0">
                <div class="mb-0 w-auto"><strong>📌 Nomor Tagihan</strong></div>
                <p class="mb-0 w-fixed text-center"><strong>:</strong></p>
                <p class="mb-0">123456</p>
            </div>
            <div class="d-flex align-items-center justify-content-start gap-2 mt-4 mb-0">
                <p class="mb-0 w-auto"><strong>💰 Jumlah</strong></p>
                <p class="mb-0 w-fixed text-center"><strong>:</strong></p>
                <p class="mb-0">Rp 500.000</p>
            </div>
            <div class="d-flex align-items-center justify-content-start gap-2 mt-4 mb-0">
                <p class="mb-0 w-auto"><strong>⏳ Batas Waktu</strong></p>
                <p class="mb-0 w-fixed text-center"><strong>:</strong></p>
                <p class="mb-0">20 Februari 2025</p>
            </div>
            <!-- <ul class="list-unstyled">
                <li><strong>📌 Nomor Tagihan:</strong> 123456</li>
                <li><strong>💰 Jumlah:</strong> Rp 500.000</li>
                <li><strong>⏳ Batas Waktu:</strong> 20 Februari 2025</li>
            </ul> -->
            <div class="alert alert-warning text-dark mt-3">
                <i class="fas fa-exclamation-triangle"></i> Harap lakukan pembayaran sebelum batas waktu untuk menghindari denda.
            </div>
            <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-credit-card"></i> Bayar Sekarang</a>
        </div>
    </div>
                            </div>
                        </div>
                    </div>
        <script>
            document.getElementById("toggleDetails").addEventListener("click", function(event) {
                event.preventDefault(); // Mencegah link membuka halaman baru
                let details = document.getElementById("detailsInfo");
                details.classList.toggle("d-none"); // Toggle class untuk menampilkan/sembunyikan
            });
        </script>
        @endsection