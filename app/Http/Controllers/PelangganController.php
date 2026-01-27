<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    // =========================
    // LIST OBAT (SUDAH BENAR)
    // =========================
    public function index()
    {
        $obat = Obat::where('stok_obat', '>', 0)
            ->whereDate('tanggal_exp', '>=', Carbon::today())
            ->get();

        return view('page.pelanggan.obat.index', compact('obat'));
    }

    public function beli(Request $request)
    {
        $request->validate([
            'obat_id' => 'required|exists:obat,id',
            'jumlah'  => 'required|integer|min:1'
        ]);

        $pelanggan = Pelanggan::where('id_user', auth()->id())->first();

        if (!$pelanggan) {
            return back()->with('error', 'Data pelanggan tidak ditemukan');
        }

        DB::beginTransaction();

        try {
            // 🔒 AMBIL OBAT + LOCK
            $obat = Obat::where('id', $request->obat_id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($request->jumlah > $obat->stok_obat) {
                throw new \Exception('Jumlah melebihi stok tersedia');
            }

            $totalBayar = $request->jumlah * $obat->harga_obat;

            Transaksi::create([
                'id_pelanggan'      => $pelanggan->id,
                'id_pegawai'        => null, 
                'id_obat'           => $obat->id,
                'jumlah'            => $request->jumlah,
                'total_bayar'       => $totalBayar,
                'status_transaksi'  => 'menunggu_pembayaran',
                'tanggal_transaksi' => now(),
            ]);

            $obat->decrement('stok_obat', $request->jumlah);

            DB::commit();

            return back()->with('success', 'Pesanan berhasil dibuat, silakan lakukan pembayaran');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function pembayaranSaya()
    {
        $pelanggan = Pelanggan::where('id_user', auth()->id())->first();

        if (!$pelanggan) {
            return back()->with('error', 'Data pelanggan tidak ditemukan');
        }

        $transaksi = Transaksi::with('obat')
            ->where('id_pelanggan', $pelanggan->id)
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        return view('page.pelanggan.pembayaran.index', compact('transaksi'));
    }


    public function dashboard()
    {
        $pelanggan = Pelanggan::where('id_user', auth()->id())->first();

        if (!$pelanggan) {
            abort(403, 'Data pelanggan tidak ditemukan');
        }

        $jumlahObat = Obat::where('stok_obat', '>', 0)
            ->whereDate('tanggal_exp', '>=', Carbon::today())
            ->count();

        $totalPembelian = Transaksi::where('id_pelanggan', $pelanggan->id)->count();

        $menungguPembayaran = Transaksi::where('id_pelanggan', $pelanggan->id)
            ->where('status_transaksi', 'menunggu_pembayaran')
            ->count();

        $totalBelanja = Transaksi::where('id_pelanggan', $pelanggan->id)
            ->where('status_transaksi', '!=', 'dibatalkan')
            ->sum('total_bayar');

        return view('page.pelanggan.dashboard.dashboard', compact(
            'pelanggan',
            'jumlahObat',
            'totalPembelian',
            'menungguPembayaran',
            'totalBelanja'
        ));
    }


}
