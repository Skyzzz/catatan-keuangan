<?php

namespace Database\Factories;

use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiFactory extends Factory
{
    protected $model = Transaksi::class;

    public function definition()
    {
        return [
            'tanggal' => $this->faker->date(),
            'jenis_transaksi' => $this->faker->randomElement(['Pemasukan', 'Pengeluaran']),
            'kategori_id' => Kategori::factory(),
            'jumlah' => $this->faker->numberBetween(10000, 1000000),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}
