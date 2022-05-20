<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Pengembalian;
use App\Models\Rating;
use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\SarprasKeluar;
use App\Models\SarprasMasuk;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::where('status', 1)->orderBy('date_kembali', 'asc')->get();

        return view('back.pengembalian.index', compact('pengembalian'));
    }
    public function show($id)
    {
        if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {
            $pengembalian = Pengembalian::where('id', $id)->first();

            return view('front.profile.show_pengembalian', compact('pengembalian'));
        } else {
            $pengembalian = Pengembalian::where('id', $id)->first();

            $rating = Rating::where('user_id', $pengembalian->user_id)->first();
            if ($rating) {

                $jumlah = count(Rating::where('user_id', $pengembalian->user_id)->get());
                $star = Rating::where('user_id', $pengembalian->user_id)->pluck('penilaian')->sum();

                $rate = $star / $jumlah;
                if (strlen($rate) == 1) {
                    $rate = number_format($rate, 1);
                }
            } else {
                $jumlah = 0;
                $rate = 0;
            }

            return view('back.pengembalian.show', compact('pengembalian', 'jumlah', 'rate'));
        }
    }
    public function edit($id)
    {
        $pengembalian = Pengembalian::where('id', $id)->first();
        $rating = Rating::where('user_id', $pengembalian->user_id)->first();
        if ($rating) {

            $jumlah = count(Rating::where('user_id', $pengembalian->user_id)->get());
            $star = Rating::where('user_id', $pengembalian->user_id)->pluck('penilaian')->sum();

            $rate = $star / $jumlah;
            if (strlen($rate) == 1) {
                $rate = number_format($rate, 1);
            }
        } else {
            $jumlah = 0;
            $rate = 0;
        }

        return view('back.pengembalian.validasi', compact('pengembalian', 'jumlah', 'rate'));
    }
    public function update(Request $request, $id)
    {
        $draft_id = $request->input('draft_id');
        $sesuai = $request->input('sesuai');
        $tidack = $request->input('tidack');
        $check_sesuai = $request->input('check_sesuai');
        $check_tidack = $request->input('check_tidack');

        $draft = Draft::where('id', $draft_id)->first();
        $sarpras_masuk = SarprasMasuk::where('draft_id', $draft_id)->first();
        $sarpras_keluar = SarprasKeluar::where('draft_id', $draft_id)->first();

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
                    SarprasMasuk::where('draft_id', $draft_id)
                        ->update([
                            'jumlah' => $sarpras_masuk->jumlah + $sesuai,
                            'keterangan' => null
                        ]);

                    SarprasKeluar::where('draft_id', $draft_id)
                        ->update([
                            'hilang' => 0
                        ]);
                } else {
                    $jumlah_masuk = $sarpras_masuk->jumlah + $sesuai;
                    SarprasMasuk::where('draft_id', $draft_id)
                        ->update([
                            'jumlah' => $jumlah_masuk,
                            'keterangan' => 'Dikembalikan ' . $jumlah_masuk . ' dari ' . $sarpras_keluar->jumlah
                        ]);
                }
            } else {
                $sarpras_masuk =  new SarprasMasuk();
                $sarpras_masuk->user_id = $draft->user_id;
                $sarpras_masuk->draft_id = $draft->id;
                $sarpras_masuk->sarpras_id = $draft->sarpras_id;
                $sarpras_masuk->tanggal_masuk = date('Y-m-d');
                $sarpras_masuk->jumlah = $sesuai;
                if ($draft->qty == $sesuai) {
                    $sarpras_masuk->keterangan = null;
                } else {
                    $sarpras_masuk->keterangan = 'Dikembalikan ' . $sesuai . ' dari ' . $draft->qty;
                }
                $sarpras_masuk->save();

                $get_max_id = SarprasMasuk::all()->max();

                // ubah dari membuat data lai ke digabung ke sarpras keluar
                SarprasDetail::where('sarpras_keluar_id', $sarpras_keluar->id)
                    ->update([
                        'sarpras_masuk_id' => $get_max_id->id
                    ]);
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

            $new_sarpras_keluar = SarprasKeluar::where('draft_id', $draft_id)->first();

            if ($new_sarpras_keluar->hilang > 0 && $check_tidack == 'true') {
                if ($new_sarpras_keluar->hilang < $sesuai) {
                    return response()->json(['error_message' => 'Jumlah sesuai melebihi jumlah sarpras yang rusak / hilang']);
                }
                $jumlah_keluar = $new_sarpras_keluar->hilang - $sesuai;
                SarprasKeluar::where('id', $new_sarpras_keluar->id)
                    ->update([
                        'hilang' => $jumlah_keluar
                    ]);
            }
            if ($new_draf->qty == 0) {
                Draft::where('id', $draft_id)
                    ->update([
                        'kondisi' => 1
                    ]);

                SarprasKeluar::where('id', $sarpras_keluar->id)
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

            $sarpras_masuk = SarprasMasuk::where('draft_id', $draft_id)->first();
            $sarpras_keluar = SarprasKeluar::where('draft_id', $draft_id)->first();
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
                    SarprasMasuk::where('id', $sarpras_masuk->id)
                        ->update([
                            'jumlah' => $jumlah_masuk_
                        ]);

                    $new_sarpras_masuk = SarprasMasuk::where('draft_id', $draft_id)->first();

                    if ($new_sarpras_masuk->jumlah == 0) {
                        SarprasMasuk::destroy($sarpras_masuk->id);
                        // DB::table('sarpras_detail')->where('sarpras_masuk_id', $sarpras_masuk->id)->delete();
                        SarprasDetail::where('sarpras_keluar_id', $sarpras_keluar->id)
                            ->update([
                                'sarpras_masuk_id' => null
                            ]);
                    }
                }
            }
            if ($check_sesuai == 'false') {
                if ($sarpras_masuk->jumlah + $sarpras_keluar->hilang == $sarpras_keluar->jumlah) {
                    return response()->json(['error_message' => 'Jumlah sarpras yang belum divalidasi tidak ada!']);
                }
            }

            $jumlah_keluar___ = $sarpras_keluar->hilang + $tidack;
            SarprasKeluar::where('id', $sarpras_keluar->id)
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
                        'date_kembali' => null,
                        'status' => 2
                    ]);

                $pengembalian = Pengembalian::where('id', $id)->first();

                if ($pengembalian->rating) {
                    DB::table('rating')->where('pengembalian_id', $pengembalian->id)->delete();
                }
            }
        }

        $pengembalian = Pengembalian::where('id', $id)->first();
        if ($pengembalian->status == 1) {
            return response()->json(['success_message' => 'Ingin memberi rating?']);
        } else {
            $pengembalian = Pengembalian::where('id', $id)->first();
            $rating = Rating::where('user_id', $pengembalian->user_id)->first();
            if ($rating) {

                $jumlah = count(Rating::where('user_id', $pengembalian->user_id)->get());
                $star = Rating::where('user_id', $pengembalian->user_id)->pluck('penilaian')->sum();

                $rate = $star / $jumlah;
                if (strlen($rate) == 1) {
                    $rate = number_format($rate, 1);
                }
            } else {
                $jumlah = 0;
                $rate = 0;
            }

            return view('back.pengembalian.validasi', compact('pengembalian', 'jumlah', 'rate'));
        }
    }
    public function destroy($id)
    {
        $pengembalian = Pengembalian::where('validasi_id', $id)->first();

        // reset validasi pengembalian
        $draft = Draft::where('validasi_id', $id)->get();

        foreach ($draft as $data) {
            $sarpras = Sarpras::where('id', $data->sarpras_id)->first();
            // jika sudah pernah divalidasi lakukan reset 
            if ($data->sarpras_masuk) {
                Sarpras::where('id', $sarpras->id)
                    ->update([
                        'jumlah' => $sarpras->jumlah - $data->sarpras_masuk->jumlah
                    ]);
                // DB::table('sarpras_detail')->where('sarpras_masuk_id', $data->sarpras_masuk->id)->delete();
                SarprasDetail::where('sarpras_masuk_id', $data->sarpras_masuk->id)
                    ->update([
                        'sarpras_masuk_id' => null
                    ]);
                DB::table('sarpras_masuk')->where('draft_id', $data->id)->delete();
            }
            Draft::where('id', $data->id)
                ->update([
                    'qty' => $data->sarpras_keluar->jumlah,
                    'kondisi' => 0
                ]);

            SarprasKeluar::where('draft_id', $data->id)
                ->update([
                    'hilang' => 0,
                    'keterangan' => null
                ]);
        }

        DB::table('rating')->where('pengembalian_id', $pengembalian->id)->delete();

        Pengembalian::where('validasi_id', $id)
            ->update([
                'status' => 0,
                'date_kembali' => null
            ]);

        return response()->json(['success_message' => 'Berhasil hapus data pengembalian!']);
    }
}