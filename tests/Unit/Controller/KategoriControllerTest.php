<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Kategori;

class KategoriControllerTest extends TestCase
{
    // Test validasi dengan data yang tidak lengkap
    public function test_validation_fails_with_empty_nama_kategori()
    {
        $data = [
            'nama_kategori' => '',
            'tipe' => 'Pemasukan',
        ];

        $validator = Kategori::validate($data);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('nama_kategori'));
    }

    public function test_validation_fails_with_invalid_tipe()
    {
        $data = [
            'nama_kategori' => 'Gaji',
            'tipe' => 'InvalidType',
        ];

        $validator = Kategori::validate($data);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('tipe'));
    }

    public function test_validation_passes_with_valid_data()
    {
        $data = [
            'nama_kategori' => 'Gaji',
            'tipe' => 'Pemasukan',
        ];

        $validator = Kategori::validate($data);

        $this->assertFalse($validator->fails());
    }

    // Test menyimpan data kategori dengan data valid
    public function test_create_kategori()
    {
        $kategori = new Kategori([
            'nama_kategori' => 'Gaji',
            'tipe' => 'Pemasukan',
        ]);

        $this->assertTrue($kategori->save());
    }

    // Test update kategori
    public function test_update_kategori()
    {
        $kategori = Kategori::factory()->create();

        $kategori->nama_kategori = 'Bonus';
        $kategori->tipe = 'Pengeluaran';

        $this->assertTrue($kategori->save());
        $this->assertEquals('Bonus', $kategori->nama_kategori);
        $this->assertEquals('Pengeluaran', $kategori->tipe);
    }

    // Test hapus kategori
    public function test_delete_kategori()
    {
        $kategori = Kategori::factory()->create();
        $id = $kategori->id;
        $kategori->delete();

        $this->assertNull(Kategori::find($id));
    }
}
