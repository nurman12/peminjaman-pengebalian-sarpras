<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\SarprasKeluar;
use App\Models\SarprasMasuk;
use App\Models\User;
use Illuminate\Http\Request;

class SarprasMasukController extends Controller
{
    public function index()
    {
        $sarpras_masuk = SarprasMasuk::whereNotIn('user_id', User::where('roles', 'Mahasiswa')->orWhere('roles', 'Dosen')->get('id'))
            ->whereNotIn('sarpras_id', [0])->get();

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
        $sarpras_masuk = new SarprasMasuk();
        $sarpras_masuk->user_id = $request->user_id;
        $sarpras_masuk->sarpras_id = $request->sarpras;
        $sarpras_masuk->tanggal_masuk = $request->tanggal;
        $sarpras_masuk->jumlah = $request->jumlah;
        $sarpras_masuk->keterangan = $request->keterangan;
        $sarpras_masuk->save();

        $sarpras = Sarpras::where('id', $request->sarpras)->first();
        Sarpras::where('id', $request->sarpras)
            ->update([
                'jumlah' => $sarpras->jumlah + $request->jumlah
            ]);

        $sarpras_masuk_id = SarprasMasuk::all()->max();

        $sarpras_detail = new SarprasDetail();
        $sarpras_detail->sarpras_id = $request->sarpras;
        $sarpras_detail->sarpras_masuk_id = $sarpras_masuk_id->id;
        $sarpras_detail->sarpras_keluar_id = 10;
        $sarpras_detail->save();

        $cek = SarprasKeluar::where('id', 10)->where('keterangan', 'untuk grafik')->first();
        if (is_null($cek)) {
            $sarpras_keluar = new SarprasKeluar();
            $sarpras_keluar->id = 10;
            $sarpras_keluar->user_id = 0;
            $sarpras_keluar->draft_id = 0;
            $sarpras_keluar->sarpras_id = 0;
            $sarpras_keluar->tanggal_keluar = date('y-m-d');
            $sarpras_keluar->jumlah = 0;
            $sarpras_keluar->hilang = 0;
            $sarpras_keluar->keterangan = 'untuk grafik';
            $sarpras_keluar->save();
        }

        return redirect('/sarpras_masuk');
    }
    public function show($id)
    {
        $sarpras_masuk = SarprasMasuk::where('id', $id)->first();

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

        SarprasMasuk::where('id', $id)
            ->update([
                'tanggal_masuk' => $tanggal,
                'jumlah' => $jumlah_b
            ]);

        $sarpras_masuk = SarprasMasuk::whereNotIn('user_id', User::where('roles', 'Mahasiswa')->orWhere('roles', 'Dosen')->get('id'))->get();

        return view('back.sarpras_masuk.table', compact('sarpras_masuk'));
    }
    public function destroy($id)
    {
        $sarpras_masuk = SarprasMasuk::where('id', $id)->first();
        $sarpras = Sarpras::where('id', $sarpras_masuk->sarpras_id)->first();
        $jumlah = $sarpras->jumlah - $sarpras_masuk->jumlah;

        Sarpras::where('id', $sarpras->id)
            ->update([
                'jumlah' => $jumlah
            ]);

        SarprasMasuk::destroy($id);

        SarprasDetail::where('sarpras_masuk_id', $sarpras_masuk->id)->delete();

        return redirect('/sarpras_masuk');
    }
}
