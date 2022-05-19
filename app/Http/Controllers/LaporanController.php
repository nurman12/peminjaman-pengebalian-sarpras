<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\SarprasKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function ketersediaan()
    {
        if (!Auth::user()) {
            return view('/');
        } elseif (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {
            return view('/');
        }
        $ketersediaan = Sarpras::whereNotIn('jumlah', [0])->get();

        return view('back.laporan.ketersediaan', compact('ketersediaan'));
    }
    public function kerusakan()
    {
        if (!Auth::user()) {
            return view('/');
        } elseif (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {
            return view('/');
        }

        $rusak = SarprasKeluar::whereNotIn('hilang', [0])->get();

        return view('back.laporan.kerusakan', compact('rusak'));
    }
}
