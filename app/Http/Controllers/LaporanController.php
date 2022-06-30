<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\Validasi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function kadaluarsa()
    {
        $date_now = date("Y-m-d");

        $pinjam = Pengembalian::pluck('validasi_id');

        $expired = Validasi::whereNotIn('id', $pinjam)
            ->where('status', 3)
            ->orderBy('tanggal_finish', 'asc')->get();

        return view('back.laporan.kadaluarsa', compact('expired'));
    }
    public function ketersediaan()
    {
        $ketersediaan = Sarpras::whereNotIn('jumlah', [0])
            ->orderBy('jumlah', 'asc')
            ->get();

        return view('back.laporan.ketersediaan', compact('ketersediaan'));
    }
    public function kerusakan()
    {
        $rusak = SarprasDetail::whereNotIn('hilang', [0])
            ->where('jenis', 'keluar')
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('back.laporan.kerusakan', compact('rusak'));
    }
    public function peminjaman()
    {
        $peminjaman = Pengembalian::orderBy('date_ambil', 'asc')->get();

        return view('back.laporan.peminjaman', compact('peminjaman'));
    }
}
