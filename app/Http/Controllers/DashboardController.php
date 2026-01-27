<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Obat;
use App\Models\Transaksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalObat = Obat::count();
        $totalPelanggan = Pelanggan::count();
        $totalTransaksi = Transaksi::count();

        $menungguPembayaran = Transaksi::where('status_transaksi', 'menunggu_pembayaran')->count();
        $menungguVerifikasi = Transaksi::where('status_transaksi', 'menunggu_verifikasi')->count();
        $selesai = Transaksi::where('status_transaksi', 'selesai')->count();
        $ditolak = Transaksi::where('status_transaksi', 'ditolak')->count();

        $recentTransaksi = Transaksi::with(['pelanggan', 'obat', 'pegawai'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();


        // status counts
        $statusCounts = Transaksi::selectRaw('status_transaksi, COUNT(*) as total')
            ->groupBy('status_transaksi')
            ->pluck('total','status_transaksi');
        // chart data per bulan (tahun ini)
        $transaksiPerBulan = Transaksi::selectRaw('MONTH(tanggal_transaksi) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_transaksi', Carbon::now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        return view('dashboard', compact(
            'totalObat', 'totalPelanggan', 'totalTransaksi',
            'menungguPembayaran', 'menungguVerifikasi', 'selesai', 'ditolak',
            'recentTransaksi', 'transaksiPerBulan', 'statusCounts'
        ));
    }
}
