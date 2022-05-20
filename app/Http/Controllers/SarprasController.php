<?php

namespace App\Http\Controllers;

use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\SarprasKeluar;
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
        $sarpras->save();

        return redirect('/sarpras');
    }
    public function show($id)
    {
        $sarpras = Sarpras::where('id', $id)->first();
        // $sarpras_detail = DB::table('sarpras_detail')
        //     // $sarpras_detail = SarprasDetail::whereNull('draft_id')
        //     ->join('sarpras_masuk', 'sarpras_masuk.id', '=', 'sarpras_detail.sarpras_masuk_id')->where('sarpras_masuk.draft_id', '=', NULL)
        //     // ->join('sarpras_keluar', 'sarpras_keluar.id', '=', 'sarpras_detail.sarpras_keluar_id')->where('sarpras_keluar.draft_id', '=', NULL)
        //     ->select([
        //         // DB::raw('sum(sarpras_keluar.jumlah) as jumlah_k'),
        //         DB::raw('sum(sarpras_masuk.jumlah) as jumlah_m'),
        //         DB::raw('MONTH(sarpras_detail.created_at) as bulan'),
        //         DB::raw('YEAR(sarpras_detail.created_at) as tahun')
        //     ])->groupBy(['bulan', 'tahun'])->get()->toArray();
        // dd($sarpras_detail);
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
