<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Rusak;
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
            ->orderBy('tanggal_finish', 'desc')->get();

        return view('back.laporan.kadaluarsa', compact('expired'));
    }
    public function ketersediaan()
    {
        $ketersediaan = Sarpras::whereNotIn('jumlah', [0])
            ->orderBy('jumlah', 'desc')
            ->get();

        return view('back.laporan.ketersediaan', compact('ketersediaan'));
    }
    public function kerusakan()
    {
        $rusak = Rusak::orderBy('updated_at', 'desc')->get();

        return view('back.laporan.kerusakan', compact('rusak'));
    }
    public function peminjaman()
    {
        $peminjaman = Pengembalian::orderBy('date_ambil', 'desc')->get();

        return view('back.laporan.peminjaman', compact('peminjaman'));
    }
    public function pengembalian()
    {
        $pengembalian = Pengembalian::where('status', 1)->orderBy('date_kembali', 'desc')->get();

        return view('back.laporan.pengembalian', compact('pengembalian'));
    }
}
