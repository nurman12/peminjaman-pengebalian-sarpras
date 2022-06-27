<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BotController extends Controller
{
    public function response(Request $request)
    {
        $send = Bot::where('received', 'LIKE', '%' . $request->received . '%')->orderBy('id', 'asc')->pluck('send', 'id');
        $id = Bot::where('received', 'LIKE', '%' . $request->received . '%')->first();
        $suggestion = DB::table('bot_2')->where('bot_id', $id->id)->orderBy('id', 'asc')->pluck('received', 'id');
        if ($send) {
            return response()->json([
                'send' => $send,
                'suggestion' => $suggestion
            ]);
        } else {
            return response()->json([
                'send' => 'Maaf, saya tidak paham maksud anda!'
            ]);
        }
    }
    public function index()
    {
        $bot = Bot::orderBy('created_at')->get();

        return view('back.bot.index', compact('bot'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'received' => 'required',
            'response' => 'required',
        ]);

        $cek = Bot::where('received', $request->received)->first();
        if ($cek) {
            return redirect('/bot')->with(['error' => 'Keyword' . $request->received . ' sudah ada']);
        } else {
            $bot = new Bot();
            $bot->received = $request->received;
            $bot->send = $request->response;
            $bot->save();
            return redirect('/bot')->with(['success' => 'Berhasil simpan data']);
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'received' => 'required',
            'response' => 'required',
        ]);

        Bot::where('id', $id)
            ->update([
                'received' => $request->received,
                'send' => $request->response
            ]);
        return redirect('/bot')->with(['success' => 'Berhasil ubah data']);
    }
    public function destroy($id)
    {
        Bot::destroy($id);

        return redirect('/bot')->with(['success' => 'Berhasil hapus data']);
    }
}
