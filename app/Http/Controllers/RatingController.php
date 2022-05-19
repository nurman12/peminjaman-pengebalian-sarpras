<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $pengembalian_id = $request->input('pengembalian_id');
        $penilaian = $request->input('penilaian');
        $keterangan = $request->input('keterangan');

        $pengembalian = Pengembalian::where('id', $pengembalian_id)->first();

        if ($pengembalian->rating) {
            Rating::where('id', $pengembalian->rating->id)
                ->update([
                    'penilaian' => $penilaian,
                    'keterangan' => $keterangan
                ]);
        } else {
            $rating = new Rating();
            $rating->user_id = $pengembalian->user_id;
            $rating->pengembalian_id = $pengembalian_id;
            $rating->penilaian = $penilaian;
            $rating->keterangan = $keterangan;

            $rating->save();
        }
        return response()->json(['success_message' => 'Berhasil memberi rating']);
    }
}
