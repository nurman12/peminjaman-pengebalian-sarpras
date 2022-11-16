<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SarprasKeluarController extends Controller
{
    public function index()
    {
        $d_pinjam = DB::table('sarpras_detail')
            ->join('draft', 'draft.id', '=', 'sarpras_detail.draft_id')
            ->join('validasi', 'validasi.id', '=', 'draft.validasi_id')
            ->join('sarpras', 'sarpras.id', '=', 'sarpras_detail.sarpras_id')
            ->where('sarpras_detail.jenis', 'keluar')
            ->whereIn('validasi.status', [0, 1])
            ->orderBy('sarpras_detail.tanggal', 'desc')
            ->get()->toArray();

        $admin = DB::table('sarpras_detail')
            ->join('sarpras', 'sarpras.id', '=', 'sarpras_detail.sarpras_id')
            ->where('sarpras_detail.draft_id', '=', null)
            ->where('sarpras_detail.jenis', 'keluar')
            ->select(
                DB::raw('sarpras_detail.id as id'),
                DB::raw('sarpras.nama as nama'),
                DB::raw('sarpras_detail.tanggal as tanggal'),
                DB::raw('sarpras_detail.jumlah as jumlah'),
                DB::raw('sarpras_detail.keterangan as keterangan'),
                DB::raw('sarpras_detail.draft_id as draft_id'),
                DB::raw('sarpras_detail.sarpras_id as sarpras_id'),
                DB::raw('sarpras.photo as photo')
            )
            ->get()->toArray();

        $sarpras_keluar = [];
        foreach ($d_pinjam as $data) {
            $sarpras_keluar[] = ["id" => $data->id, "nama" => $data->nama, "tanggal" => $data->tanggal, "jumlah" => $data->qty, "keperluan" => "dipinjam", "draft_id" => $data->draft_id, "sarpras_id" => $data->sarpras_id, "photo" => $data->photo];
        }
        foreach ($admin as $data) {
            $sarpras_keluar[] = ["id" => $data->id, "nama" => $data->nama, "tanggal" => $data->tanggal, "jumlah" => $data->jumlah, "keperluan" => $data->keterangan, "draft_id" => $data->draft_id, "sarpras_id" => $data->sarpras_id, "photo" => $data->photo];
        }
        array_multisort(
            array_map('strtotime', array_column($sarpras_keluar, 'tanggal')),
            SORT_DESC,
            $sarpras_keluar
        );

        return view('back.sarpras_keluar.index', compact('sarpras_keluar'));
    }
    public function create()
    {
        $sarpras_brg = Sarpras::where('jenis', 'Barang')->get();
        $sarpras_rgn = Sarpras::where('jenis', 'Ruangan')->get();

        return view('back.sarpras_keluar.create', compact('sarpras_brg', 'sarpras_rgn'));
    }
    public function show($id)
    {
        $sarpras_keluar = SarprasDetail::where('id', $id)->first();

        return view('back.sarpras_keluar.show', compact('sarpras_keluar'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'sarpras' => 'required',
            'user_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required'
        ]);

        $sarpras = Sarpras::where('id', $request->sarpras)->first();

        if ($sarpras->jumlah >= $request->jumlah) {
            $sarpras_keluar = new SarprasDetail();
            $sarpras_keluar->user_id = $request->user_id;
            $sarpras_keluar->sarpras_id = $request->sarpras;
            $sarpras_keluar->tanggal = $request->tanggal;
            $sarpras_keluar->jenis = "keluar";
            $sarpras_keluar->jumlah = $request->jumlah;
            $sarpras_keluar->keterangan = $request->keterangan;
            $sarpras_keluar->save();

            Sarpras::where('id', $request->sarpras)
                ->update([
                    'jumlah' => $sarpras->jumlah - $request->jumlah
                ]);

            return redirect('/sarpras_keluar')->with(['success' => 'Berhasil simpan data']);
        } else {
            return redirect('/sarpras_keluar')->with(['error' => 'Jumlah keluar melebihi stok']);
        }
    }
    public function update(Request $request, $id)
    {
        $sarpras_id = $request->input('sarpras_id');
        $tanggal = $request->input('tanggal');
        $jumlah_b = $request->input('jumlah');
        $old_jumlah = $request->input('old_jumlah');
        $keterangan = $request->input('keterangan');

        $sarpras = Sarpras::where('id', $sarpras_id)->first();
        $jumlah_a = $sarpras->jumlah + $old_jumlah;
        $jumlah_c = $jumlah_a - $jumlah_b;

        if ($jumlah_a >= $jumlah_b) {
            Sarpras::where('id', $sarpras_id)
                ->update([
                    'jumlah' => $jumlah_c
                ]);

            SarprasDetail::where('id', $id)
                ->update([
                    'tanggal' => $tanggal,
                    'jumlah' => $jumlah_b,
                    'keterangan' => $keterangan
                ]);

            return redirect('/sarpras_keluar')->with(['success' => 'Berhasil mengubah data']);
        } else {
            return redirect('/sarpras_keluar')->with(['error' => 'Jumlah keluar melebihi stok']);
        }
    }
    public function destroy($id)
    {
        $sarpras_keluar = SarprasDetail::where('id', $id)->first();
        $sarpras = Sarpras::where('id', $sarpras_keluar->sarpras_id)->first();
        $jumlah = $sarpras->jumlah + $sarpras_keluar->jumlah;

        Sarpras::where('id', $sarpras->id)
            ->update([
                'jumlah' => $jumlah
            ]);

        SarprasDetail::destroy($id);

        return response(['success_message' => 'berhasil hapus data']);
    }
}
