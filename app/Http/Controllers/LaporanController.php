<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Sarpras;
use App\Models\SarprasDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function ketersediaan()
    {
        $ketersediaan = Sarpras::whereNotIn('jumlah', [0])->get();

        return view('back.laporan.ketersediaan', compact('ketersediaan'));
    }
    public function kerusakan()
    {
        $rusak = SarprasDetail::whereNotIn('hilang', [0])->where('jenis', 'keluar')->get();

        return view('back.laporan.kerusakan', compact('rusak'));
    }
    public function peminjaman()
    {
        $peminjaman = Pengembalian::all();

        return view('back.laporan.peminjaman', compact('peminjaman'));
    }
}
