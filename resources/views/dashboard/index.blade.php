@extends('layouts.adm-main')

@section('content')
<!-- Konten Utama -->
<div id="content">

    <!-- Mulai Konten Halaman -->
    <div class="container-fluid">

        <!-- Baris Konten -->
        <div class="row">

            <!-- Kartu Barang Masuk -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Barang Masuk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="barangMasuk">{{ $barangMasukTotal }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Barang Keluar -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Barang Keluar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="barangKeluar">{{ $barangKeluarTotal }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Konten Halaman -->
</div>
<!-- Akhir Konten Utama -->

@endsection