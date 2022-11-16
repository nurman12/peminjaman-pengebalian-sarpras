<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Rusak;
use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function pengembalian(Request $request)
    {
        $pengembalian = DB::table('pengembalian')
            ->join('validasi', 'validasi.id', '=', 'pengembalian.validasi_id')
            ->where('pengembalian.status', 1)
            ->select([
                DB::raw('pengembalian.user_id as user_id'),
                DB::raw('pengembalian.date_ambil as date_ambil'),
                DB::raw('pengembalian.date_kembali as date_kembali'),
                DB::raw('validasi.keperluan as keperluan'),
                DB::raw('validasi.id as validasi_id'),
                DB::raw('pengembalian.id as id')
            ])->orderBy('date_kembali', 'desc')->get();
        $jenis = '';
        $sarpras = '';
        return view('back.laporan.pengembalian', compact('pengembalian', 'jenis', 'sarpras'));
    }
    public function getSarpras($jenis)
    {
        $data = DB::table('sarpras')
            ->join('draft', 'draft.sarpras_id', '=', 'sarpras.id')
            ->join('validasi', 'validasi.id', '=', 'draft.validasi_id')
            ->join('pengembalian', 'pengembalian.validasi_id', '=', 'validasi.id')
            ->where('sarpras.jenis', $jenis)
            ->where('pengembalian.status', 1)
            ->select([
                DB::raw('sarpras.nama as nama'),
                DB::raw('sarpras.id as id')
            ])
            ->orderBy('sarpras.nama', 'ASC')
            ->pluck('sarpras.nama', 'sarpras.id');

        return response()->json($data);
    }
    public function f_pegembalian(Request $request)
    {
        if ($request->input() == null) {
            return redirect('/l_pengembalian');
        }
        if ($request->jenis && $request->sarpras_id) {
            $data = DB::table('pengembalian')
                ->join('validasi', 'validasi.id', '=', 'pengembalian.validasi_id')
                ->join('draft', 'draft.validasi_id', '=', 'validasi.id')
                ->join('sarpras', 'sarpras.id', '=', 'draft.sarpras_id')
                ->where('pengembalian.status', 1)
                ->where('sarpras.id', '=', $request->sarpras_id)
                ->select([
                    DB::raw('pengembalian.user_id as user_id'),
                    DB::raw('pengembalian.date_ambil as date_ambil'),
                    DB::raw('pengembalian.date_kembali as date_kembali'),
                    DB::raw('validasi.keperluan as keperluan'),
                    DB::raw('validasi.id as validasi_id')
                ])->orderBy('date_kembali', 'desc')->get();
            $pengembalian = [];
            foreach ($data as $item) {
                $pengembalian[$item->validasi_id] = $item;
            }
            $jenis = $request->jenis;
            $sarpras = $request->sarpras_id;
            return view('back.laporan.pengembalian', compact('pengembalian', 'jenis', 'sarpras'));
        }
        if ($request->jenis) {
            $data = DB::table('pengembalian')
                ->join('validasi', 'validasi.id', '=', 'pengembalian.validasi_id')
                ->join('draft', 'draft.validasi_id', '=', 'validasi.id')
                ->join('sarpras', 'sarpras.id', '=', 'draft.sarpras_id')
                ->where('pengembalian.status', 1)
                ->where('sarpras.jenis', '=', $request->jenis)
                ->select(
                    DB::raw('pengembalian.user_id as user_id'),
                    DB::raw('pengembalian.date_ambil as date_ambil'),
                    DB::raw('pengembalian.date_kembali as date_kembali'),
                    DB::raw('validasi.keperluan as keperluan'),
                    DB::raw('validasi.id as validasi_id'),
                )
                ->orderBy('date_kembali', 'desc')
                ->get();
            $pengembalian = [];
            foreach ($data as $item) {
                $pengembalian[$item->validasi_id] = $item;
            }
            $jenis = $request->jenis;
            $sarpras = 0;
            return view('back.laporan.pengembalian', compact('pengembalian', 'jenis', 'sarpras'));
        }
    }
}
