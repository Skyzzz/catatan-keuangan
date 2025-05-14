<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->enum('jenis_transaksi', ['Pemasukan', 'Pengeluaran']);
            $table->unsignedBigInteger('kategori_id'); // Foreign Key
            $table->decimal('jumlah', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // Definisikan foreign key
            $table->foreign('kategori_id')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
