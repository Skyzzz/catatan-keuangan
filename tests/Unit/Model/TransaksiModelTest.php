<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransaksiModelTest extends TestCase
{
    use RefreshDatabase;

    // Test Relasi antara Transaksi dan Kategori
    public function test_transaksi_belongs_to_kategori()
    {
        $kategori = Kategori::factory()->create();
        $transaksi = Transaksi::factory()->create(['kategori_id' => $kategori->id]);

        $this->assertEquals($kategori->id, $transaksi->kategori->id);
    }

    // Test Menyimpan Transaksi
    public function test_saving_transaksi()
    {
        $kategori = Kategori::factory()->create();

        $transaksi = Transaksi::create([
            'tanggal' => '2025-05-14',
            'jenis_transaksi' => 'Pemasukan',
            'kategori_id' => $kategori->id,
            'jumlah' => 500000,
            'deskripsi' => 'Gaji bulanan',
        ]);

        $this->assertDatabaseHas('transaksi', [
            'jenis_transaksi' => 'Pemasukan',
            'jumlah' => 500000,
            'deskripsi' => 'Gaji bulanan',
        ]);
    }
}
