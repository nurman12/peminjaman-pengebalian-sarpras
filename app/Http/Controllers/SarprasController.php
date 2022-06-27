<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SarprasController extends Controller
{
    public function index()
    {
        $sarpras = Sarpras::orderBy('created_at', 'desc')->get();

        return view('back.sarpras.index', compact('sarpras'));
    }
    public function create()
    {
        return view('back.sarpras.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'photo' => 'required|image|file|max:8192'
        ]);

        $sarpras = new Sarpras();
        $sarpras->jenis = $request->jenis;
        if ($request->jenis == 'Ruangan') {
            $sarpras->kategori = implode(', ', $request->kategori_rgn);
        } elseif ($request->jenis == 'Barang') {
            $sarpras->kategori = implode(', ', $request->kategori_brg);
        }
        $sarpras->nama = $request->nama;
        $sarpras->jumlah = 0;
        $sarpras->deskripsi = $request->deskripsi;
        $sarpras->photo =  $request->file('photo')->store('sarpras');
        $sarpras->save();

        return redirect('/sarpras')->with(['success' => 'Berhasil simpan data']);
    }
    public function show($id)
    {
        $sarpras = Sarpras::where('id', $id)->first();

        return view('back.sarpras.show', compact('sarpras'));
    }
    public function edit($id)
    {
        $sarpras = Sarpras::where('id', $id)->first();

        return view('back.sarpras.edit', compact('sarpras'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required',
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'photo' => 'image|file|max:8192'
        ]);
        Sarpras::where('id', $id)
            ->update([
                'jenis' => $request->jenis,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi
            ]);
        if ($request->jenis == 'Ruangan') {
            Sarpras::where('id', $id)
                ->update([
                    'kategori' => implode(', ', $request->kategori_rgn)
                ]);
        } elseif ($request->jenis == 'Barang') {
            Sarpras::where('id', $id)
                ->update([
                    'kategori' => implode(', ', $request->kategori_brg)
                ]);
        }
        if ($request->file('photo')) {
            Storage::delete($request->old_photo);
            Sarpras::where('id', $id)
                ->update([
                    'photo' => $request->file('photo')->store('sarpras')
                ]);
        }

        return redirect('/sarpras')->with(['success' => 'Berhasil ubah data']);
    }
    public function destroy(Request $request, $id)
    {
        $cek = Draft::where('sarpras_id', $id)->first();
        $ceks = SarprasDetail::where('sarpras_id', $id)->first();
        if ($cek != null || $ceks != null) {

            return response(['error_message' => 'sarpras ini memiliki relasi ke tabel lain']);
        } else {
            Storage::delete($request->photo);

            Sarpras::destroy($id);

            return response(['success_message' => 'berasil menghapus sarpras']);
        }
    }
    public function delete(Request $request, $id)
    {
        Draft::where('sarpras_id', $id)->delete();
        SarprasDetail::where('sarpras_id', $id)->delete();

        Storage::delete($request->photo);

        Sarpras::destroy($id);
        return response(['success_messages' => 'berasil menghapus sarpras']);
    }
}
