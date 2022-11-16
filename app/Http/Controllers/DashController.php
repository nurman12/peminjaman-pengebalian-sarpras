<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Rusak;
use App\Models\Sarpras;
use App\Models\User;
use App\Models\Validasi;
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
                $sarpras_alls = Sarpras::whereNotIn('jumlah', [0])->get();
                $sarpras_elek = Sarpras::where('kategori', 'like', '%elektronik%')->whereNotIn('jumlah', [0])->get();
                $sarpras_mbel = Sarpras::where('kategori', 'like', '%mebel%')->whereNotIn('jumlah', [0])->get();
                $sarpras_kain = Sarpras::where('kategori', 'like', '%kain%')->whereNotIn('jumlah', [0])->get();
                $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->whereNotIn('jumlah', [0])->get();
                $sarpras_labo = Sarpras::where('kategori', 'like', '%laboratorium%')->whereNotIn('jumlah', [0])->get();
                $sarpras_rpat = Sarpras::where('kategori', 'like', '%rapat%')->whereNotIn('jumlah', [0])->get();
                $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->whereNotIn('jumlah', [0])->get();
                $tanggungan = Pengembalian::where('user_id', Auth::user()->id)->whereNotIn('status', [1])->get();

                return view('front.dashboard', compact('sarpras_alls', 'sarpras_elek', 'sarpras_mbel', 'sarpras_kain', 'sarpras_klas', 'sarpras_labo', 'sarpras_rpat', 'sarpras_lain', 'tanggungan'));
            }
        } else {
            $sarpras_alls = Sarpras::whereNotIn('jumlah', [0])->get();
            $sarpras_elek = Sarpras::where('kategori', 'like', '%elektronik%')->whereNotIn('jumlah', [0])->get();
            $sarpras_mbel = Sarpras::where('kategori', 'like', '%mebel%')->whereNotIn('jumlah', [0])->get();
            $sarpras_kain = Sarpras::where('kategori', 'like', '%kain%')->whereNotIn('jumlah', [0])->get();
            $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->whereNotIn('jumlah', [0])->get();
            $sarpras_labo = Sarpras::where('kategori', 'like', '%laboratorium%')->whereNotIn('jumlah', [0])->get();
            $sarpras_rpat = Sarpras::where('kategori', 'like', '%rapat%')->whereNotIn('jumlah', [0])->get();
            $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->whereNotIn('jumlah', [0])->get();

            return view('front.dashboard', compact('sarpras_alls', 'sarpras_elek', 'sarpras_mbel', 'sarpras_kain', 'sarpras_klas', 'sarpras_labo', 'sarpras_rpat', 'sarpras_lain'));
        }
    }
    public function index()
    {
        if (Auth::user()) {
            $perbandingan_pinjam = DB::table('sarpras_detail')
                ->join('draft', 'draft.id', '=', 'sarpras_detail.draft_id')
                ->join('validasi', 'validasi.id', '=', 'draft.validasi_id')
                ->join('pengembalian', 'pengembalian.validasi_id', '=', 'validasi.id')
                ->where('sarpras_detail.draft_id', '!=', null)
                ->where('sarpras_detail.jenis', 'keluar')
                ->select([
                    DB::raw('sum(sarpras_detail.jumlah) as jumlah'),
                    DB::raw('MONTH(sarpras_detail.tanggal) as bulan'),
                    DB::raw('YEAR(sarpras_detail.tanggal) as tahun')
                ])
                ->groupBy('bulan', 'tahun')
                ->orderBy('bulan')
                ->get()->toArray();

            $perbandingan_kembali = DB::table('sarpras_detail')
                ->join('draft', 'draft.id', '=', 'sarpras_detail.draft_id')
                ->join('validasi', 'validasi.id', '=', 'draft.validasi_id')
                ->join('pengembalian', 'pengembalian.validasi_id', '=', 'validasi.id')
                ->where('pengembalian.status', 1)
                ->where('sarpras_detail.draft_id', '!=', null)
                ->where('sarpras_detail.jenis', 'masuk')
                ->select([
                    DB::raw('sum(sarpras_detail.jumlah) as jumlah'),
                    DB::raw('MONTH(sarpras_detail.tanggal) as bulan'),
                    DB::raw('YEAR(sarpras_detail.tanggal) as tahun')
                ])
                ->groupBy('bulan', 'tahun')
                ->orderBy('bulan')
                ->get()->toArray();

            $perbandingan_ = array_merge($perbandingan_pinjam, $perbandingan_kembali);
            $bulans__ = [];
            foreach ($perbandingan_ as $value) {
                $bulans__[] = $value->bulan;
            }

            $bulan_ = array_unique($bulans__);
            $bulan_awal = min($bulan_);
            $bulan_akhir = max($bulan_);
            // dd($bulan_awal, $bulan_akhir);
            $bulan_a = [];
            for ($i = $bulan_awal; $i <= $bulan_akhir; $i++) {
                $bulan_a[] = $i;
            }
            // dd($bulan_a);
            $perbandingan_sarpras = [];
            foreach ($bulan_a as $key => $bln) {
                $pinjam = DB::table('sarpras_detail')
                    ->join('draft', 'draft.id', '=', 'sarpras_detail.draft_id')
                    ->join('validasi', 'validasi.id', '=', 'draft.validasi_id')
                    ->join('pengembalian', 'pengembalian.validasi_id', '=', 'validasi.id')
                    ->where('sarpras_detail.draft_id', '!=', null)
                    ->whereMonth('sarpras_detail.tanggal', $bln)
                    ->where('sarpras_detail.jenis', 'keluar')
                    ->select([
                        DB::raw('sum(sarpras_detail.jumlah) as jumlah'),
                        DB::raw('MONTH(sarpras_detail.tanggal) as bulan'),
                        DB::raw('YEAR(sarpras_detail.tanggal) as tahun')
                    ])
                    ->groupBy('bulan', 'tahun')->first();

                $kembali = DB::table('sarpras_detail')
                    ->join('draft', 'draft.id', '=', 'sarpras_detail.draft_id')
                    ->join('validasi', 'validasi.id', '=', 'draft.validasi_id')
                    ->join('pengembalian', 'pengembalian.validasi_id', '=', 'validasi.id')
                    ->where('pengembalian.status', 1)
                    ->where('sarpras_detail.draft_id', '!=', null)
                    ->whereMonth('sarpras_detail.tanggal', $bln)
                    ->where('sarpras_detail.jenis', 'masuk')
                    ->select([
                        DB::raw('sum(sarpras_detail.jumlah) as jumlah'),
                        DB::raw('MONTH(sarpras_detail.tanggal) as bulan'),
                        DB::raw('YEAR(sarpras_detail.tanggal) as tahun')
                    ])
                    ->groupBy('bulan', 'tahun')->first();

                if (!$pinjam && !$kembali) {
                    $perbandingan_sarpras[$key] = ['bulan' => $bln, 'keluar' => 0, 'masuk' => 0];
                } elseif (!$pinjam || !$kembali) {
                    if (!$pinjam && $kembali) {
                        $perbandingan_sarpras[$key] = ['bulan' => $bln, 'keluar' => 0, 'masuk' => $kembali->jumlah];
                    }
                    if ($pinjam && !$kembali) {
                        $perbandingan_sarpras[$key] = ['bulan' => $bln, 'keluar' => $pinjam->jumlah, 'masuk' => 0];
                    }
                } else {
                    $perbandingan_sarpras[$key] = ['bulan' => $bln, 'keluar' => $pinjam->jumlah, 'masuk' => $kembali->jumlah];
                }
            }
            // dd($perbandingan_sarpras);
            // $perbandingan_sarpras = [];
            // foreach ($bulan_ as $key => $bln) {
            //     $d_pinjam = array_search($bln, array_column($perbandingan_pinjam, "bulan"));
            //     $d_kembali = array_search($bln, array_column($perbandingan_kembali, "bulan"));
            //     $perbandingan_sarpras[] = ['keluar' => $perbandingan_pinjam[$d_pinjam]->jumlah, 'masuk' => $perbandingan_kembali[$d_kembali]->jumlah, 'bulan' => $bln];
            // }

            $pinjam = DB::table('pengembalian')
                ->select([
                    DB::raw('count(id) as jumlah'),
                    DB::raw('MONTH(date_ambil) as bulan'),
                    DB::raw('YEAR(date_ambil) as tahun')
                ])->groupBy(['bulan', 'tahun'])
                ->orderBy('bulan')
                ->get()
                ->toArray();

            $kembali = DB::table('pengembalian')
                ->where('status', 1)
                ->select([
                    DB::raw('count(id) as jumlah'),
                    DB::raw('MONTH(date_kembali) as bulan'),
                    DB::raw('YEAR(date_kembali) as tahun')
                ])->groupBy(['bulan', 'tahun'])
                ->orderBy('bulan')
                ->get()
                ->toArray();

            $perbandingan_pinjam_kembali = array_merge($pinjam, $kembali);

            $bulans__ = [];
            foreach ($perbandingan_pinjam_kembali as $value) {
                $bulans__[] = $value->bulan;
            }

            $bulan_ = array_unique($bulans__);
            $bulan_awal = min($bulan_);
            $bulan_akhir = max($bulan_);
            // dd($bulan_awal, $bulan_akhir);
            $bulan_a = [];
            for ($i = $bulan_awal; $i <= $bulan_akhir; $i++) {
                $bulan_a[] = $i;
            }

            $perbandingan = [];
            foreach ($bulan_a as $key => $bln) {

                $d_pinjam = DB::table('pengembalian')
                    ->whereMonth('date_ambil', '=', $bln)
                    ->select([
                        DB::raw('count(id) as jumlah'),
                        DB::raw('MONTH(date_ambil) as bulan'),
                        DB::raw('YEAR(date_ambil) as tahun')
                    ])->groupBy(['bulan', 'tahun'])
                    ->first();
                if ($d_pinjam) {
                    $p_jumlah = $d_pinjam->jumlah;
                } else {
                    $p_jumlah = 0;
                }

                $d_kembali = DB::table('pengembalian')
                    ->whereMonth('date_kembali', '=', $bln)
                    ->where('status', 1)
                    ->select([
                        DB::raw('count(id) as jumlah'),
                        DB::raw('MONTH(date_kembali) as bulan'),
                        DB::raw('YEAR(date_kembali) as tahun')
                    ])->groupBy(['bulan', 'tahun'])
                    ->first();
                if ($d_kembali) {
                    $k_jumlah = $d_kembali->jumlah;
                } else {
                    $k_jumlah = 0;
                }
                $perbandingan[] = ['pinjam' => $p_jumlah, 'kembali' => $k_jumlah, 'bulan' => $bln];
            }
            $kerusakan = DB::table('rusak')
                ->join('sarpras_detail', 'sarpras_detail.id', '=', 'rusak.sarpras_detail_id')
                ->where('sarpras_detail.jenis', 'keluar')
                ->select([
                    DB::raw('sarpras_detail.sarpras_id as sarpras_id')
                ])->groupBy('sarpras_id')->get()->toArray();

            $t_peminjaman = Pengembalian::all()->count();
            $t_pengembalian = Pengembalian::where('status', 1)->get()->count();
            $t_pengguna = User::all()->count();

            if (Auth::user()->roles == 'BMN') {
                $menuggu_validasi = Validasi::where('validasi_ktu', 1)->where('validasi_koor', 1)->where('validasi_bmn', 0)->get()->count();
                $unread = Validasi::where('validasi_ktu', 1)->where('validasi_koor', 1)->where('validasi_bmn', 0)->where('notif', 0)->get()->count();

                return view('back.dashbmn', compact(
                    'perbandingan',
                    'perbandingan_sarpras',
                    'kerusakan',
                    'menuggu_validasi',
                    'unread',
                    't_peminjaman',
                    't_pengembalian',
                    't_pengguna'
                ));
            } elseif (Auth::user()->roles == 'Koordinator') {
                $menuggu_validasi = Validasi::where('validasi_ktu', 1)->where('validasi_koor', 0)->get()->count();
                $unread = Validasi::where('validasi_ktu', 1)->where('validasi_koor', 0)->where('notif', 0)->get()->count();

                return view('back.dashkoor', compact(
                    'perbandingan',
                    'menuggu_validasi',
                    'unread',
                    't_peminjaman',
                    't_pengembalian',
                    't_pengguna'
                ));
            } elseif (Auth::user()->roles == 'KTU') {
                $menuggu_validasi = Validasi::where('validasi_ktu', 0)->get()->count();
                $unread = Validasi::where('validasi_ktu', 0)->where('notif', 0)->get()->count();

                return view('back.dashktu', compact(
                    'perbandingan',
                    'menuggu_validasi',
                    'unread',
                    't_peminjaman',
                    't_pengembalian',
                    't_pengguna'
                ));
            } elseif (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {
                $sarpras_alls = Sarpras::whereNotIn('jumlah', [0])->get();
                $sarpras_elek = Sarpras::where('kategori', 'like', '%elektronik%')->whereNotIn('jumlah', [0])->get();
                $sarpras_mbel = Sarpras::where('kategori', 'like', '%mebel%')->whereNotIn('jumlah', [0])->get();
                $sarpras_kain = Sarpras::where('kategori', 'like', '%kain%')->whereNotIn('jumlah', [0])->get();
                $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->whereNotIn('jumlah', [0])->get();
                $sarpras_labo = Sarpras::where('kategori', 'like', '%laboratorium%')->whereNotIn('jumlah', [0])->get();
                $sarpras_rpat = Sarpras::where('kategori', 'like', '%rapat%')->whereNotIn('jumlah', [0])->get();
                $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->whereNotIn('jumlah', [0])->get();
                $tanggungan = Pengembalian::where('user_id', Auth::user()->id)->whereNotIn('status', [1])->get();

                return view('front.dashboard', compact('sarpras_alls', 'sarpras_elek', 'sarpras_mbel', 'sarpras_kain', 'sarpras_klas', 'sarpras_labo', 'sarpras_rpat', 'sarpras_lain', 'tanggungan'));
            }
        } else {
            $sarpras_alls = Sarpras::whereNotIn('jumlah', [0])->get();
            $sarpras_elek = Sarpras::where('kategori', 'like', '%elektronik%')->whereNotIn('jumlah', [0])->get();
            $sarpras_mbel = Sarpras::where('kategori', 'like', '%mebel%')->whereNotIn('jumlah', [0])->get();
            $sarpras_kain = Sarpras::where('kategori', 'like', '%kain%')->whereNotIn('jumlah', [0])->get();
            $sarpras_klas = Sarpras::where('kategori', 'like', '%kelas%')->whereNotIn('jumlah', [0])->get();
            $sarpras_labo = Sarpras::where('kategori', 'like', '%laboratorium%')->whereNotIn('jumlah', [0])->get();
            $sarpras_rpat = Sarpras::where('kategori', 'like', '%rapat%')->whereNotIn('jumlah', [0])->get();
            $sarpras_lain = Sarpras::where('kategori', 'like', '%lainnya%')->whereNotIn('jumlah', [0])->get();

            return view('front.dashboard', compact('sarpras_alls', 'sarpras_elek', 'sarpras_mbel', 'sarpras_kain', 'sarpras_klas', 'sarpras_labo', 'sarpras_rpat', 'sarpras_lain'));
        }
    }
    public function barang()
    {
        $title = 'Daftar Barang';
        $sarpras = Sarpras::where('jenis', 'Barang')->whereNotIn('jumlah', [0])->get();

        return view('front.sarpras', compact('title', 'sarpras'));
    }
    public function ruangan()
    {
        $title = 'Daftar Ruangan';
        $sarpras = Sarpras::where('jenis', 'Ruangan')->whereNotIn('jumlah', [0])->get();

        return view('front.sarpras', compact('title', 'sarpras'));
    }
    public function permohonan()
    {
        $permohonan = Validasi::where('user_id', Auth::user()->id)->where('status', 0)->orWhere('status', 3)->get();

        return view('front.module.permohonan', compact('permohonan'));
    }
    public function peminjaman()
    {
        $peminjaman = Pengembalian::where('user_id', Auth::user()->id)->whereNotIn('status', [1])->get();

        return view('front.module.peminjaman', compact('peminjaman'));
    }
    public function pengembalian()
    {
        $pengembalian = Pengembalian::where('user_id', Auth::user()->id)->where('status', 1)->get();

        return view('front.module.pengembalian', compact('pengembalian'));
    }
    public function search(Request $request)
    {
        $input = $request->input('value');
        $jenis = $request->input('jenis');

        $sarpras = Sarpras::where('jenis', $jenis)
            ->where('nama', 'LIKE', '%' . $input . '%')
            ->whereNotIn('jumlah', [0])
            ->orderBy('nama', 'asc')->get();

        return view('front.card_sarpras', compact('sarpras'));
    }
    public function sarpras_detail($id)
    {
        $sarpras = Sarpras::where('id', $id)->first();
        $sarpras_like = Sarpras::where('jenis', $sarpras->jenis)
            ->whereNotIn('id', [$id])
            ->whereNotIn('jumlah', [0])
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
