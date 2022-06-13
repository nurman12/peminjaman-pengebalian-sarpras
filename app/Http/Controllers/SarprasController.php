<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SarprasController extends Controller
{
    public function index()
    {
        $sarpras = Sarpras::orderBy('jenis', 'asc')->get();

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

        $filename = time() . '.' . request()->photo->getClientOriginalExtension();
        request()->photo->move(public_path('storage/sarpras'), $filename);

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
        $sarpras->photo =  $filename;
        // $sarpras->photo =  $request->file('photo')->store('sarpras');
        $sarpras->save();

        return redirect('/sarpras');
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

            $filename = time() . '.' . request()->photo->getClientOriginalExtension();
            request()->photo->move(public_path('storage/sarpras'), $filename);

            unlink(public_path('storage/sarpras/' . $request->old_photo));

            Sarpras::where('id', $id)
                ->update([
                    'photo' => $filename
                ]);
        }
        return redirect('/sarpras');
    }
    public function destroy(Request $request, $id)
    {
        unlink(public_path('storage/sarpras/' . $request->old_photo));
        Sarpras::destroy($id);

        return redirect('/sarpras');
    }
}
