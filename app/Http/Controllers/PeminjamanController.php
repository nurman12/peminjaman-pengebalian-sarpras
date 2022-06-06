<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Pengembalian;
use App\Models\Rating;
use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\User;
use App\Models\Validasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Pengembalian::where('status', 0)
            ->orWhere('status', 2)
            ->orderBy('date_ambil', 'asc')
            ->get();

        return view('back.peminjaman.index', compact('peminjaman'));
    }
    public function store(Request $request)
    {
        $validasi_id = $request->validasi_id;

        $user_id = $request->user_id;

        $pengembalian = Pengembalian::where('validasi_id', $validasi_id)->first();
        $draft = Draft::where('validasi_id', $validasi_id)->get();

        // Cek Apakah sudah ada id validasi di table kembali
        if ($pengembalian == null) {

            $pengembalian = new Pengembalian();
            $pengembalian->validasi_id = $validasi_id;
            $pengembalian->user_id = $user_id;
            $pengembalian->date_ambil = date('Y-m-d');
            $pengembalian->save();

            Validasi::where('id', $validasi_id)
                ->update([
                    'status' => 1
                ]);

            return response()->json(['success_message' => 'Berhasil menambah data peminjaman!']);
        } else {
            return response()->json(['error_message' => 'Data permohonan peminjaman sudah diambil!']);
        }
    }
    public function show($id)
    {
        $peminjaman = Pengembalian::where('id', $id)->first();

        if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {
            return view('front.profile.show_pinjaman', compact('peminjaman'));
        } else {

            $rating = Rating::where('user_id', $peminjaman->user_id)->first();
            if ($rating) {

                $jumlah = count(Rating::where('user_id', $peminjaman->user_id)->get());
                $star = Rating::where('user_id', $peminjaman->user_id)->pluck('penilaian')->sum();

                $rate = $star / $jumlah;
                if (strlen($rate) == 1) {
                    $rate = number_format($rate, 1);
                }
            } else {
                $jumlah = 0;
                $rate = 0;
            }
            return view('back.peminjaman.show', compact('peminjaman', 'jumlah', 'rate'));
        }
    }
    public function edit($id)
    {
        $peminjaman = Pengembalian::where('id', $id)->first();
        $rating = Rating::where('user_id', $peminjaman->user_id)->first();
        if ($rating) {

            $jumlah = count(Rating::where('user_id', $peminjaman->user_id)->get());
            $star = Rating::where('user_id', $peminjaman->user_id)->pluck('penilaian')->sum();

            $rate = $star / $jumlah;
            if (strlen($rate) == 1) {
                $rate = number_format($rate, 1);
            }
        } else {
            $jumlah = 0;
            $rate = 0;
        }

        return view('back.peminjaman.validasi', compact('peminjaman', 'jumlah', 'rate'));
    }
    public function update(Request $request, $id)
    {
        $draft_id = $request->input('draft_id');
        $sesuai = $request->input('sesuai');
        $tidack = $request->input('tidack');
        $check_sesuai = $request->input('check_sesuai');
        $check_tidack = $request->input('check_tidack');

        $draft = Draft::where('id', $draft_id)->first();
        $sarpras_masuk = SarprasDetail::where('draft_id', $draft_id)->where('jenis', 'masuk')->first();
        $sarpras_keluar = SarprasDetail::where('draft_id', $draft_id)->where('jenis', 'keluar')->first();

        // kita kasih validasi ya geys ya..
        if ($sesuai != null || $sesuai != 0 && $tidack != null || $tidack != 0) {
            if ($sarpras_masuk == null && $draft->qty < $sesuai + $tidack) {
                return response()->json(['error_message' => 'Jumlah inputan sesuai atau tidak sesuai terlalu banyak!']);
            }
            if ($sarpras_masuk != null && $sarpras_masuk->jumlah + $draft->qty < $sesuai + $tidack) {
                return response()->json(['error_message' => 'Jumlah inputan sesuai atau tidak sesuai terlalu banyak!']);
            }
        }
        if ($sesuai != null || $sesuai != 0) {
            if ($sarpras_masuk == null && $draft->qty < $sesuai) {
                return response()->json(['error_message' => 'Jumlah inputan sesuai terlalu banyak!']);
            }
            if ($sarpras_masuk != null && $draft->qty < $sesuai) {
                return response()->json(['error_message' => 'Jumlah inputan sesuai terlalu banyak!']);
            }
        }
        if ($tidack != null || $tidack != 0) {
            if ($sarpras_masuk == null && $draft->qty < $tidack) {
                return response()->json(['error_message' => 'Jumlah inputan tidak sesuai terlalu banyak!']);
            }
            if ($sarpras_masuk == null && $sarpras_keluar->jumlah < $tidack) {
                return response()->json(['error_message' => 'Jumlah inputan tidak sesuai terlalu banyak!']);
            }
            if ($sarpras_masuk != null && $sarpras_masuk->jumlah + $draft->qty < $tidack) {
                return response()->json(['error_message' => 'Jumlah inputan tidak sesuai terlalu banyak!']);
            }
            if ($sarpras_masuk != null && $sarpras_keluar->jumlah < $tidack) {
                return response()->json(['error_message' => 'Jumlah inputan tidak sesuai terlalu banyak!']);
            }
            if ($sarpras_keluar->jumlah < $sarpras_keluar->hilang + $tidack) {
                return response()->json(['error_message' => 'Jumlah inputan tidak sesuai terlalu banyak!']);
            }
        }

        // jika sesuai
        if ($sesuai != null || $sesuai != 0) {

            if ($check_tidack == 'false') {
                if ($sarpras_keluar->hilang == $draft->qty) {
                    return response()->json(['error_message' => 'Jumlah sarpras yang belum divalidasi tidak ada!']);
                }
            }
            if ($check_tidack == 'true') {
                if ($sarpras_keluar->hilang == 0) {
                    return response()->json(['error_message' => 'Jumlah sarpras hilang / rusak tidak ada!']);
                }
            }

            if ($sarpras_masuk != null) {
                if ($draft->qty == $sesuai) {
                    SarprasDetail::where('draft_id', $draft_id)
                        ->where('jenis', 'masuk')
                        ->update([
                            'jumlah' => $sarpras_masuk->jumlah + $sesuai,
                            'keterangan' => null
                        ]);

                    SarprasDetail::where('draft_id', $draft_id)
                        ->where('jenis', 'keluar')
                        ->update([
                            'hilang' => 0
                        ]);
                } else {
                    $jumlah_masuk = $sarpras_masuk->jumlah + $sesuai;
                    SarprasDetail::where('draft_id', $draft_id)
                        ->where('jenis', 'masuk')
                        ->update([
                            'jumlah' => $jumlah_masuk,
                            'keterangan' => 'Dikembalikan ' . $jumlah_masuk . ' dari ' . $sarpras_keluar->jumlah
                        ]);
                }
            } else {
                $sarpras_masuk =  new SarprasDetail();
                $sarpras_masuk->user_id = $draft->user_id;
                $sarpras_masuk->draft_id = $draft->id;
                $sarpras_masuk->sarpras_id = $draft->sarpras_id;
                $sarpras_masuk->tanggal = date('Y-m-d');
                $sarpras_masuk->jenis = "masuk";
                $sarpras_masuk->jumlah = $sesuai;
                if ($draft->qty == $sesuai) {
                    $sarpras_masuk->keterangan = null;
                } else {
                    $sarpras_masuk->keterangan = 'Dikembalikan ' . $sesuai . ' dari ' . $draft->qty;
                }
                $sarpras_masuk->save();
            }
            $sarpras = Sarpras::where('id', $draft->sarpras_id)->first();

            $jumlah_akhir = $draft->qty + $sarpras->jumlah;

            $jumlah_qty = $draft->qty - $sesuai;

            Sarpras::where('id', $draft->sarpras_id)
                ->update([
                    'jumlah' => $jumlah_akhir
                ]);

            Draft::where('id', $draft_id)
                ->update([
                    'qty' => $jumlah_qty
                ]);

            $new_draf = Draft::where('id', $draft_id)->first();

            $new_sarpras_keluar = SarprasDetail::where('draft_id', $draft_id)->where('jenis', 'keluar')->first();

            if ($new_sarpras_keluar->hilang > 0 && $check_tidack == 'true') {
                if ($new_sarpras_keluar->hilang < $sesuai) {
                    return response()->json(['error_message' => 'Jumlah sesuai melebihi jumlah sarpras yang rusak / hilang']);
                }
                $jumlah_keluar = $new_sarpras_keluar->hilang - $sesuai;
                SarprasDetail::where('id', $new_sarpras_keluar->id)
                    ->where('jenis', 'keluar')
                    ->update([
                        'hilang' => $jumlah_keluar
                    ]);
            }
            if ($new_draf->qty == 0) {
                Draft::where('id', $draft_id)
                    ->update([
                        'kondisi' => 1
                    ]);

                SarprasDetail::where('id', $sarpras_keluar->id)
                    ->where('jenis', 'keluar')
                    ->update([
                        'hilang' => 0,
                        'keterangan' => null
                    ]);
            }
            $new_draf_ = Draft::where('id', $draft_id)->first();

            $data_m = Draft::where('validasi_id', $new_draf_->validasi_id)->whereNotIn('kondisi', [1])->first();

            if (!$data_m) {
                Pengembalian::where('id', $id)
                    ->update([
                        'date_kembali' => date('Y-m-d'),
                        'status' => 1
                    ]);
            }
        }
        // jika tidack 
        if ($tidack != null || $tidack != 0) {

            $sarpras_masuk = SarprasDetail::where('draft_id', $draft_id)->where('jenis', 'masuk')->first();
            $sarpras_keluar = SarprasDetail::where('draft_id', $draft_id)->where('jenis', 'keluar')->first();
            $new_draf__ = Draft::where('id', $draft_id)->first();

            if ($check_sesuai == 'true') {

                if ($sarpras_masuk == null) {
                    return response()->json(['error_message' => 'Jumlah yang sudah dikembalikan belum ada!']);
                } elseif ($sarpras_masuk != null && $sarpras_masuk->jumlah < $tidack) {
                    return response()->json(['error_message' => 'Jumlah yang dimasukkan terlalu banyak!']);
                } elseif ($sarpras_masuk != null && $sarpras_masuk->jumlah >= $tidack) {
                    $jumlah_draft =  $new_draf__->qty + $tidack;
                    Draft::where('id', $draft_id)
                        ->update([
                            'qty' => $jumlah_draft
                        ]);

                    $jumlah_masuk_ = $sarpras_masuk->jumlah - $tidack;
                    SarprasDetail::where('id', $sarpras_masuk->id)
                        ->where('jenis', 'masuk')
                        ->update([
                            'jumlah' => $jumlah_masuk_
                        ]);

                    $new_sarpras_masuk = SarprasDetail::where('draft_id', $draft_id)->where('jenis', 'masuk')->first();

                    if ($new_sarpras_masuk->jumlah == 0) {
                        SarprasDetail::destroy($sarpras_masuk->id);
                    }
                }
            }
            if ($check_sesuai == 'false') {
                if ($sarpras_masuk->jumlah + $sarpras_keluar->hilang == $sarpras_keluar->jumlah) {
                    return response()->json(['error_message' => 'Jumlah sarpras yang belum divalidasi tidak ada!']);
                }
            }

            $jumlah_keluar___ = $sarpras_keluar->hilang + $tidack;
            SarprasDetail::where('id', $sarpras_keluar->id)
                ->where('jenis', 'keluar')
                ->update([
                    'hilang' => $jumlah_keluar___,
                    'keterangan' => 'rusak / hilang'
                ]);

            Draft::where('id', $draft_id)
                ->update([
                    'kondisi' => 2
                ]);

            $new_draf = Draft::where('id', $draft_id)->first();

            $data_r = Draft::where('validasi_id', $new_draf->validasi_id)->where('kondisi', 2)->first();
            if ($data_r != null) {
                Pengembalian::where('id', $id)
                    ->update([
                        'date_kembali' => date('Y-m-d'),
                        'status' => 2
                    ]);
            }
        }

        $peminjaman = Pengembalian::where('id', $id)->first();
        if ($peminjaman->status == 1) {
            return response()->json(['success_message' => 'Ingin memberi rating?']);
        } else {
            return response()->json(['success_message_other' => 'berhasil']);
        }
    }
    public function destroy($id)
    {
        // reset validasi pengembalian
        $draft = Draft::where('validasi_id', $id)->get();

        foreach ($draft as $data) {
            $sarpras_masuk = SarprasDetail::where('draft_id', $data->id)->where('jenis', 'masuk')->first();

            // jika sudah pernah divalidasi lakukan reset 
            if ($sarpras_masuk) {
                DB::table('sarpras_detail')->where('draft_id', $data->id)->where('jenis', 'masuk')->delete();
            }

            Draft::where('id', $data->id)
                ->update([
                    'qty' => $data->sarpras_keluar->jumlah,
                    'kondisi' => 0
                ]);

            SarprasDetail::where('draft_id', $data->id)
                ->where('jenis', 'keluar')
                ->update([
                    'hilang' => 0,
                    'keterangan' => null
                ]);
        }

        Validasi::where('id', $id)
            ->update([
                'status' => 0
            ]);


        DB::table('pengembalian')->where('validasi_id', $id)->delete();

        return response()->json(['success_message' => 'Berhasil hapus data pinjaman!']);
    }
}
