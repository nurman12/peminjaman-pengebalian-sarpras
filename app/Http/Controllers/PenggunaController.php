<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::all();

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

        return redirect('/pengguna');
    }
    public function show($id)
    {
        $user = User::where('id', $id)->first();
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

        return view('back.pengguna.show', ['user' => $user, 'rate' => $rate, 'jumlah' => $jumlah]);
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
        return redirect('/pengguna');
    }
    public function destroy(Request $request, $id)
    {
        Storage::delete($request->old_photo);
        User::destroy($id);

        return redirect('/pengguna');
    }
    public function password(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::where('id', $id)->first();

        if (Hash::check($request->old_password, $user->password)) {
            User::where('id', $id)
                ->update([
                    'password' => bcrypt($request->password)
                ]);

            User::where('id', $id)
                ->update([
                    'password_tidack_enkripsi' => $request->password
                ]);
            return redirect('/pengguna' . '/' . $id . '/edit');
        } else {
            return view('back.pengguna.edit', compact('user'))->withErrors(['old_password' => 'Password yang anda masukkan salah']);
        }
    }
    public function userexport()
    {
        if (Auth::user()) {
            if (Auth::user()->roles != 'BMN') {
                return redirect('/deshboard');
            }
            return Excel::download(new UsersExport, 'pengguna.xlsx');
        } else {
            return redirect('/deshboard');
        }
    }
    public function userimport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);
        if (Auth::user()->roles != 'BMN') {
            return redirect('/dashboard');
        }
        $file = $request->file;

        Excel::import(new UsersImport, $file);

        return redirect('/pengguna');
    }
}
