<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Catatan Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        .sidebar {
            background: linear-gradient(45deg, #2c3e50, #3a506b);
            height: 100vh;
            padding: 20px;
            color: white;
        }

        .sidebar .nav-link {
            color: white;
            transition: background 0.3s;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .main-content {
            padding: 20px;
        }

        .table {
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .table thead tr {
            background: #007bff;
            color: white;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .btn-edit {
            background: #ffc107;
            color: black;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="mb-4">
                    <h3 class="text-center mb-4">Aplikasi Keuangan</h3>
                    <div class="text-center">
                        <i class="bi bi-person-circle fs-3"></i>
                        <p class="mb-0">Pengguna</p>
                    </div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link text-white" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a class="nav-link text-white {{ Request::segment(1) === 'transaksi' ? 'active' : '' }}" href="{{ route('transaksi.index') }}">
                        <i class="bi bi-file-earmark-spreadsheet me-2"></i> Transaksi
                    </a>
                    <a class="nav-link text-white" href="{{ route('kategori.index') }}">
                        <i class="bi bi-list-ul me-2"></i> Kategori
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
