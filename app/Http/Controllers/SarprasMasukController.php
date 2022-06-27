<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\User;
use Illuminate\Http\Request;

class SarprasMasukController extends Controller
{
    public function index()
    {
        $sarpras_masuk = SarprasDetail::whereNotIn('user_id', User::where('roles', 'Mahasiswa')
            ->orWhere('roles', 'Dosen')->get('id'))
            ->where('jenis', 'masuk')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('back.sarpras_masuk.index', compact('sarpras_masuk'));
    }
    public function create()
    {
        $sarpras_brg = Sarpras::where('jenis', 'Barang')->get();
        $sarpras_rgn = Sarpras::where('jenis', 'Ruangan')->get();

        return view('back.sarpras_masuk.create', compact('sarpras_brg', 'sarpras_rgn'));
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
        $sarpras_masuk = new SarprasDetail();
        $sarpras_masuk->user_id = $request->user_id;
        $sarpras_masuk->sarpras_id = $request->sarpras;
        $sarpras_masuk->tanggal = $request->tanggal;
        $sarpras_masuk->jenis = "masuk";
        $sarpras_masuk->jumlah = $request->jumlah;
        $sarpras_masuk->keterangan = $request->keterangan;
        $sarpras_masuk->save();

        $sarpras = Sarpras::where('id', $request->sarpras)->first();
        Sarpras::where('id', $request->sarpras)
            ->update([
                'jumlah' => $sarpras->jumlah + $request->jumlah
            ]);

        return redirect('/sarpras_masuk')->with(['success' => 'Berhasil simpan data']);
    }
    public function show($id)
    {
        $sarpras_masuk = SarprasDetail::where('id', $id)->first();

        return view('back.sarpras_masuk.show', compact('sarpras_masuk'));
    }
    public function update(Request $request, $id)
    {
        $sarpras_id = $request->input('sarpras_id');
        $tanggal = $request->input('tanggal');
        $jumlah_b = $request->input('jumlah');
        $old_jumlah = $request->input('old_jumlah');
        $keterangan = $request->input('keterangan');

        $sarpras = Sarpras::where('id', $sarpras_id)->first();
        $jumlah_a = $sarpras->jumlah - $old_jumlah;
        $jumlah_c = $jumlah_a + $jumlah_b;

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

        return redirect('/sarpras_masuk')->with(['success' => 'Berhasil mengubah data']);
    }
    public function destroy($id)
    {
        $sarpras_masuk = SarprasDetail::where('id', $id)->first();
        $sarpras = Sarpras::where('id', $sarpras_masuk->sarpras_id)->first();
        $jumlah = $sarpras->jumlah - $sarpras_masuk->jumlah;

        Sarpras::where('id', $sarpras->id)
            ->update([
                'jumlah' => $jumlah
            ]);

        SarprasDetail::destroy($id);

        return response(['success_message' => 'berhasil hapus data']);
    }
}
