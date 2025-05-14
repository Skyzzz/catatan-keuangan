@extends('layouts.app')

@section('content')
<script>
document.addEventListener("DOMContentLoaded", function () {
    let jumlahInput = document.getElementById("jumlah");

    jumlahInput.addEventListener("input", function (e) {
        let value = e.target.value.replace(/\D/g, "");
        let formattedValue = new Intl.NumberFormat("id-ID").format(value);
        e.target.value = value ? "Rp" + formattedValue : "";
        document.getElementById("jumlah_raw").value = value;
    });
});
</script>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="card-title mb-4">Edit Transaksi</h2>

            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $transaksi->tanggal }}" required>
                </div>

                <div class="mb-3">
                    <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                    <select class="form-select" id="jenis_transaksi" name="jenis_transaksi" required>
                        <option value="Pemasukan" {{ $transaksi->jenis_transaksi == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="Pengeluaran" {{ $transaksi->jenis_transaksi == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori_id" name="kategori_id" required>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ $kat->id == $transaksi->kategori_id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="{{ number_format($transaksi->jumlah, 0, ',', '.') }}" required>
                    <input type="hidden" name="jumlah_raw" id="jumlah_raw" value="{{ $transaksi->jumlah }}">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $transaksi->deskripsi }}</textarea>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
