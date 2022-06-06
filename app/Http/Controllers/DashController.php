<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Sarpras;
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
                $sarpras_kain = Sarpras::where('kategori', 'like', '%kain%')->get();
                $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->get();
                $sarpras_labo = Sarpras::where('kategori', 'like', '%laboratorium%')->get();
                $sarpras_rpat = Sarpras::where('kategori', 'like', '%rapat%')->get();
                $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->get();

                return view('front.dashboard', compact('sarpras_elek', 'sarpras_mbel', 'sarpras_kain', 'sarpras_klas', 'sarpras_labo', 'sarpras_rpat', 'sarpras_lain'));
            }
        } else {
            $sarpras_elek = Sarpras::where('kategori', 'like', '%elektronik%')->get();
            $sarpras_mbel = Sarpras::where('kategori', 'like', '%mebel%')->get();
            $sarpras_kain = Sarpras::where('kategori', 'like', '%kain%')->get();
            $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->get();
            $sarpras_labo = Sarpras::where('kategori', 'like', '%laboratorium%')->get();
            $sarpras_rpat = Sarpras::where('kategori', 'like', '%rapat%')->get();
            $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->get();

            return view('front.dashboard', compact('sarpras_elek', 'sarpras_mbel', 'sarpras_kain', 'sarpras_klas', 'sarpras_labo', 'sarpras_rpat', 'sarpras_lain'));
        }
    }
    public function index()
    {
        if (Auth::user()) {
            $perbandingan_sarpras = DB::table('sarpras_detail')
                ->where('sarpras_detail.draft_id', '!=', null)
                ->join('draft', 'draft.id', '=', 'sarpras_detail.draft_id')
                ->join('validasi', 'validasi.id', '=', 'draft.validasi_id')
                ->where('validasi.status', 1)
                ->select([
                    DB::raw('sarpras_detail.jenis = "keluar" as keluar'),
                    DB::raw('sarpras_detail.jenis = "masuk" as masuk'),
                    DB::raw('sum(sarpras_detail.jumlah) as jumlah'),
                    DB::raw('MONTH(sarpras_detail.tanggal) as bulan'),
                    DB::raw('YEAR(sarpras_detail.tanggal) as tahun')
                ])
                ->groupBy('sarpras_detail.jenis', 'bulan', 'tahun')
                ->orderBy('bulan')
                ->get();

            $data = [];
            $masuk = "";
            $keluar = "";
            $bulan = "";
            $bulans = "";
            $id_loop = [];

            foreach ($perbandingan_sarpras as $key => $item) {
                if ($item->keluar == 0) {
                    if ($bulans == $item->bulan) {
                        $id_loop[] = $key - 1;
                        if ($masuk == "") {
                            $jumlah_masuk = $item->jumlah;
                        } else {
                            $jumlah_masuk = $item->jumlah + $masuk;
                        }
                    } else {
                        $masuk = $item->jumlah;
                        $bulan = $item->bulan;
                        $jumlah_masuk = $item->jumlah;
                        $jumlah_keluar = 0;
                    }
                }
                if ($item->masuk == 0) {
                    if ($bulan == $item->bulan) {
                        $id_loop[] = $key - 1;
                        if ($keluar == "") {
                            $jumlah_keluar = $item->jumlah;
                        } else {
                            $jumlah_keluar = $item->jumlah + $keluar;
                        }
                    } else {
                        $keluar = $item->jumlah;
                        $bulans = $item->bulan;
                        $jumlah_keluar = $item->jumlah;
                        $jumlah_masuk = 0;
                    }
                }
                $data[] = ["bulan" => $item->bulan, "masuk" => $jumlah_masuk, "keluar" => $jumlah_keluar];
            }

            foreach ($id_loop as $item) {
                unset($data[$item]);
            }

            $perbandingan_sarpras = $data;

            $pinjam = DB::table('pengembalian')
                ->select([
                    DB::raw('count(id) as jumlah_pinjam'),
                    DB::raw('0 as jumlah_kembali'),
                    DB::raw('MONTH(date_ambil) as bulan'),
                    DB::raw('YEAR(date_ambil) as tahun')
                ])->groupBy(['bulan', 'tahun'])
                ->orderBy('bulan')
                ->get()
                ->toArray();

            $pengembalian = DB::table('pengembalian')
                ->where('status', 1)
                ->select([
                    DB::raw('0 as jumlah_pinjam'),
                    DB::raw('count(id) as jumlah_kembali'),
                    DB::raw('MONTH(date_kembali) as bulan'),
                    DB::raw('YEAR(date_kembali) as tahun')
                ])->groupBy(['bulan', 'tahun'])
                ->orderBy('bulan')
                ->get()
                ->toArray();

            $perbandingan_pinjam_kembali = array_merge($pinjam, $pengembalian);

            $data_ = [];
            $pinjams = "";
            $kembalis = "";
            $bulan = "";
            $bulans = "";
            $id_loop = [];
            foreach ($perbandingan_pinjam_kembali as $key => $item) {
                if ($item->jumlah_pinjam == 0) {
                    if ($bulans == $item->bulan) {
                        $id_loop[] = $key - 1;
                        if ($kembalis == "") {
                            $jumlah_kembali = $item->jumlah_kembali;
                        } else {
                            $jumlah_kembali = $item->jumlah_kembali + $kembalis;
                        }
                    } else {
                        $kembalis = $item->jumlah_kembali;
                        $bulan = $item->bulan;
                        $jumlah_kembali = $item->jumlah_kembali;
                        $jumlah_pinjam = 0;
                    }
                }
                if ($item->jumlah_kembali == 0) {
                    if ($bulan == $item->bulan) {
                        $id_loop[] = $key - 1;
                        if ($pinjams == "") {
                            $jumlah_pinjam = $item->jumlah_pinjam;
                        } else {
                            $jumlah_pinjam = $item->jumlah_pinjam + $pinjams;
                        }
                    } else {
                        $pinjams = $item->jumlah_pinjam;
                        $bulans = $item->bulan;
                        $jumlah_pinjam = $item->jumlah_pinjam;
                        $jumlah_kembali = 0;
                    }
                }
                $data_[] = ["bulan" => $item->bulan, "jumlah_pinjam" => $jumlah_pinjam, "jumlah_kembali" => $jumlah_kembali];
            }

            foreach ($id_loop as $item) {
                unset($data_[$item]);
            }

            $perbandingan = $data_;

            if (Auth::user()->roles == 'BMN') {
                return view('back.dashbmn', compact('perbandingan', 'perbandingan_sarpras'));
            } elseif (Auth::user()->roles == 'KTU') {
                return view('back.dashktu', compact('perbandingan'));
            } elseif (Auth::user()->roles == 'Koordinator') {
                return view('back.dashkoor', compact('perbandingan'));
            } elseif (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {

                $sarpras_elek = Sarpras::where('kategori', 'like', '%elektronik%')->get();
                $sarpras_mbel = Sarpras::where('kategori', 'like', '%mebel%')->get();
                $sarpras_kain = Sarpras::where('kategori', 'like', '%kain%')->get();
                $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->get();
                $sarpras_labo = Sarpras::where('kategori', 'like', '%laboratorium%')->get();
                $sarpras_rpat = Sarpras::where('kategori', 'like', '%rapat%')->get();
                $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->get();

                return view('front.dashboard', compact('sarpras_elek', 'sarpras_mbel', 'sarpras_kain', 'sarpras_klas', 'sarpras_labo', 'sarpras_rpat', 'sarpras_lain'));
            }
        } else {

            $sarpras_elek = Sarpras::where('kategori', 'like', '%elektronik%')->get();
            $sarpras_mbel = Sarpras::where('kategori', 'like', '%mebel%')->get();
            $sarpras_kain = Sarpras::where('kategori', 'like', '%kain%')->get();
            $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->get();
            $sarpras_labo = Sarpras::where('kategori', 'like', '%laboratorium%')->get();
            $sarpras_rpat = Sarpras::where('kategori', 'like', '%rapat%')->get();
            $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->get();

            return view('front.dashboard', compact('sarpras_elek', 'sarpras_mbel', 'sarpras_kain', 'sarpras_klas', 'sarpras_labo', 'sarpras_rpat', 'sarpras_lain'));
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
        $sarpras_like = Sarpras::where('jenis', $sarpras->jenis)
            ->whereNotIn('id', [$id])
            ->get();

        return view('front.show', compact('sarpras', 'sarpras_like'));
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
