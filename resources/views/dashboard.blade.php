@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Dashboard Keuangan</h2>
    <div class="row">
        <!-- Total Pemasukan -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 bg-gradient-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-1">Total Pemasukan</h6>
                            <h2 class="card-title mb-0">
                                Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                            </h2>
                        </div>
                        <div class="card-icon">
                            <i class="bi bi-arrow-up-circle fs-3"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 mb-0">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 bg-gradient-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-1">Total Pengeluaran</h6>
                            <h2 class="card-title mb-0">
                                Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                            </h2>
                        </div>
                        <div class="card-icon">
                            <i class="bi bi-arrow-down-circle fs-3"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 mb-0">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Saldo Akhir -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 bg-gradient-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-1">Saldo Akhir</h6>
                            <h2 class="card-title mb-0">
                                Rp {{ number_format($saldoAkhir, 0, ',', '.') }}
                            </h2>
                        </div>
                        <div class="card-icon">
                            <i class="bi bi-cash-coin fs-3"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 mb-0">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumlah Transaksi -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card h-100 bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-1">Total Transaksi</h6>
                            <h2 class="card-title mb-0">{{ $jumlahTransaksi }}</h2>
                        </div>
                        <div class="card-icon">
                            <i class="bi bi-list-check fs-3"></i>
                        </div>
                    </div>
                    <div class="progress mt-3 mb-0">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .card-icon {
        font-size: 2rem;
        opacity: 0.8;
    }
    
    .card-subtitle {
        font-size: 0.9rem;
        opacity: 0.8;
    }
    
    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
    }
    .bg-gradient-success {
        background: linear-gradient(45deg, #28a745, #218838);
    }
    
    .bg-gradient-danger {
        background: linear-gradient(45deg, #dc3545, #c82333);
    }
    
    .bg-gradient-info {
        background: linear-gradient(45deg, #17a2b8, #1283a3);
    }
    
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4da3ff, #1a73e8);
    }
    
    .progress {
        height: 4px;
        background-color: rgba(255, 255, 255, 0.2);
    }
    
    .progress-bar {
        background-color: rgba(255, 255, 255, 0.8);
    }
</style>
@endsection
