<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Rating;
use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\User;
use App\Models\Validasi;
use App\Models\SarprasKeluar;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ValidasiController extends Controller
{
    public function index()
    {
        $validasi = Validasi::orderBy('tanggal_start', 'asc')->get();

        return view('back.validasi.index', compact('validasi'));
    }
    public function store(Request $request)
    {
        // dd($request->sampai);
        $request->validate([
            'keperluan' => 'required',
            'proposal' => 'required|mimes:pdf,doc,docx',
            'tanggal' => 'required|date_format:Y-m-d H:i',
            'sampai'  => 'required|date_format:Y-m-d H:i'
        ]);

        $draft = Draft::where('user_id', $request->user_id)->where('validasi_id', 0)->get();

        // cek draft tidak boleh kosong 
        if ($draft->count() == 0) {
            return redirect('/draft')->with('error', 'Jumlah draft tidak boleh kosong!');
        } else {

            // cek apakah stok ketersediaan melebihi atau sama dengan jumlah yang ingin di pinjam 
            foreach ($draft as $item) {

                $sarpras = Sarpras::where('id', $item->sarpras_id)->first();
                if ($sarpras->jumlah < $item->qty) {
                    return redirect('/draft')->with('error', "Jumlah " . $sarpras->nama . " yang tersedia berjumlah " . $sarpras->jumlah);
                }
            }

            $validasi = new Validasi();
            $validasi->user_id = $request->user_id;
            $validasi->keperluan = $request->keperluan;
            $validasi->proposal = $request->file('proposal')->store('proposal');
            $validasi->tanggal_start = $request->tanggal . date(':s');
            $validasi->tanggal_finish = $request->sampai . date(':s');

            $validasi->save();

            $id = Validasi::all()->max();

            Draft::where('user_id', $request->user_id)
                ->where('validasi_id', 0)
                ->update([
                    'user_id' => $request->user_id,
                    'validasi_id' => $id->id
                ]);

            // mengurangi jumlah sarpras yang akan di pinjam 
            foreach ($draft as $item) {
                $sarpras = Sarpras::where('id', $item->sarpras_id)->first();

                Sarpras::where('id', $item->sarpras_id)
                    ->update([
                        'jumlah' => $sarpras->jumlah - $item->qty
                    ]);

                $sarpras_keluar =  new SarprasKeluar();
                $sarpras_keluar->user_id = $item->user_id;
                $sarpras_keluar->draft_id = $item->id;
                $sarpras_keluar->sarpras_id = $item->sarpras_id;
                $sarpras_keluar->tanggal_keluar = date('Y-m-d');
                $sarpras_keluar->jumlah = $item->qty;
                $sarpras_keluar->save();

                // $sarpras_keluar_id = SarprasKeluar::all()->max();

                // $sarpras_detail =  new SarprasDetail();
                // $sarpras_detail->sarpras_id = $item->sarpras_id;
                // $sarpras_detail->sarpras_keluar_id = $sarpras_keluar_id->id;
                // $sarpras_detail->save();
            }

            $user = User::where('id', $request->user_id)->first();
            $ktu = User::where('roles', 'KTU')->first();

            $payload = [
                "data" => [
                    [
                        'phone' => $user->no_telp,
                        'message' => 'Yea! Permohonan peminjaman sarpras berhasil \n \n Nama : ' . $user->name . '\n Keperluan : ' . $request->keperluan . '\n Mulai tgl : ' . $request->tanggal . '\n Sampai tgl : ' . $request->sampai . '\n Info lebih lanjut \n  https://127.0.0.1:8000/validasi/' . $id->id,
                        'secret' => false, // or true
                        'priority' => false, // or true
                    ],
                    [
                        'phone' => $ktu->no_telp,
                        'message' => 'try message 2',
                        'secret' => false, // or true
                        'priority' => false, // or true
                    ]
                ]
            ];

            $curl = curl_init();
            $token = env('WABLAS_API_WHATSAPP');
            $domain = env('SERVER_WABLAS');

            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array(
                    "Authorization: $token",
                    "Content-Type: application/json"
                )
            );
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($curl, CURLOPT_URL, "$domain/api/v2/send-bulk/text");
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            $result = curl_exec($curl);
            curl_close($curl);

            return redirect('/draft')->with('success', 'Berhasil mengirim permohonan pinjaman!');
        }
    }
    public function add_sarpras($id)
    {
        $draft = Draft::where('validasi_id', $id)->pluck('sarpras_id');
        $sarpras = Sarpras::whereNotIn('id', $draft)->get();

        return view('back.validasi.add_sarpras', compact('id', 'sarpras'));
    }
    public function store_add_sarpras(Request $request)
    {
        $id = $request->input('validasi_id');
        $sarpras_id = $request->input('sarpras_id');
        $qty = $request->input('qty');

        if ($qty == 0) {
            return response()->json(['error_message' => 'jumlah tidak boleh kosong!']);
        }

        $validasi = Validasi::where('id', $id)->first();
        $sarpras = Sarpras::where('id', $sarpras_id)->first();

        $jumlah = $sarpras->jumlah - $qty;

        Sarpras::where('id', $sarpras_id)
            ->update([
                'jumlah' => $jumlah
            ]);

        $draft = new Draft();
        $draft->user_id = $validasi->user_id;
        $draft->sarpras_id = $sarpras_id;
        $draft->qty = $qty;
        $draft->validasi_id = $id;
        $draft->save();

        $draft = Draft::where('validasi_id', $id)->pluck('sarpras_id');
        $sarpras = Sarpras::whereNotIn('id', $draft)->get();

        return view('back.validasi.list_sarpras', compact('id', 'sarpras'));
    }
    public function show($id)
    {
        if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {
            $validasi = Validasi::where('id', $id)->first();

            return view('front.profile.show_permohonan', compact('validasi'));
        } else {
            $validasi = Validasi::where('id', $id)->first();

            if ($validasi->notif == 0) {
                Validasi::where('id', $id)
                    ->update([
                        'notif' => 1
                    ]);
            }

            $rating = Rating::where('user_id', $validasi->user_id)->first();
            if ($rating) {

                $jumlah = count(Rating::where('user_id', $validasi->user_id)->get());
                $star = Rating::where('user_id', $validasi->user_id)->pluck('penilaian')->sum();

                $rate = $star / $jumlah;
                if (strlen($rate) == 1) {
                    $rate = number_format($rate, 1);
                }
            } else {
                $jumlah = 0;
                $rate = 0;
            }

            return view('back.validasi.show', compact('validasi', 'jumlah', 'rate'));
        }
    }
    public function edit($id)
    {
        if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {
            $validasi = Validasi::where('id', $id)->first();

            //jika user lain mengakses data dengan mengubah url akan di redirect
            if ($validasi->user_id != Auth::user()->id) {
                return abort(403);
            }

            return view('front.profile.edit', compact('validasi'));
        } elseif (Auth::user()->roles == 'BMN') {
            $validasi = Validasi::where('id', $id)->first();

            return view('back.validasi.edit', compact('validasi'));
        } else {
            return abort(404);
        }
    }
    public function update(Request $request, $id)
    {
        $validasi = Validasi::where('id', $id)->first();

        $draft = Draft::where('validasi_id', $id)->get();

        if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {

            $request->validate([
                'keperluan' => 'required',
                'proposal' => 'mimes:pdf,doc,docx',
                'tanggal' => 'required|date_format:Y-m-d H:i',
                'sampai' => 'required|date_format:Y-m-d H:i'
            ]);



            Validasi::where('id', $id)
                ->update([
                    'keperluan' => $request->keperluan,
                    'tanggal_start' => $request->tanggal . date(':s'),
                    'tanggal_finish' => $request->sampai . date(':s')
                ]);

            if ($request->file('proposal')) {
                Storage::delete($request->old_proposal);
                Validasi::where('id', $id)
                    ->update([
                        'proposal' => $request->file('proposal')->store('proposal')
                    ]);
            }

            $payload = [
                "data" => [
                    [
                        'phone' => Auth::user()->no_telp,
                        'message' => 'Yea! Ubah peminjaman sarpras berhasil \n \n Nama : ' . Auth::user()->name . '\n Keperluan : ' . $request->keperluan . '\n Mulai tgl : ' . $request->tanggal . '\n Sampai tgl : ' . $request->sampai . '\n Info lebih lanjut \n https://127.0.0.1:8000/validasi/' . $id,
                        'secret' => false, // or true
                        'priority' => false, // or true
                    ]
                ]
            ];

            $curl = curl_init();
            $token = env('WABLAS_API_WHATSAPP');
            $domain = env('SERVER_WABLAS');

            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array(
                    "Authorization: $token",
                    "Content-Type: application/json"
                )
            );
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($curl, CURLOPT_URL, "$domain/api/v2/send-bulk/text");
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            $result = curl_exec($curl);
            curl_close($curl);

            return redirect('/profile')->with(['status' => 'Berhasil mengubah data']);
        } elseif ($request->sebelum_ktu) {
            Validasi::where('id', $id)
                ->update([
                    'validasi_ktu' => $request->sebelum_ktu,
                ]);

            if ($request->sebelum_ktu == 1) {
                Validasi::where('id', $id)
                    ->update([
                        'notif' => 0
                    ]);
            }

            if ($validasi->sebelum_ktu == 0 && $request->sebelum_ktu == 2) {
                // dari pending menjadi ditolak
                foreach ($draft as $data) {
                    $sarpras = Sarpras::where('id', $data->sarpras_id)->first();

                    Sarpras::where('id', $sarpras->id)
                        ->update([
                            'jumlah' => $sarpras->jumlah + $data->qty
                        ]);

                    Draft::where('id', $data->id)
                        ->update([
                            'qty' => 0
                        ]);
                }
            }

            return redirect('/belum_validasi');
        } elseif ($request->sebelum_koor) {
            Validasi::where('id', $id)
                ->update([
                    'validasi_koor' => $request->sebelum_koor
                ]);

            if ($request->sebelum_ktu == 1) {
                Validasi::where('id', $id)
                    ->update([
                        'notif' => 0
                    ]);
            }

            if ($validasi->validasi_koor == 0 && $request->sebelum_koor == 2) {
                // dari pending menjadi ditolak
                foreach ($draft as $data) {
                    $sarpras = Sarpras::where('id', $data->sarpras_id)->first();

                    Sarpras::where('id', $sarpras->id)
                        ->update([
                            'jumlah' => $sarpras->jumlah + $data->qty
                        ]);

                    Draft::where('id', $data->id)
                        ->update([
                            'qty' => 0
                        ]);
                }
            }

            return redirect('/belum_validasi');
        } elseif ($request->sebelum_bmn) {
            Validasi::where('id', $id)
                ->update([
                    'validasi_bmn' => $request->sebelum_bmn
                ]);

            if ($request->sebelum_ktu == 1) {
                Validasi::where('id', $id)
                    ->update([
                        'notif' => 0
                    ]);
            }

            if ($validasi->validasi_bmn == 0 && $request->sebelum_bmn == 2) {
                // dari pending menjadi ditolak
                foreach ($draft as $data) {
                    $sarpras = Sarpras::where('id', $data->sarpras_id)->first();

                    Sarpras::where('id', $sarpras->id)
                        ->update([
                            'jumlah' => $sarpras->jumlah + $data->qty
                        ]);

                    Draft::where('id', $data->id)
                        ->update([
                            'qty' => 0
                        ]);
                }
            }

            return redirect('/belum_validasi');
        } elseif ($request->sudah_ktu) {
            Validasi::where('id', $id)
                ->update([
                    'validasi_ktu' => $request->sudah_ktu,
                ]);

            if ($request->sudah_ktu == 1) {
                Validasi::where('id', $id)
                    ->update([
                        'notif' => 0
                    ]);
            }

            if ($validasi->validasi_ktu == 1 && $request->sudah_ktu == 2) {
                // dari disetujui menjadi ditolak
                foreach ($draft as $data) {
                    $sarpras = Sarpras::where('id', $data->sarpras_id)->first();

                    Sarpras::where('id', $sarpras->id)
                        ->update([
                            'jumlah' => $sarpras->jumlah + $data->qty
                        ]);

                    Draft::where('id', $data->id)
                        ->update([
                            'qty' => 0
                        ]);
                }
            } elseif ($validasi->validasi_ktu == 2 && $request->sudah_ktu == 1) {
                // dari ditolak menjadi disetujui
                foreach ($draft as $data) {
                    $sarpras = Sarpras::where('id', $data->sarpras_id)->first();

                    $sarpras_keluar = SarprasKeluar::where('draft_id', $data->id)->first();

                    Sarpras::where('id', $sarpras->id)
                        ->update([
                            'jumlah' => $sarpras->jumlah - $sarpras_keluar->jumlah
                        ]);

                    Draft::where('id', $data->id)
                        ->update([
                            'qty' => $sarpras_keluar->jumlah
                        ]);
                }
            }

            return redirect('/sudah_validasi');
        } elseif ($request->sudah_koor) {
            Validasi::where('id', $id)
                ->update([
                    'validasi_koor' => $request->sudah_koor
                ]);

            if ($request->sudah_koor == 1) {
                Validasi::where('id', $id)
                    ->update([
                        'notif' => 0
                    ]);
            }
            if ($validasi->validasi_koor == 1 && $request->sudah_koor == 2) {
                // dari disetujui menjadi ditolak
                foreach ($draft as $data) {
                    $sarpras = Sarpras::where('id', $data->sarpras_id)->first();

                    Sarpras::where('id', $sarpras->id)
                        ->update([
                            'jumlah' => $sarpras->jumlah + $data->qty
                        ]);

                    Draft::where('id', $data->id)
                        ->update([
                            'qty' => 0
                        ]);
                }
            } elseif ($validasi->validasi_koor == 2 && $request->sudah_koor == 1) {
                // dari ditolak menjadi disetujui
                foreach ($draft as $data) {
                    $sarpras = Sarpras::where('id', $data->sarpras_id)->first();

                    $sarpras_keluar = SarprasKeluar::where('draft_id', $data->id)->first();

                    Sarpras::where('id', $sarpras->id)
                        ->update([
                            'jumlah' => $sarpras->jumlah - $sarpras_keluar->jumlah
                        ]);

                    Draft::where('id', $data->id)
                        ->update([
                            'qty' => $sarpras_keluar->jumlah
                        ]);
                }
            }

            return redirect('/sudah_validasi');
        } elseif ($request->sudah_bmn) {

            Validasi::where('id', $id)
                ->update([
                    'validasi_bmn' => $request->sudah_bmn
                ]);

            if ($request->sudah_bmn == 1) {
                Validasi::where('id', $id)
                    ->update([
                        'notif' => 0
                    ]);
            }

            if ($validasi->validasi_bmn == 1 && $request->sudah_bmn == 2) {
                // dari disetujui menjadi ditolak
                foreach ($draft as $data) {
                    $sarpras = Sarpras::where('id', $data->sarpras_id)->first();

                    Sarpras::where('id', $sarpras->id)
                        ->update([
                            'jumlah' => $sarpras->jumlah + $data->qty
                        ]);

                    Draft::where('id', $data->id)
                        ->update([
                            'qty' => 0
                        ]);
                }
            } elseif ($validasi->validasi_bmn == 2 && $request->sudah_bmn == 1) {
                // dari ditolak menjadi disetujui
                foreach ($draft as $data) {
                    $sarpras = Sarpras::where('id', $data->sarpras_id)->first();

                    $sarpras_keluar = SarprasKeluar::where('draft_id', $data->id)->first();

                    Sarpras::where('id', $sarpras->id)
                        ->update([
                            'jumlah' => $sarpras->jumlah - $sarpras_keluar->jumlah
                        ]);

                    Draft::where('id', $data->id)
                        ->update([
                            'qty' => $sarpras_keluar->jumlah
                        ]);
                }
            }

            return redirect('/sudah_validasi');
        }
    }
    public function update_lanjut(Request $request, $id)
    {
        if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {

            $request->validate([
                'keperluan' => 'required',
                'proposal' => 'mimes:pdf,doc,docx',
                'tanggal' => 'required|date_format:Y-m-d H:i',
                'sampai' => 'required|date_format:Y-m-d H:i'
            ]);

            $draft_new = Draft::where('user_id', $request->user_id)->where('validasi_id', 0)->get();

            $draft_old = Draft::where('validasi_id', $id)->get();

            if ($draft_new->count() == 0) {
                return redirect('/draft')->with('error', 'Jumlah draft tidak boleh kosong!');
            } else {

                // cek apakah stok ketersediaan melebihi atau sama dengan jumlah yang ingin di pinjam 
                foreach ($draft_new as $item) {
                    $sarpras = Sarpras::where('id', $item->sarpras_id)->first();
                    if ($sarpras->jumlah < $item->qty) {
                        return redirect('/draft')->with('error', "Jumlah " . $sarpras->nama . " yang tersedia berjumlah " . $sarpras->jumlah);
                    }
                }

                /*------------------------------------------------------------- 
                |jumlah qty yang sudah ada dengan yang baru ditambahkan
                ---------------------------------------------------------------*/

                foreach ($draft_old as $item) {
                    foreach ($draft_new as $data) {
                        if ($item->sarpras_id === $data->sarpras_id) {
                            Draft::where('id', $item->id)
                                ->update([
                                    'qty' => $data->qty + $item->qty
                                ]);

                            SarprasKeluar::where('draft_id', $item->id)
                                ->update([
                                    'jumlah' => $data->qty + $item->qty
                                ]);
                        }
                    }
                }
                /*------------------------------------------------------------- 
                |lakukan hal sama tapi untuk menghapus jika ada jenis 
                |item yang sama jadi logikanya jumlah keduanya, 
                |jika sudah maka hapus id draft baru
                ---------------------------------------------------------------*/
                foreach ($draft_old as $item) {
                    foreach ($draft_new as $data) {
                        if ($item->sarpras_id == $data->sarpras_id) {
                            Draft::where('id', $data->id)->delete();
                        }
                    }
                }

                $cek = Draft::where('user_id', $request->user_id)->where('validasi_id', 0)->get();

                foreach ($cek as $item) {

                    $data_k = SarprasKeluar::where('draft_id', $item->id)->first();

                    if ($data_k == null) {
                        $sarpras_keluar = new SarprasKeluar();
                        $sarpras_keluar->user_id = $item->user_id;
                        $sarpras_keluar->draft_id = $item->id;
                        $sarpras_keluar->sarpras_id = $item->sarpras_id;
                        $sarpras_keluar->tanggal_keluar = date('Y-m-d');
                        $sarpras_keluar->jumlah = $item->qty;
                        $sarpras_keluar->save();

                        // $sarpras_keluar_id = SarprasKeluar::all()->max();

                        // $sarpras_detail = new SarprasDetail();
                        // $sarpras_detail->sarpras_id = $item->sarpras_id;
                        // $sarpras_detail->sarpras_keluar_id = $sarpras_keluar_id->id;
                        // $sarpras_detail->save();
                    }
                }

                Draft::where('user_id', $request->user_id)
                    ->where('validasi_id', 0)
                    ->update([
                        'validasi_id' => $id
                    ]);

                foreach ($draft_new as $item) {
                    $sarpras = Sarpras::where('id', $item->sarpras_id)->first();

                    Sarpras::where('id', $item->sarpras_id)
                        ->update([
                            'jumlah' => $sarpras->jumlah - $item->qty
                        ]);
                }

                Validasi::where('id', $id)
                    ->update([
                        'keperluan' => $request->keperluan,
                        'tanggal_start' => $request->tanggal . date(':s'),
                        'tanggal_finish' => $request->sampai . date(':s')
                    ]);

                if ($request->file('proposal')) {
                    Storage::delete($request->old_proposal);
                    Validasi::where('id', $id)
                        ->update([
                            'proposal' => $request->file('proposal')->store('proposal')
                        ]);
                }

                $payload = [
                    "data" => [
                        [
                            'phone' => Auth::user()->no_telp,
                            'message' => 'Yea! Ubah peminjaman sarpras berhasil \n \n Nama : ' . Auth::user()->name . '\n Keperluan : ' . $request->keperluan . '\n Mulai tgl : ' . $request->tanggal . '\n Sampai tgl : ' . $request->sampai . '\n Info lebih lanjut \n https://127.0.0.1:8000/validasi/' . $id,
                            'secret' => false, // or true
                            'priority' => false, // or true
                        ]
                    ]
                ];

                $curl = curl_init();
                $token = env('WABLAS_API_WHATSAPP');
                $domain = env('SERVER_WABLAS');

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                        "Content-Type: application/json"
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
                curl_setopt($curl, CURLOPT_URL, "$domain/api/v2/send-bulk/text");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                curl_close($curl);

                return redirect('/profile')->with(['status' => 'Berhasil mengubah data']);
            }
        }
    }
    public function update_peminjaman(Request $request, $id)
    {
        $request->validate([
            'keperluan' => 'required',
            'proposal' => 'mimes:pdf,doc,docx',
            'mulai' => 'required|date_format:Y-m-d H:i',
            'sampai'  => 'required|date_format:Y-m-d H:i'
        ]);

        $draft_qty = $request->qty;
        $draft_id = $request->draft_id;

        foreach ($draft_qty as $key => $data) {

            $draft = Draft::where('id', $draft_id[$key])->first();
            $sarpras = Sarpras::where('id', $draft->sarpras_id)->first();
            $jumlah = $sarpras->jumlah + $draft->qty - $data;

            Sarpras::where('id', $sarpras->id)
                ->update([
                    'jumlah' => $jumlah
                ]);
            Draft::where('id', $draft->id)
                ->update([
                    'qty' => $data
                ]);
        }
        Validasi::where('id', $id)
            ->update([
                'keperluan' => $request->keperluan,
                'tanggal_start' => $request->mulai . date(':s'),
                'tanggal_finish' => $request->sampai . date(':s')
            ]);

        if ($request->file('proposal')) {
            Storage::delete($request->old_proposal);
            Validasi::where('id', $id)
                ->update([
                    'proposal' => $request->file('proposal')->store('proposal')
                ]);
        }
        return redirect('/validasi/' . $id . '/edit');
    }
    public function destroy(Request $request, $id)
    {
        if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {

            $draft = Draft::where('validasi_id', $id)->get();

            foreach ($draft as $data) {
                $sarpras = Sarpras::where('id', $data->sarpras_id)->first();

                Sarpras::where('id', $data->sarpras_id)
                    ->update([
                        'jumlah' => $sarpras->jumlah + $data->qty
                    ]);
            }
            Storage::delete($request->proposal);
            Validasi::where('id', $id)->delete();

            return redirect('/profile')->with(['status' => 'Berhasil menghapus data']);
        } elseif (Auth::user()->roles == 'BMN') {

            $cek = Validasi::where('id', $id)
                ->where(
                    function ($query) {
                        return $query
                            ->where('validasi_ktu', 2)
                            ->orWhere('validasi_koor', 2)
                            ->orWhere('validasi_bmn', 2);
                    }
                )
                ->first();

            $draft = Draft::where('validasi_id', $id)->get();
            // jika pinjaman dengan kondisi disetujui/pending (disetujui/pending = masih memiliki qty | ditolak = tidak memiliki qty)
            if (!$cek) {
                foreach ($draft as $data) {

                    Sarpras::where('id', $data->sarpras->id)
                        ->update([
                            'jumlah' => $data->sarpras->jumlah + $data->sarpras_keluar->jumlah
                        ]);
                }
            }

            foreach ($draft as $item) {
                DB::table('draft')->where('id', $item->id)->delete();
                DB::table('sarpras_keluar')->where('draft_id', $item->id)->delete();
                // DB::table('sarpras_detail')->where('sarpras_keluar_id', $item->sarpras_keluar->id)->delete();
            }

            DB::table('validasi')->where('id', $id)->delete();

            return response()->json(['success_message' => 'Berhasil hapus permohonan pinjaman!']);
        }
    }
    public function destroy_sarpras($id)
    {
        $draft = Draft::where('id', $id)->first();
        $data = Draft::where('validasi_id', $draft->validasi_id)->get();
        $sarpras = Sarpras::where('id', $draft->sarpras_id)->first();
        if (count($data) <= 1) {
            return response()->json(['error_message' => 'Jumlah sarpras tidak boleh kurang dari 1 (satu)']);
        }

        $jumlah = $sarpras->jumlah + $draft->qty;

        Sarpras::where('id', $sarpras->id)
            ->update([
                'jumlah' => $jumlah
            ]);

        DB::table('draft')->where('id', $id)->delete();

        return response()->json(['success_message' => 'Berhasil hapus sarpras pada peminjaman']);
    }
    public function belum_validasi()
    {
        if (Auth::user()->roles == 'KTU') {
            $belum_validasi = Validasi::where('validasi_ktu', 0)->where('validasi_koor', 0)->where('validasi_bmn', 0)->get();
        } elseif (Auth::user()->roles == 'Koordinator') {
            $belum_validasi = Validasi::where('validasi_ktu', 1)->where('validasi_koor', 0)->where('validasi_bmn', 0)->get();
        } elseif (Auth::user()->roles == 'BMN') {
            $belum_validasi = Validasi::where('validasi_ktu', 1)->where('validasi_koor', 1)->where('validasi_bmn', 0)->get();
        }
        return view('back.validasi.belum', compact('belum_validasi'));
    }
    public function sudah_validasi()
    {
        if (Auth::user()->roles == 'KTU') {
            $setuju = Validasi::where('validasi_ktu', 1)->get();
            $tidak = Validasi::where('validasi_ktu', 2)->where('validasi_koor', 0)->where('validasi_bmn', 0)->get();
        } elseif (Auth::user()->roles == 'Koordinator') {
            $setuju = Validasi::where('validasi_ktu', 1)->where('validasi_koor', 1)->get();
            $tidak = Validasi::where('validasi_ktu', 1)->where('validasi_koor', 2)->where('validasi_bmn', 0)->get();
        } elseif (Auth::user()->roles == 'BMN') {
            $setuju = Validasi::where('validasi_ktu', 1)->where('validasi_koor', 1)->where('validasi_bmn', 1)->get();
            $tidak = Validasi::where('validasi_ktu', 1)->where('validasi_koor', 1)->where('validasi_bmn', 2)->get();
        }
        return view('back.validasi.sudah', compact('setuju', 'tidak'));
    }
    public function expired_validasi()
    {
        $date_now = date("Y-m-d h:i:s");

        $expired = Validasi::where('tanggal_finish', '<=', $date_now)
            ->where('status', '!=', 1)
            ->orderBy('tanggal_finish', 'asc')->get();

        return view('back.validasi.expired', compact('expired'));
    }
}
