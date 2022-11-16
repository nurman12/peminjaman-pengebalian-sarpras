<?php

namespace App\Http\Controllers;

use App\Models\Draft;
use App\Models\Rating;
use App\Models\Sarpras;
use App\Models\SarprasDetail;
use App\Models\User;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ValidasiController extends Controller
{
    function send_media($number, $file)
    {
        // send notif whatsapp 
        $curl = curl_init();
        $server = 'http://localhost:4000/';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $server . 'send-media-form',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'number' => $number,
                'caption' => 'test kirim lewat form',
                'file' => new \CURLFILE(public_path('storage/' . $file))
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }
    function send_text($number, $message)
    {
        $curl = curl_init();
        $server = 'http://localhost:4000/';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $server . 'send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "number=$number&message=$message",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }
    public function index()
    {
        $validasi = Validasi::orderBy('tanggal_start', 'asc')->get();

        return view('back.validasi.index', compact('validasi'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'keperluan' => 'required',
            'proposal' => 'required|mimes:pdf,doc,docx',
            'tanggal' => 'required|date_format:Y-m-d',
            'sampai'  => 'required|date_format:Y-m-d'
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
            $file = $request->file('proposal')->store('proposal');
            $validasi = new Validasi();
            $validasi->user_id = $request->user_id;
            $validasi->keperluan = $request->keperluan;
            $validasi->proposal = $file;
            $validasi->tanggal_start = $request->tanggal;
            $validasi->tanggal_finish = $request->sampai;

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

                Sarpras::where('id', $item->sarpras_id)
                    ->update([
                        'jumlah' => $item->sarpras->jumlah - $item->qty
                    ]);

                $sarpras_keluar =  new SarprasDetail();
                $sarpras_keluar->user_id = $item->user_id;
                $sarpras_keluar->draft_id = $item->id;
                $sarpras_keluar->sarpras_id = $item->sarpras_id;
                $sarpras_keluar->tanggal = date('Y-m-d');
                $sarpras_keluar->jenis = "keluar";
                $sarpras_keluar->jumlah = $item->qty;
                $sarpras_keluar->save();
            }
            // get mahasiswa
            $mahasiswa = User::where('id', $request->user_id)->first();

            // get KTU
            // $ktu = User::where('roles', 'KTU')->first();
            // $message = "Halo, Yth Bpk/Ibu: " . $ktu->name . "\nSaya memberitahukan ada permohonan pinjaman " . $mahasiswa->roles . "\nAtas nama : " . $mahasiswa->name . "\nKeperluan : " . $request->keperluan . " \nKegiatan dilaksanakan mulai " . date('d/m/ Y', strtotime($request->tanggal)) . " sampai " . date('d/m/Y', strtotime($request->sampai)) . ", \nberikut saya sertakan proposal permohonan pinjaman. \n\nTerima kasih";

            // $this->send_text($ktu->no_telp, $message);
            // $this->send_media($ktu->no_telp, $file);

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
                'tanggal' => 'required|date_format:Y-m-d',
                'sampai' => 'required|date_format:Y-m-d'
            ]);

            Validasi::where('id', $id)
                ->update([
                    'keperluan' => $request->keperluan,
                    'tanggal_start' => $request->tanggal,
                    'tanggal_finish' => $request->sampai
                ]);

            if ($request->file('proposal')) {
                Storage::delete($request->old_proposal);
                Validasi::where('id', $id)
                    ->update([
                        'proposal' => $request->file('proposal')->store('proposal')
                    ]);
            }

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

                // get Koordinator
                // $koordinator = User::where('roles', 'Koordinator')->first();
                // $message = "Halo, Yth Bpk/Ibu: " . $koordinator->name . "\nSaya memberitahukan ada permohonan pinjaman " . $validasi->user->roles . "\nAtas nama : " . $validasi->user->name . "\nKeperluan : " . $validasi->keperluan . " \nKegiatan dilaksanakan mulai " . date('d/m/ Y', strtotime($validasi->tanggal_start)) . " sampai " . date('d/m/Y', strtotime($validasi->tanggal_finish)) . ", \nberikut saya sertakan proposal permohonan pinjaman. \n\nTerima kasih";

                // $this->send_text($koordinator->no_telp, $message);
                // $this->send_media($koordinator->no_telp, $validasi->proposal);
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

            return redirect('/belum_validasi')->with(['success' => 'Berhasil mengubah data']);
        } elseif ($request->sebelum_koor) {
            Validasi::where('id', $id)
                ->update([
                    'validasi_koor' => $request->sebelum_koor
                ]);

            if ($request->sebelum_koor == 1) {
                Validasi::where('id', $id)
                    ->update([
                        'notif' => 0
                    ]);

                // get bmn
                // $bmn = User::where('roles', 'BMN')->first();
                // $message = "Halo, Yth Bpk/Ibu: " . $bmn->name . "\nSaya memberitahukan ada permohonan pinjaman " . $validasi->user->roles . "\nAtas nama : " . $validasi->user->name . "\nKeperluan : " . $validasi->keperluan . " \nKegiatan dilaksanakan mulai " . date('d/m/ Y', strtotime($validasi->tanggal_start)) . " sampai " . date('d/m/Y', strtotime($validasi->tanggal_finish)) . ", \nberikut saya sertakan proposal permohonan pinjaman. \n\nTerima kasih";

                // $this->send_text($bmn->no_telp, $message);
                // $this->send_media($bmn->no_telp, $validasi->proposal);
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

            return redirect('/belum_validasi')->with(['success' => 'Berhasil mengubah data']);
        } elseif ($request->sebelum_bmn) {
            Validasi::where('id', $id)
                ->update([
                    'validasi_bmn' => $request->sebelum_bmn
                ]);

            if ($request->sebelum_bmn == 1) {
                Validasi::where('id', $id)
                    ->update([
                        'notif' => 0
                    ]);

                // send message Mahasisiswa 
                // $message = "Halo, Yth: " . $validasi->user->name . "\nSaya memberitahukan bahwa permohonan pinjaman anda dengan \nKeperluan : "  . $validasi->keperluan . " \nKegiatan dilaksanakan mulai " . date('d/m/ Y', strtotime($validasi->tanggal_start)) . " sampai " . date('d/m/Y', strtotime($validasi->tanggal_finish)) . ", \n\nTelah mendapatkan *persetujuan*, silahan download draft pada akun ada, kemudian lakukan pengambilan sarpras. \nTerima kasih";

                // $this->send_text($validasi->user->no_telp, $message);
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

            return redirect('/belum_validasi')->with(['success' => 'Berhasil mengubah data']);
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

                // get Koordinator
                // $koordinator = User::where('roles', 'Koordinator')->first();
                // $message = "Halo, Yth Bpk/Ibu: " . $koordinator->name . "\nSaya memberitahukan ada permohonan pinjaman " . $validasi->user->roles . "\nAtas nama : " . $validasi->user->name . "\nKeperluan : " . $validasi->keperluan . " \nKegiatan dilaksanakan mulai " . date('d/m/ Y', strtotime($validasi->tanggal_start)) . " sampai " . date('d/m/Y', strtotime($validasi->tanggal_finish)) . ", \nberikut saya sertakan proposal permohonan pinjaman. \n\nTerima kasih";

                // $this->send_text($koordinator->no_telp, $message);
                // $this->send_media($koordinator->no_telp, $validasi->proposal);
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

                    $sarpras_keluar = SarprasDetail::where('draft_id', $data->id)->where('jenis', 'keluar')->first();

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

            return redirect('/sudah_validasi')->with(['success' => 'Berhasil mengubah data']);
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

                // get bmn
                // $bmn = User::where('roles', 'BMN')->first();
                // $message = "Halo, Yth Bpk/Ibu: " . $bmn->name . "\nSaya memberitahukan ada permohonan pinjaman " . $validasi->user->roles . "\nAtas nama : " . $validasi->user->name . "\nKeperluan : " . $validasi->keperluan . " \nKegiatan dilaksanakan mulai " . date('d/m/ Y', strtotime($validasi->tanggal_start)) . " sampai " . date('d/m/Y', strtotime($validasi->tanggal_finish)) . ", \nberikut saya sertakan proposal permohonan pinjaman. \n\nTerima kasih";

                // $this->send_text($bmn->no_telp, $message);
                // $this->send_media($bmn->no_telp, $validasi->proposal);
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

                    $sarpras_keluar = SarprasDetail::where('draft_id', $data->id)->where('jenis', 'keluar')->first();

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

            return redirect('/sudah_validasi')->with(['success' => 'Berhasil mengubah data']);
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

                // send message Mahasisiswa 
                // $message = "Halo, Yth: " . $validasi->user->name . "\nSaya memberitahukan bahwa permohonan pinjaman anda dengan \nKeperluan : "  . $validasi->keperluan . " \nKegiatan dilaksanakan mulai " . date('d/m/ Y', strtotime($validasi->tanggal_start)) . " sampai " . date('d/m/Y', strtotime($validasi->tanggal_finish)) . ", \n\ntelah mendapatkan *persetujuan*, silahan download draft pada akun ada, kemudian lakukan pengambilan sarpras. \nTerima kasih";

                // $this->send_text($validasi->user->no_telp, $message);
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

                    $sarpras_keluar = SarprasDetail::where('draft_id', $data->id)->where('jenis', 'keluar')->first();

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

            return redirect('/sudah_validasi')->with(['success' => 'Berhasil mengubah data']);
        }
    }
    public function update_lanjut(Request $request, $id)
    {

        $request->validate([
            'keperluan' => 'required',
            'proposal' => 'mimes:pdf,doc,docx',
            'tanggal' => 'required|date_format:Y-m-d',
            'sampai' => 'required|date_format:Y-m-d'
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

                        SarprasDetail::where('draft_id', $item->id)
                            ->where('jenis', 'keluar')
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

                $data_k = SarprasDetail::where('draft_id', $item->id)->where('jenis', 'keluar')->first();

                if ($data_k == null) {
                    $sarpras_keluar = new SarprasDetail();
                    $sarpras_keluar->user_id = $item->user_id;
                    $sarpras_keluar->draft_id = $item->id;
                    $sarpras_keluar->sarpras_id = $item->sarpras_id;
                    $sarpras_keluar->tanggal = date('Y-m-d');
                    $sarpras_keluar->jenis = "keluar";
                    $sarpras_keluar->jumlah = $item->qty;
                    $sarpras_keluar->save();
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
                    'tanggal_start' => $request->tanggal,
                    'tanggal_finish' => $request->sampai
                ]);

            if ($request->file('proposal')) {
                Storage::delete($request->old_proposal);
                Validasi::where('id', $id)
                    ->update([
                        'proposal' => $request->file('proposal')->store('proposal')
                    ]);
            }

            return redirect('/profile')->with(['status' => 'Berhasil mengubah data']);
        }
    }
    public function update_peminjaman(Request $request, $id)
    {
        $request->validate([
            'keperluan' => 'required',
            'proposal' => 'mimes:pdf,doc,docx',
            'mulai' => 'required|date_format:Y-m-d',
            'sampai'  => 'required|date_format:Y-m-d'
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
                'tanggal_start' => $request->mulai,
                'tanggal_finish' => $request->sampai
            ]);

        if ($request->file('proposal')) {
            Storage::delete($request->old_proposal);
            Validasi::where('id', $id)
                ->update([
                    'proposal' => $request->file('proposal')->store('proposal')
                ]);
        }

        return redirect('/validasi/' . $id . '/edit')->with(['success' => 'Berhasil mengubah data']);;
    }
    public function destroy(Request $request, $id)
    {
        if (Auth::user()->roles == 'Mahasiswa' || Auth::user()->roles == 'Dosen') {

            $draft = Draft::where('validasi_id', $id)->get();

            foreach ($draft as $data) {
                Sarpras::where('id', $data->sarpras_id)
                    ->update([
                        'jumlah' => $data->sarpras->jumlah + $data->qty
                    ]);

                SarprasDetail::where('draft_id', $data->id)->where('jenis', 'keluar')->delete();
            }
            Draft::where('validasi_id', $id)->delete();
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
                )->first();

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
                DB::table('sarpras_detail')->where('draft_id', $item->id)->where('jenis', 'keluar')->delete();
            }
            $validasi = Validasi::where('id', $id)->first();

            Storage::delete($validasi->proposal);

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
            $belum_validasi = Validasi::where('validasi_ktu', 0)
                ->where('validasi_koor', 0)
                ->where('validasi_bmn', 0)
                ->get();
        } elseif (Auth::user()->roles == 'Koordinator') {
            $belum_validasi = Validasi::where('validasi_ktu', 1)
                ->where('validasi_koor', 0)
                ->where('validasi_bmn', 0)
                ->get();
        } elseif (Auth::user()->roles == 'BMN') {
            $belum_validasi = Validasi::where('validasi_ktu', 1)
                ->where('validasi_koor', 1)
                ->where('validasi_bmn', 0)
                ->get();
        }
        return view('back.validasi.belum', compact('belum_validasi'));
    }
    public function sudah_validasi()
    {
        if (Auth::user()->roles == 'KTU') {
            $setuju = Validasi::where('validasi_ktu', 1)->get();
            $tidak = Validasi::where('validasi_ktu', 2)
                ->where('validasi_koor', 0)
                ->where('validasi_bmn', 0)->get();
        } elseif (Auth::user()->roles == 'Koordinator') {
            $setuju = Validasi::where('validasi_ktu', 1)
                ->where('validasi_koor', 1)->get();
            $tidak = Validasi::where('validasi_ktu', 1)
                ->where('validasi_koor', 2)
                ->where('validasi_bmn', 0)->get();
        } elseif (Auth::user()->roles == 'BMN') {
            $setuju = Validasi::where('validasi_ktu', 1)
                ->where('validasi_koor', 1)
                ->where('validasi_bmn', 1)->get();
            $tidak = Validasi::where('validasi_ktu', 1)
                ->where('validasi_koor', 1)
                ->where('validasi_bmn', 2)->get();
        }
        return view('back.validasi.sudah', compact('setuju', 'tidak'));
    }
}
