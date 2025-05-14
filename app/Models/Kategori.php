<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori', 
        'tipe'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public static function validate($data)
    {
        return Validator::make($data, [
            'nama_kategori' => 'required|string|max:255',
            'tipe' => 'required|string|in:Pemasukan,Pengeluaran',
        ]);
    }
}

