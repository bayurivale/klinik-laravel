<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['pelanggan', 'obat'])
            ->where('status_transaksi', 'menunggu_pembayaran')
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();
        return view('page.pegawai.pembayaran.index', compact('transaksi'));
    }

    public function showVerifikasi($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'obat'])->findOrFail($id);
        return view('page.pegawai.pembayaran.show', compact('transaksi'));
    }

    public function updateVerifikasi(Request $request, $id)
    {
        $request->validate([
            'status_transaksi' => 'required|in:selesai,ditolak'
        ]);

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status_transaksi' => $request->status_transaksi,
            'id_pegawai'       => auth()->user()->pegawai->id,  // kalau pegawai login
            'tanggal_verifikasi' => now(),
        ]);

        return redirect()->route('transaksi.menunggu')->with('success', 'Transaksi berhasil diverifikasi.');
    }


}
