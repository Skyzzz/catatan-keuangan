<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{

    public function dashboard()
    {
        $totalPemasukan = Transaksi::where('jenis_transaksi', 'Pemasukan')->sum('jumlah');
        $totalPengeluaran = Transaksi::where('jenis_transaksi', 'Pengeluaran')->sum('jumlah');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;
        $jumlahTransaksi = Transaksi::count();

        return view('dashboard', compact('totalPemasukan', 'totalPengeluaran', 'saldoAkhir', 'jumlahTransaksi'));
    }

    public function index()
    {
        $transaksi = Transaksi::with('kategori')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('transaksi.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jenis_transaksi' => 'required',
            'kategori_id' => 'required',
            'jumlah_raw' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        $jumlah = $request->input('jumlah_raw');

        Transaksi::create([
            'tanggal' => $request->input('tanggal'),
            'jenis_transaksi' => $request->input('jenis_transaksi'),
            'kategori_id' => $request->input('kategori_id'),
            'jumlah' => $jumlah,
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return redirect()->route('transaksi.index');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $kategori = Kategori::all();
        return view('transaksi.edit', compact('transaksi', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'kategori_id' => 'required|exists:kategori,id',
            'jumlah' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $jumlah = str_replace(['Rp', '.', ','], '', $request->jumlah);
        $jumlah = (int)$jumlah;

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'tanggal' => $request->tanggal,
            'jenis_transaksi' => $request->jenis_transaksi,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $jumlah,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }

    public function getKategoriByType($tipe)
    {
        if (!request()->ajax()) {
            abort(403, 'Akses tidak diizinkan');
        }

        $kategori = Kategori::where('tipe', $tipe)->get();
        return response()->json($kategori);
    }


}
