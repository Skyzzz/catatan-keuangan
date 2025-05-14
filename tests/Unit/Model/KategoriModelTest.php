<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KategoriModelTest extends TestCase
{
    use RefreshDatabase;

    // Test Relasi antara Kategori dan Transaksi
    public function test_kategori_has_many_transaksi()
    {
        $kategori = Kategori::factory()->create();
        Transaksi::factory()->create(['kategori_id' => $kategori->id]);
        Transaksi::factory()->create(['kategori_id' => $kategori->id]);

        $this->assertCount(2, $kategori->transaksi);
    }

    // Test Menyimpan Kategori
    public function test_saving_kategori()
    {
        $kategori = Kategori::create([
            'nama_kategori' => 'Gaji',
            'tipe' => 'Pemasukan',
        ]);

        $this->assertDatabaseHas('kategori', [
            'nama_kategori' => 'Gaji',
            'tipe' => 'Pemasukan',
        ]);
    }
}
