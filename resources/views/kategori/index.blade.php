@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="mb-4">
        <h2 class="mb-3">Daftar Kategori</h2>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i> Tambah Kategori
            </a>
        </div>
        
        @if(session('success'))
            <div class="alert success-message alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>{{ $item->tipe }}</td>
                        <td>
                            <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-edit btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('kategori.delete', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-delete btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-muted">
        <p class="text-center">
            <small>© 2025 Aplikasi Catatan Keuangan. All rights reserved.</small>
        </p>
    </div>
</div>
@endsection
