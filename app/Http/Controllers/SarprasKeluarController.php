<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\User;
use Illuminate\Http\Request;

class SarprasKeluarController extends Controller
{
    public function index()
    {
        $sarpras_keluar = SarprasDetail::where('jenis', 'keluar')
            ->orderBy('tanggal', 'desc')
            ->get();

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
