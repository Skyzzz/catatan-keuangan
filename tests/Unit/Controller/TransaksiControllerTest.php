<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransaksiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_transaksi_with_valid_data()
    {
        $kategori = Kategori::factory()->create();

        $data = [
            'tanggal' => now()->toDateString(),
            'jenis_transaksi' => 'Pemasukan',
            'kategori_id' => $kategori->id,
            'jumlah' => 150000,
            'deskripsi' => 'Gaji Bulanan',
        ];

        $validator = Transaksi::validate($data);
        $this->assertFalse($validator->fails());

        $transaksi = new Transaksi($data);
        $this->assertTrue($transaksi->save());

        $this->assertDatabaseHas('transaksi', [
            'jumlah' => 150000,
            'deskripsi' => 'Gaji Bulanan',
        ]);
    }

    public function test_validation_fails_with_invalid_jumlah()
    {
        $kategori = Kategori::factory()->create();

        $data = [
            'tanggal' => now()->toDateString(),
            'jenis_transaksi' => 'Pemasukan',
            'kategori_id' => $kategori->id,
            'jumlah' => 'invalid',  // Invalid jumlah (harus numeric)
            'deskripsi' => 'Gaji Bulanan',
        ];

        $validator = Transaksi::validate($data);
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('jumlah'));
    }

    public function test_validation_fails_with_empty_deskripsi()
    {
        $kategori = Kategori::factory()->create();

        $data = [
            'tanggal' => now()->toDateString(),
            'jenis_transaksi' => 'Pemasukan',
            'kategori_id' => $kategori->id,
            'jumlah' => 150000,
            'deskripsi' => '', // Deskripsi kosong (required)
        ];

        $validator = Transaksi::validate($data);
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('deskripsi'));
    }

    public function test_update_transaksi()
    {
        $kategori = Kategori::factory()->create();
        $transaksi = Transaksi::factory()->create(['kategori_id' => $kategori->id, 'jumlah' => 100000]);

        $transaksi->jumlah = 200000;
        $this->assertTrue($transaksi->save());

        $this->assertEquals(200000, $transaksi->fresh()->jumlah);
    }

    public function test_delete_transaksi()
    {
        $kategori = Kategori::factory()->create();
        $transaksi = Transaksi::factory()->create(['kategori_id' => $kategori->id]);

        $id = $transaksi->id;
        $transaksi->delete();

        $this->assertNull(Transaksi::find($id));
    }
}
