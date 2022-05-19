<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\SarprasKeluar;
use App\Models\SarprasMasuk;
use App\Models\User;
use Illuminate\Http\Request;

class SarprasKeluarController extends Controller
{
    public function index()
    {
        // $user = User::where('roles', 'Mahasiswa')->orWhere('roles', 'Dosen')->get();
        // dd($user);
        $sarpras_keluar = SarprasKeluar::whereNotIn('user_id', User::where('roles', 'Mahasiswa')->orWhere('roles', 'Dosen')->get('id'))
            ->whereNotIn('sarpras_id', [0])->get();

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
        $sarpras_keluar = SarprasKeluar::where('id', $id)->first();

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
        $sarpras_keluar = new SarprasKeluar();
        $sarpras_keluar->user_id = $request->user_id;
        $sarpras_keluar->sarpras_id = $request->sarpras;
        $sarpras_keluar->tanggal_keluar = $request->tanggal;
        $sarpras_keluar->jumlah = $request->jumlah;
        $sarpras_keluar->keterangan = $request->keterangan;
        $sarpras_keluar->save();

        $sarpras = Sarpras::where('id', $request->sarpras)->first();
        Sarpras::where('id', $request->sarpras)
            ->update([
                'jumlah' => $sarpras->jumlah - $request->jumlah
            ]);

        $sarpras_keluar_id = SarprasKeluar::all()->max();

        $sarpras_detail = new SarprasDetail();
        $sarpras_detail->sarpras_id = $request->sarpras;
        $sarpras_detail->sarpras_masuk_id = 10;
        $sarpras_detail->sarpras_keluar_id = $sarpras_keluar_id->id;
        $sarpras_detail->save();

        $cek = SarprasMasuk::where('id', 10)->where('keterangan', 'untuk grafik')->first();
        if (is_null($cek)) {
            $sarpras_masuk = new SarprasMasuk();
            $sarpras_masuk->id = 10;
            $sarpras_masuk->user_id = 0;
            $sarpras_masuk->draft_id = 0;
            $sarpras_masuk->sarpras_id = 0;
            $sarpras_masuk->tanggal_masuk = date('y-m-d');
            $sarpras_masuk->jumlah = 0;
            $sarpras_masuk->keterangan = 'untuk grafik';
            $sarpras_masuk->save();
        }

        return redirect('/sarpras_keluar');
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

        SarprasKeluar::where('id', $id)
            ->update([
                'tanggal_keluar' => $tanggal,
                'jumlah' => $jumlah_b
            ]);

        $sarpras_keluar = SarprasKeluar::whereNotIn('user_id', User::where('roles', 'Mahasiswa')->orWhere('roles', 'Dosen')->get('id'))->get();

        return view('back.sarpras_keluar.table', compact('sarpras_keluar'));
    }
    public function destroy($id)
    {
        $sarpras_keluar = SarprasKeluar::where('id', $id)->first();
        $sarpras = Sarpras::where('id', $sarpras_keluar->sarpras_id)->first();
        $jumlah = $sarpras->jumlah + $sarpras_keluar->jumlah;

        Sarpras::where('id', $sarpras->id)
            ->update([
                'jumlah' => $jumlah
            ]);

        SarprasKeluar::destroy($id);

        SarprasDetail::where('sarpras_keluar_id', $sarpras_keluar->id)->delete();

        return redirect('/sarpras_keluar');
    }
}
