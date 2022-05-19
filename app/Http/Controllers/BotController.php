<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function response(Request $request)
    {
        $send = Bot::where('received', 'LIKE', '%' . $request->received . '%')->first();

        if ($send) {
            return response()->json([
                'send' => $send->send
            ]);
        } else {
            return response()->json([
                'send' => 'Maaf, saya tidak paham maksud anda!'
            ]);
        }
    }
}
