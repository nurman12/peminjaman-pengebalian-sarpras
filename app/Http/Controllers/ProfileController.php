<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Validasi;
use App\Models\Pengembalian;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {
                $permohonan = Validasi::where('user_id', Auth::user()->id)->where('status', 0)->orWhere('status', 3)->get();
                $peminjaman = Pengembalian::where('user_id', Auth::user()->id)->whereNotIn('status', [1])->get();
                $pengembalian = Pengembalian::where('user_id', Auth::user()->id)->where('status', 1)->get();

                $rating = Rating::where('user_id', Auth::user()->id)->first();
                if ($rating) {

                    $jumlah = count(Rating::where('user_id', Auth::user()->id)->get());
                    $star = Rating::where('user_id', Auth::user()->id)->pluck('penilaian')->sum();

                    $rate = $star / $jumlah;
                    if (strlen($rate) == 1) {
                        $rate = number_format($rate, 1);
                    }
                } else {
                    $jumlah = 0;
                    $rate = 0;
                }

                return view('front.profile.index', compact('permohonan', 'peminjaman', 'pengembalian', 'rate', 'jumlah'));
            } else {
                return view('back.profile.index');
            }
        } else {
            return abort(403);
        }
    }
    public function update(Request $request, $id)
    {
        if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {
            $nama = $request->name;
            $email = $request->email;
            $no_telp = $request->no_telp;

            $cek_email = User::where('email', $email)->whereNotIn('id', [$id])->first();
            $cek_telp = User::where('no_telp', $no_telp)->whereNotIn('id', [$id])->first();

            if (is_null($nama) && is_null($email) && is_null($no_telp)) {
                return response()->json(
                    [
                        'error_nama' => 'nama tidak boleh kosong',
                        'error_email' => 'email tidak boleh kosong',
                        'error_no_telp' => 'nomer tidak boleh kosong'
                    ]
                );
            } elseif (is_null($nama) && is_null($email)) {
                return response()->json(
                    [
                        'error_nama' => 'nama tidak boleh kosong',
                        'error_email' => 'email tidak boleh kosong',
                    ]
                );
            } elseif (is_null($email) && is_null($no_telp)) {
                return response()->json(
                    [
                        'error_email' => 'email tidak boleh kosong',
                        'error_no_telp' => 'nomer tidak boleh kosong'
                    ]
                );
            } elseif (is_null($no_telp) && is_null($nama)) {
                return response()->json(
                    [
                        'error_nama' => 'nama tidak boleh kosong',
                        'error_no_telp' => 'nomer tidak boleh kosong'
                    ]
                );
            } elseif (is_null($nama)) {
                return response()->json(['error_nama' => 'nama tidak boleh kosong']);
            } elseif (is_null($email)) {
                return response()->json(['error_email' => 'email tidak boleh kosong']);
            } elseif (is_null($no_telp)) {
                return response()->json(['error_no_telp' => 'nomer tidak boleh kosong']);
            } elseif ($cek_telp != null && $cek_email != null) {
                return response()->json(
                    [
                        'error_email' => 'email sudah terdaftar',
                        'error_no_telp' => 'nomor sudah terdaftar'
                    ]
                );
            } elseif ($cek_email) {
                return response()->json([
                    'error_email' => 'email sudah terdaftar'
                ]);
            } elseif ($cek_telp) {
                return response()->json([
                    'error_no_telp' => 'nomor sudah terdaftar'
                ]);
            }

            User::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'kota' => $request->kota,
                    'no_telp' => $request->no_telp
                ]);

            if ($request->file('photo')) {
                if ($request->old_photo) {
                    Storage::delete($request->old_photo);
                }
                User::where('id', $id)
                    ->update([
                        'photo_profile' => $request->file('photo')->store('photo')
                    ]);
            }


            return response()->json(['success_message' => 'berhasil update biodata']);
        } else {
            $request->validate([
                'nama' => 'required',
                'email' => 'required',
                'nim_nidn' => 'required',
                'photo_profile' => 'image|file|max:8192'
            ]);
            User::where('id', $id)
                ->update([
                    'name' => $request->nama,
                    'email' => $request->email,
                    'nim_nidn' => $request->nim_nidn,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'rt' => $request->rt,
                    'rw' => $request->rw,
                    'desa' => $request->desa,
                    'kota' => $request->kota,
                    'no_telp' => $request->no_telp
                ]);
            if ($request->file('photo_profile')) {
                Storage::delete($request->old_photo);
                User::where('id', $id)
                    ->update([
                        'photo_profile' => $request->file('photo_profile')->store('photo')
                    ]);
            }
            return redirect('/edit')->with(['success' => 'Berhasil mengubah profil']);
        }
    }
    public function password(Request $request)
    {
        if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {

            $request->validate([
                'old_password' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]);

            if (Hash::check($request->old_password, Auth::user()->password)) {
                Auth::user()->update([
                    'password' => bcrypt($request->password)
                ]);
                User::where('id', Auth::user()->id)
                    ->update([
                        'password_tidack_enkripsi' => $request->password
                    ]);
                return response()->json([
                    'success_message' => 'Berhasil ubah password'
                ]);
            } else {
                return response()->json([
                    'error_message' => 'Password yang dimasukkan salah'
                ]);
            }
        } else {
            $request->validate([
                'old_password' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]);

            if (Hash::check($request->old_password, Auth::user()->password)) {
                Auth::user()->update([
                    'password' => bcrypt($request->password)
                ]);
                User::where('id', Auth::user()->id)
                    ->update([
                        'password_tidack_enkripsi' => $request->password
                    ]);
                return redirect('/profile')->with(['success' => 'Berhasil mengubah password']);
            } else {
                return view('back.profile.index')->withErrors(['old_password' => 'Password yang anda masukkan salah']);
            }
        }
    }
}
