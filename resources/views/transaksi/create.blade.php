@extends('layouts.app')

@section('content')
<script>
document.addEventListener("DOMContentLoaded", function () {
    let hargaInput = document.getElementById("jumlah");

    hargaInput.addEventListener("input", function (e) {
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
            <h2 class="card-title mb-4">Tambah Transaksi</h2>
            
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>

                <div class="mb-3">
                    <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                    <select class="form-select" id="jenis_transaksi" name="jenis_transaksi" required>
                        <option value="" disabled selected>Pilih Jenis Transaksi</option>
                        <option value="Pemasukan">Pemasukan</option>
                        <option value="Pengeluaran">Pengeluaran</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori_id" name="kategori_id" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" required>
                    <input type="hidden" name="jumlah_raw" id="jumlah_raw">
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function loadKategori(tipe) {
            $.ajax({
                url: '/kategori/json/' + tipe,
                type: 'GET',
                beforeSend: function() {
                    $('#kategori_id').prop('disabled', true);
                },
                success: function(data) {
                    $('#kategori_id').empty();
                    $('#kategori_id').append('<option value="">Pilih Kategori</option>');
                    $.each(data, function(index, kategori) {
                        $('#kategori_id').append('<option value="' + kategori.id + '">' + kategori.nama_kategori + '</option>');
                    });
                    $('#kategori_id').prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        $('#jenis_transaksi').on('change', function() {
            var tipe = $(this).val();
            loadKategori(tipe);
        });

        loadKategori($('#jenis_transaksi').val());

        $('#jumlah').trigger('input');
    });
</script>

<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    
    .card-title {
        color: #2c3e50;
        font-weight: 600;
    }
    
    .form-control:focus {
        border-color: #2c3e50;
        box-shadow: 0 0 0 0.2rem rgba(44, 62, 80, 0.25);
    }
    
    .btn-primary {
        background-color: #2c3e50;
        border-color: #2c3e50;
    }
    
    .btn-primary:hover {
        background-color: #3a506b;
        border-color: #3a506b;
    }
    
    .btn-secondary {
        background-color: #f8f9fa;
        border-color: #f8f9fa;
    }
    
    .btn-secondary:hover {
        background-color: #e9ecef;
        border-color: #e9ecef;
    }
</style>
@endsection