<?php

namespace App\Http\Controllers;

use App\Models\Validasi;
use Illuminate\Http\Request;

class WhatsAppController extends Controller
{
    public function perangkat()
    {
        $token = env('WABLAS_API_WHATSAPP');
        $domain = env('SERVER_WABLAS');

        $session = curl_init(); // buat session
        // setting CURL
        curl_setopt($session, CURLOPT_URL, "$domain/api/device/info?token=$token");
        curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
        $hasil = curl_exec($session);
        $hasil = curl_exec($session);
        // print_r($hasil);
        $perangkat = json_decode($hasil, true);

        return view('back.whatsapp.perangkat', compact('perangkat'));
    }
    public function update_sender(Request $request)
    {
        $curl = curl_init();
        $token = env('WABLAS_API_WHATSAPP');
        $domain = env('SERVER_WABLAS');
        $data = [
            'phone' => $request->nomer,
        ];

        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "$domain/api/device/change-sender");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        // echo "<pre>";
        // print_r($result);
        return redirect('/perangkat');
    }
    public function restart()
    {
        $token = env('WABLAS_API_WHATSAPP');
        $domain = env('SERVER_WABLAS');

        $session = curl_init(); // buat session
        // setting CURL
        curl_setopt($session, CURLOPT_URL, "$domain/api/device/reconnect?token=$token");
        curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
        $hasil = curl_exec($session);
        $hasil = curl_exec($session);
        // print_r($hasil);
        $perangkat = json_decode($hasil, true);

        return redirect('/perangkat');
    }
    public function schedule()
    {
        return view('back.whatsapp.schedule');
    }
}
