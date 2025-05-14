<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'tanggal', 
        'jenis_transaksi', 
        'kategori_id', 
        'jumlah', 
        'deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public static function validate($data)
    {
        return Validator::make($data, [
            'tanggal' => 'required|date',
            'jenis_transaksi' => 'required|string|in:Pemasukan,Pengeluaran',
            'kategori_id' => 'required|exists:kategori,id',
            'jumlah' => 'required|numeric',
            'deskripsi' => 'required|string|max:255',
        ]);
    }
}

