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
}
