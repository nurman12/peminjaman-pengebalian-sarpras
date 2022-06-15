<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Pengembalian;
use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DraftController extends Controller
{
    public function draft_()
    {
        $draft = Draft::where('validasi_id', 0)->where('user_id', Auth::user()->id)->get();

        return view('front.draft.table')->with(['draft' => $draft]);
    }
    public function draft_update($id)
    {
        $draft = Draft::where('validasi_id', $id)->get();

        return view('front.draft.table_update')->with(['draft' => $draft]);
    }
    public function index()
    {
        $data = Validasi::where('user_id', Auth::user()->id)->where('validasi_ktu', 0)->where('validasi_koor', 0)->where('validasi_bmn', 0)->get();

        $draft = Validasi::where('user_id', Auth::user()->id)->where('validasi_ktu', 0)->where('validasi_koor', 0)->where('validasi_bmn', 0)->get();

        return view('front.draft.index', compact('data', 'draft'));
    }
    public function store(Request $request)
    {
        $sarpras_id = $request->input('sarpras_id');
        $sarpras_qty = $request->input('sarpras_qty');

        if (Auth::check()) {
            if (Draft::where('sarpras_id', $sarpras_id)->where('user_id', Auth::user()->id)->where('validasi_id', 0)->exists()) {
                Draft::where('sarpras_id', $sarpras_id)
                    ->where('user_id', Auth::user()->id)
                    ->where('validasi_id', 0)
                    ->update([
                        'qty' => $sarpras_qty
                    ]);

                return response()->json(['status' => "Berhasil mengubah jumlah pada draft", 'tes' => 'Update']);
            } else {
                $item = new Draft();
                $item->user_id = Auth::user()->id;
                $item->sarpras_id = $sarpras_id;
                $item->qty = $sarpras_qty;
                $item->save();

                return response()->json(['status' => "Ditambahkan ke draft", 'tes' => 'Ok']);
            }
        } else {
            return response()->json(['status' => 'login untuk lanjut', 'tes' => 'Error']);
        }
    }
    public function update(Request $request, $id)
    {
        Draft::where('id', $id)
            ->update([
                'qty' => $request->input('qty')
            ]);
    }
    public function update_qty(Request $request, $id)
    {
        $draft_old = Draft::where('id', $id)->first();
        $sarpras = Sarpras::where('id', $draft_old->sarpras_id)->first();

        Draft::where('id', $id)
            ->update([
                'qty' => $request->input('qty')
            ]);

        if ($draft_old->validasi_id != 0) {
            SarprasDetail::where('draft_id', $id)
                ->update([
                    'jumlah' => $request->input('qty')
                ]);
        }

        $draft_new = Draft::where('id', $id)->first();

        if ($draft_old->qty != $draft_new->qty) {
            if ($request->input('jenis') == 'tambah') {
                Sarpras::where('id', $sarpras->id)
                    ->update([
                        'jumlah' => $sarpras->jumlah - 1
                    ]);
            } elseif ($request->input('jenis') == 'kurang') {
                Sarpras::where('id', $sarpras->id)
                    ->update([
                        'jumlah' => $sarpras->jumlah + 1
                    ]);
            }
        }
    }
    public function destroy($id)
    {
        $draft = Draft::where('id', $id)->first();

        $sarpras = Sarpras::where('id', $draft->sarpras_id)->first();

        if ($draft->validasi_id != 0) {
            Sarpras::where('id', $draft->sarpras_id)
                ->update([
                    'jumlah' => $sarpras->jumlah + $draft->qty
                ]);

            SarprasDetail::where('draft_id', $id)->where('jenis', 'keluar')->delete();
        }

        Draft::where('id', $id)->delete();
    }
    public function draft_count()
    {
        $count_draf = Draft::where('validasi_id', 0)
            ->where('user_id', Auth::user()->id)
            ->count();

        echo json_encode($count_draf);
    }
    public function draft_count_update($id)
    {
        $count_draf = Draft::where('validasi_id', $id)
            ->count();

        echo json_encode($count_draf);
    }
    public function draft_update_delete($id)
    {
        $cek = Draft::where('validasi_id', Draft::where('id', $id)->first()->validasi_id)->get();
        $draft = Draft::where('id', $id)->first();
        $sarpras = Sarpras::where('id', $draft->sarpras_id)->first();

        if ($cek->count() <= 1) {
            return response()->json(['status' => "Jumlah tidak boleh kosong", 'tes' => 'Error']);
        } else {
            Draft::where('id', $id)->delete();

            if ($draft->validasi_id != 0) {
                SarprasDetail::where('draft_id', $id)->where('jenis', 'keluar')->delete();

                Sarpras::where('id', $draft->sarpras_id)
                    ->update([
                        'jumlah' => $sarpras->jumlah + $draft->qty
                    ]);
            }
        }
    }
    public function mini_draft()
    {
        $data = Draft::where('validasi_id', 0)->where('user_id', Auth::user()->id)->get();

        return view('front.draft.mini_draft')->with(['data' => $data]);
    }
    public function mini_draft_destroy($id)
    {
        Draft::where('id', $id)->delete();
    }
    public function print(Request $request)
    {
        if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen' || Auth::user()->roles == 'BMN') {
            $validasi = Validasi::where('id', $request->id)->first();

            return view('print', compact('validasi'));
        }
        return abort(403);
    }
    public function cek_qr_code(Request $request)
    {
        $id = explode(' ', $request->qr_code);

        $validasi = Validasi::where('id', $id[0])->first();

        $peminjaman = Pengembalian::where('validasi_id', $id[0])->first();

        $pengembalian = Pengembalian::where('validasi_id', $id[0])->where('status', 1)->first();

        if ($validasi) {
            if ($pengembalian) {
                return response()->json(['pengembalian' => $pengembalian->id]);
            } elseif ($peminjaman) {
                return response()->json(['peminjaman' => $peminjaman->id]);
            } else {
                return response()->json(['validasi' => $validasi->id]);
            }
        } else {
            return response()->json(['status_error' => 'No']);
        }
    }
}
