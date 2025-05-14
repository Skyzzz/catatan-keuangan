@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title mb-4">Edit Kategori</h2>

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
                </div>

                <div class="mb-3">
                    <label for="tipe" class="form-label">Tipe</label>
                    <select class="form-select" id="tipe" name="tipe" required>
                        <option value="Pemasukan" {{ $kategori->tipe == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="Pengeluaran" {{ $kategori->tipe == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
