<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Pengembalian;
use App\Models\Rating;
use App\Models\Rusak;
use App\Models\Sarpras;
use App\Models\SarprasDetail;
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
        $sesuai = $request->input('sesuai');
        $tidack = $request->input('tidack');

        // Data master sesuai
        $old_draft = Draft::where('id', $request->draft_id)->first();
        $old_sarpras = Sarpras::where('id', $old_draft->sarpras_id)->first();
        $old_sarpras_masuk = SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'masuk')->first();
        $old_sarpras_keluar = SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'keluar')->first();

        if ($sesuai != null || $sesuai != 0) {
            if ($old_sarpras_keluar->hilang == 0) {
                if ($old_sarpras_masuk != null) {

                    $jumlah_masuk = $old_sarpras_masuk->jumlah + $sesuai;

                    if ($jumlah_masuk > $old_sarpras_keluar->jumlah) {
                        return response()->json(['error_message' => 'Jumlah masukan sesuai terlalu banyak!']);
                    } elseif ($sesuai == $old_draft->qty) {
                        SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'masuk')->update([
                            'jumlah' => $jumlah_masuk,
                            'keterangan' => null
                        ]);

                        SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'keluar')->update([
                            'hilang' => 0,
                            'keterangan' => null
                        ]);
                    } else {
                        SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'masuk')->update([
                            'jumlah' => $jumlah_masuk,
                            'keterangan' => 'Dikembalikan ' . $jumlah_masuk . ' dari ' . $old_sarpras_keluar->jumlah
                        ]);

                        SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'keluar')->update([
                            'keterangan' => 'Dikembalikan ' . $jumlah_masuk . ' dari ' . $old_sarpras_keluar->jumlah
                        ]);
                    }
                } else {
                    $sarpras_masuk =  new SarprasDetail();
                    $sarpras_masuk->user_id = $old_draft->user_id;
                    $sarpras_masuk->draft_id = $old_draft->id;
                    $sarpras_masuk->sarpras_id = $old_draft->sarpras_id;
                    $sarpras_masuk->tanggal = date('Y-m-d');
                    $sarpras_masuk->jenis = "masuk";
                    $sarpras_masuk->jumlah = $sesuai;
                    if ($old_draft->qty == $sesuai) {
                        $sarpras_masuk->keterangan = null;
                    } else {
                        $sarpras_masuk->keterangan = 'Dikembalikan ' . $sesuai . ' dari ' . $old_sarpras_keluar->jumlah;
                    }
                    $sarpras_masuk->save();

                    SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'keluar')->update([
                        'keterangan' => 'Dikembalikan ' . $sesuai . ' dari ' . $old_sarpras_keluar->jumlah
                    ]);
                }
            } else {
                if ($old_sarpras_masuk != null) {
                    if (($old_sarpras_keluar->jumlah - $old_sarpras_masuk->jumlah) < $sesuai) {
                        return response()->json(['error_message' => 'Jumlah input sesuai terlalu banyak!']);
                    } else {
                        $jumlah_masuk = $old_sarpras_masuk->jumlah + $sesuai;
                        $hilang = $old_sarpras_keluar->hilang - $sesuai;

                        if ($hilang < 0) {

                            $selisih = $old_sarpras_keluar->jumlah - $jumlah_masuk;

                            SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'masuk')->update([
                                'jumlah' => $jumlah_masuk,
                                'keterangan' => 'Dikembalikan ' . $selisih . ' dari ' . $old_sarpras_keluar->jumlah
                            ]);

                            SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'keluar')->update([
                                'hilang' => 0,
                                'keterangan' => 'Dikembalikan ' . $jumlah_masuk . ' dari ' . $old_sarpras_keluar->jumlah
                            ]);
                        } else {
                            SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'masuk')->update([
                                'jumlah' => $jumlah_masuk,
                                'keterangan' => 'Dikembalikan ' . $jumlah_masuk . ' dari ' . $old_sarpras_keluar->jumlah
                            ]);

                            SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'keluar')->update([
                                'hilang' => $hilang,
                                'keterangan' => 'Dikembalikan ' . $jumlah_masuk . ' dari ' . $old_sarpras_keluar->jumlah
                            ]);
                        }
                    }
                } elseif ($old_sarpras_masuk == null) {
                    $hasil = $old_sarpras_keluar->hilang - $sesuai;

                    if ($hasil < 0) {
                        SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'keluar')->update([
                            'hilang' => 0,
                            'keterangan' => 'Dikembalikan ' . $sesuai . ' dari ' . $old_sarpras_keluar->jumlah
                        ]);
                    } else {
                        SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'keluar')->update([
                            'hilang' => $hasil,
                            'keterangan' => 'Dikembalikan ' . $sesuai . ' dari ' . $old_sarpras_keluar->jumlah
                        ]);
                    }

                    $sarpras_masuk =  new SarprasDetail();
                    $sarpras_masuk->user_id = $old_draft->user_id;
                    $sarpras_masuk->draft_id = $old_draft->id;
                    $sarpras_masuk->sarpras_id = $old_draft->sarpras_id;
                    $sarpras_masuk->tanggal = date('Y-m-d');
                    $sarpras_masuk->jenis = "masuk";
                    $sarpras_masuk->jumlah = $sesuai;
                    if ($old_draft->qty == $sesuai) {
                        $sarpras_masuk->keterangan = null;
                    } else {
                        $sarpras_masuk->keterangan = 'Dikembalikan ' . $sesuai . ' dari ' . $old_sarpras_keluar->jumlah;
                    }
                    $sarpras_masuk->save();
                }
            }

            $jumlah_akhir = $sesuai + $old_sarpras->jumlah;
            $jumlah_qty = $old_draft->qty - $sesuai;

            Sarpras::where('id', $old_draft->sarpras_id)->update([
                'jumlah' => $jumlah_akhir
            ]);

            Draft::where('id', $request->draft_id)->update([
                'qty' => $jumlah_qty
            ]);

            $new_draf = Draft::where('id', $request->draft_id)->first();

            if ($new_draf->qty == 0) {
                Draft::where('id', $request->draft_id)->update([
                    'kondisi' => 1
                ]);
            }

            // get data baru 
            $data = Draft::where('validasi_id', $old_draft->validasi_id)->whereNotIn('kondisi', [1])->first();

            if (!$data) {
                Pengembalian::where('id', $id)->update([
                    'date_kembali' => date('Y-m-d'),
                    'status' => 1
                ]);
            }
        }

        // Data master tidack
        $old_draft = Draft::where('id', $request->draft_id)->first();
        $old_sarpras = Sarpras::where('id', $old_draft->sarpras_id)->first();
        $old_sarpras_masuk = SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'masuk')->first();
        $old_sarpras_keluar = SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'keluar')->first();
        $old_rusak = Rusak::where('sarpras_detail_id', $old_sarpras_keluar->id)->first();

        if ($tidack != null || $tidack != 0) {

            // jika belum ada yg dikembalikan
            if ($old_sarpras_masuk == null) {
                if (($old_sarpras_keluar->hilang + $tidack) > $old_sarpras_keluar->jumlah) {
                    return response()->json(['error_message' => 'Jumlah masukan tidak sesuai terlalu banyak!']);
                } else {
                    $jumlah_hilang = $old_sarpras_keluar->hilang + $tidack;
                    SarprasDetail::where('id', $old_sarpras_keluar->id)->update([
                        'hilang' => $jumlah_hilang,
                        'keterangan' => 'Dikembalikan ' . 0 . ' dari ' . $old_sarpras_keluar->jumlah
                    ]);

                    Draft::where('id', $request->draft_id)->update([
                        'kondisi' => 2
                    ]);

                    if ($old_rusak) {
                        if ($jumlah_hilang > $old_rusak->hilang) {
                            Rusak::where('sarpras_detail_id', $old_sarpras_keluar->id)->update([
                                'hilang' => $jumlah_hilang
                            ]);
                        }
                    } else {
                        $rusak = new Rusak();
                        $rusak->sarpras_detail_id = $old_sarpras_keluar->id;
                        $rusak->hilang = $tidack;
                        $rusak->save();
                    }
                }
            } elseif ($old_sarpras_masuk != null) {
                if (($old_sarpras_keluar->hilang + $tidack) > $old_sarpras_keluar->jumlah) {
                    return response()->json(['error_message' => 'Jumlah input tidak sesuai terlalu banyak!']);
                } else {
                    $jumlah_draft = $old_draft->qty + $tidack;
                    Draft::where('id', $request->draft_id)->update([
                        'qty' => $jumlah_draft,
                        'kondisi' => 2
                    ]);

                    $jumlah_masuk = $old_sarpras_masuk->jumlah - $tidack;
                    SarprasDetail::where('id', $old_sarpras_masuk->id)->update([
                        'jumlah' => $jumlah_masuk
                    ]);

                    $jumlah_hilang = $old_sarpras_keluar->hilang + $tidack;
                    SarprasDetail::where('id', $old_sarpras_keluar->id)->update([
                        'hilang' => $jumlah_hilang,
                        'keterangan' => 'Dikembalikan ' . $jumlah_masuk . ' dari ' . $old_sarpras_keluar->jumlah
                    ]);

                    $jumlah_sarpras = $old_sarpras->jumlah - $tidack;
                    Sarpras::where('id', $old_sarpras->id)->update([
                        'jumlah' => $jumlah_sarpras
                    ]);

                    $new_sarpras_masuk = SarprasDetail::where('draft_id', $request->draft_id)->where('jenis', 'masuk')->first();

                    if ($new_sarpras_masuk->jumlah == 0) {
                        SarprasDetail::destroy($new_sarpras_masuk->id);
                    }

                    if ($old_rusak) {
                        if ($jumlah_hilang > $old_rusak->hilang) {
                            Rusak::where('sarpras_detail_id', $old_sarpras_keluar->id)->update([
                                'hilang' => $jumlah_hilang
                            ]);
                        }
                    } else {
                        $rusak = new Rusak();
                        $rusak->sarpras_detail_id = $old_sarpras_keluar->id;
                        $rusak->hilang = $tidack;
                        $rusak->save();
                    }
                }
            }

            // get data baru 
            $new_draft = Draft::where('id', $request->draft_id)->first();

            $data = Draft::where('validasi_id', $new_draft->validasi_id)->where('kondisi', 2)->first();
            if ($data != null) {
                Pengembalian::where('id', $id)->update([
                    'date_kembali' => date('Y-m-d'),
                    'status' => 2
                ]);
            }
        }

        // cek result validate
        $peminjaman = Pengembalian::where('id', $id)->first();
        if ($peminjaman->status == 1) {
            Validasi::where('id', $peminjaman->validasi_id)
                ->update([
                    'status' => 2
                ]);
            return response()->json(['success_message' => 'Anda dapat memberi rating pada menu pengembalian']);
        } else {
            Validasi::where('id', $peminjaman->validasi_id)
                ->update([
                    'status' => 1
                ]);
            $rating = Rating::where('pengembalian_id', $peminjaman->id)->first();
            if ($rating) {
                Rating::where('pengembalian_id', $peminjaman->id)->delete();
            }

            return response()->json(['success_message_other' => 'berhasil melakukan validasi']);
        }
    }
    public function destroy($id)
    {
        // reset validasi pengembalian
        $draft = Draft::where('validasi_id', $id)->get();

        foreach ($draft as $data) {
            $sarpras_masuk = SarprasDetail::where('draft_id', $data->id)->where('jenis', 'masuk')->first();
            $sarpras_keluar = SarprasDetail::where('draft_id', $data->id)->where('jenis', 'keluar')->first();

            // jika sudah pernah divalidasi lakukan reset 
            if ($data->sarpras_masuk) {
                Sarpras::where('id', $data->sarpras_id)->update([
                    'jumlah' =>  $data->sarpras->jumlah - $data->sarpras_masuk->jumlah
                ]);

                DB::table('sarpras_detail')->where('draft_id', $data->id)->where('jenis', 'masuk')->delete();
            }

            Rusak::where('sarpras_detail_id', $data->sarpras_keluar->id)->delete();

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
