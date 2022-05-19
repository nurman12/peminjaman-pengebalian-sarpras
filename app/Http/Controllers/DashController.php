<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\Draft;
use App\Models\SarprasDetail;
use App\Models\SarprasKeluar;
use App\Models\SarprasMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashController extends Controller
{
    public function welcome()
    {
        if (Auth::user()) {
            if (Auth::user()->roles != 'Mahasiswa' || Auth::user()->roles != 'Dosen') {
                return redirect('/dashboard');
            } else {
                $sarpras_elek = Sarpras::where('kategori', 'like', '%elektronik%')->get();
                $sarpras_mbel = Sarpras::where('kategori', 'like', '%mebel%')->get();
                $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->get();
                $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->get();

                return view('front.dashboard', compact('sarpras_elek', 'sarpras_mbel', 'sarpras_klas', 'sarpras_lain'));
            }
        } else {
            $sarpras_elek = Sarpras::where('kategori', 'like', '%elektronik%')->get();
            $sarpras_mbel = Sarpras::where('kategori', 'like', '%mebel%')->get();
            $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->get();
            $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->get();

            return view('front.dashboard', compact('sarpras_elek', 'sarpras_mbel', 'sarpras_klas', 'sarpras_lain'));
        }
    }
    public function index()
    {
        if (Auth::user()) {
            if (Auth::user()->roles == 'BMN') {

                // $sarpras = DB::table('sarpras_detail')
                //     ->join('sarpras_masuk', 'sarpras_masuk.id', '=', 'sarpras_detail.sarpras_masuk_id')
                //     ->join('sarpras_keluar', 'sarpras_keluar.id', '=', 'sarpras_detail.sarpras_keluar_id')
                //     ->select([
                //         DB::raw('sum(sarpras_masuk.jumlah) as jumlah_masuk'),
                //         DB::raw('sum(sarpras_keluar.jumlah) as jumlah_keluar'),
                //         DB::raw('MONTH(sarpras_detail.updated_at) as bulan'),
                //         DB::raw('YEAR(sarpras_detail.updated_at) as tahun')
                //     ])->groupBy(['bulan', 'tahun'])->get()->toArray();

                $pinjam = DB::table('pengembalian')
                    ->select([
                        DB::raw('count(id) as jumlah'),
                        DB::raw('MONTH(date_ambil) as bulan'),
                        DB::raw('YEAR(date_ambil) as tahun')
                    ])->groupBy(['bulan', 'tahun'])->get()->toArray();

                $peminjaman = DB::table('validasi')
                    ->where('validasi.status', '=', 1)
                    ->join('draft', 'draft.validasi_id', '=', 'validasi.id')
                    ->join('sarpras_keluar', 'sarpras_keluar.draft_id', '=', 'draft.id')
                    ->select([
                        DB::raw('sum(sarpras_keluar.jumlah) as jumlah'),
                        DB::raw('MONTH(sarpras_keluar.tanggal_keluar) as bulan'),
                        DB::raw('YEAR(sarpras_keluar.tanggal_keluar) as tahun')
                    ])->groupBy(['bulan', 'tahun'])->get()->toArray();

                $pengembalian = DB::table('validasi')
                    ->join('draft', 'draft.validasi_id', '=', 'validasi.id')
                    ->join('sarpras_masuk', 'sarpras_masuk.draft_id', '=', 'draft.id')
                    ->select([
                        DB::raw('sum(sarpras_masuk.jumlah) as jumlah'),
                        DB::raw('MONTH(sarpras_masuk.tanggal_masuk) as bulan'),
                        DB::raw('YEAR(sarpras_masuk.tanggal_masuk) as tahun')
                    ])->groupBy(['bulan', 'tahun'])->get()->toArray();
                // $sarpras = SarprasKeluar::pluck('jumlah')->sum();

                // dd($sarpras);


                return view('back.dashbmn', compact('pengembalian', 'peminjaman', 'pinjam'));
            } elseif (Auth::user()->roles == 'KTU') {
                return view('back.dashktu');
            } elseif (Auth::user()->roles == 'Koordinator') {
                return view('back.dashkoor');
            } elseif (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {

                $sarpras_elek = Sarpras::where('kategori', 'like', '%elektronik%')->get();
                $sarpras_mbel = Sarpras::where('kategori', 'like', '%mebel%')->get();
                $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->get();
                $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->get();

                return view('front.dashboard', compact('sarpras_elek', 'sarpras_mbel', 'sarpras_klas', 'sarpras_lain'));
            }
        } else {

            $sarpras_elek = Sarpras::where('kategori', 'like', '%elektronik%')->get();
            $sarpras_mbel = Sarpras::where('kategori', 'like', '%mebel%')->get();
            $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->get();
            $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->get();

            return view('front.dashboard', compact('sarpras_elek', 'sarpras_mbel', 'sarpras_klas', 'sarpras_lain'));
        }
    }
    public function barang()
    {
        $title = 'Daftar Barang';
        $sarpras = Sarpras::where('jenis', 'Barang')->get();

        return view('front.sarpras', compact('title', 'sarpras'));
    }
    public function ruangan()
    {
        $title = 'Daftar Ruangan';
        $sarpras = Sarpras::where('jenis', 'Ruangan')->get();

        return view('front.sarpras', compact('title', 'sarpras'));
    }
    public function sarpras_detail($id)
    {
        $sarpras = Sarpras::where('id', $id)->first();

        return view('front.show', compact('sarpras'));
    }
    public function about()
    {
        return view('front.about');
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function faqs()
    {
        return view('front.faqs');
    }
}
