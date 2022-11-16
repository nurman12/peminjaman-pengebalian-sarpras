<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Draft;
use App\Models\Pengembalian;
use App\Models\Rating;
use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PenggunaController extends Controller
{
    public function index()
    {
        $bmn = User::where('roles', 'BMN')->orderBy('created_at', 'desc')->get()->toArray();
        $koor = User::where('roles', 'Koordinator')->orderBy('created_at', 'desc')->get()->toArray();
        $ktu = User::where('roles', 'KTU')->orderBy('created_at', 'desc')->get()->toArray();
        $mhs = User::where('roles', 'Mahasiswa')->orWhere('roles', 'Dosen')->orderBy('created_at', 'desc')->get()->toArray();
        $users = array_merge($koor, $ktu, $bmn, $mhs);

        return view('back.pengguna.index', compact('users'));
    }
    public function create()
    {
        return view('back.pengguna.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nim_nidn' => ['required', 'integer', 'min:6', 'unique:users'],
            'roles' => 'required',
            'photo_profile' => 'image|file|max:8192'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->password_tidack_enkripsi = $request->password;
        $user->nim_nidn = $request->nim_nidn;
        $user->roles = $request->roles;
        $user->status_mhs = $request->status_mhs;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->alamat = $request->alamat;
        $user->rt = $request->rt;
        $user->rw = $request->rw;
        $user->desa = $request->desa;
        $user->kota = $request->kota;
        $user->no_telp = $request->no_telp;
        if ($request->file('photo_profile')) {
            $user->photo_profile = $request->file('photo_profile')->store('photo');
        }
        $user->save();

        return redirect('/pengguna')->with(['success' => 'Berhasil simpan data']);
    }
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $permohonan = Validasi::where('user_id', $id)->where('status', 0)->get();
        $peminjaman = Pengembalian::where('user_id', $id)->whereIn('status', [0, 2])->get();
        $pengembalian = Pengembalian::where('user_id', $id)->where('status', 1)->get();
        $rating = Rating::where('user_id', $id)->first();
        if ($rating) {

            $jumlah = count(Rating::where('user_id', $id)->get());
            $star = Rating::where('user_id', $id)->pluck('penilaian')->sum();

            $rate = $star / $jumlah;
            if (strlen($rate) == 1) {
                $rate = number_format($rate, 1);
            }
        } else {
            $jumlah = 0;
            $rate = 0;
        }

        return view('back.pengguna.show', compact('user', 'permohonan', 'peminjaman', 'pengembalian', 'jumlah', 'rate'));
    }
    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        if ($user->roles == 'BMN') {
            return abort(403);
        }

        return view('back.pengguna.edit', ['user' => $user]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'nim_nidn' => ['required', 'integer', 'min:6'],
            'photo_profile' => 'image|file|max:8192'
        ]);
        User::where('id', $id)
            ->update([
                'name' => $request->nama,
                'email' => $request->email,
                'nim_nidn' => $request->nim_nidn,
                'roles' => $request->roles,
                'status_mhs' => $request->status_mhs,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'desa' => $request->desa,
                'kota' => $request->kota,
                'no_telp' => $request->no_telp,
            ]);
        if ($request->file('photo_profile')) {
            Storage::delete($request->old_photo);
            User::where('id', $id)
                ->update([
                    'photo_profile' => $request->file('photo_profile')->store('photo')
                ]);
        }

        return redirect('/pengguna')->with(['success' => 'Berhasil mengubah data']);
    }
    public function destroy(Request $request, $id)
    {
        $cek = Validasi::where('user_id', $id)->first();
        $ceks = Draft::where('user_id', $id)->first();

        if ($cek != null || $ceks != null) {

            return response(['error_message' => 'pengguna ini memiliki relasi ke tabel lain']);
        } else {
            if ($request->photo) {
                Storage::delete($request->photo);
            }

            User::destroy($id);

            return response(['success_message' => 'berasil menghapus pengguna']);
        }
    }
    public function delete(Request $request, $id)
    {
        // restore qty
        $draft = Draft::where('user_id', $id)->whereNotNull('validasi_id')->get();
        foreach ($draft as $data) {
            $sarpras = Sarpras::where('id', $data->sarpras_id)->first();

            $jumlah = $sarpras->jumlah + $data->qty;

            Sarpras::where('id', $data->sarpras_id)
                ->update([
                    'jumlah' => $jumlah
                ]);
        }
        // delete
        Draft::where('user_id', $id)->delete();
        SarprasDetail::where('user_id', $id)->delete();
        Validasi::where('user_id', $id)->delete();
        Pengembalian::where('user_id', $id)->delete();
        Rating::where('user_id', $id)->delete();

        if ($request->photo) {
            Storage::delete($request->photo);
        }

        User::destroy($id);

        return response(['success_messages' => 'berasil menghapus pengguna']);
    }
    public function password(Request $request, $id)
    {
        $request->validate([
            // 'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        // $user = User::where('id', $id)->first();

        // if (Hash::check($request->old_password, $user->password)) {
        User::where('id', $id)
            ->update([
                'password' => bcrypt($request->password),
                'password_tidack_enkripsi' => $request->password
            ]);

        // User::where('id', $id)
        //     ->update([
        //         'password_tidack_enkripsi' => $request->password
        //     ]);
        return redirect('/pengguna' . '/' . $id . '/edit')->with(['success' => 'Berhasil mengubah data']);;
        // } else {
        //     return view('back.pengguna.edit', compact('user'))->withErrors(['old_password' => 'Password yang anda masukkan salah']);
        // }
    }
    public function userexport()
    {
        return Excel::download(new UsersExport, 'pengguna.xlsx');
    }
    public function userimport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file')->store('import');
        $import = new UsersImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return redirect('/pengguna')->withfailures($import->failures());
        }

        return redirect('/pengguna')->with(['success' => 'Berhasil import data']);
    }
}
