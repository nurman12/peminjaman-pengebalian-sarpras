<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use App\Conversations\ExampleConversation;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Http\Request;

class BotManController extends Controller
{
    public function handle()
    {
        // Load the driver(s) you want to use
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

        $config = [
            // Your driver-specific configuration
            "telegram" => [
                "token" => "5250899252:AAH7ZpFo2JRoEJOdm_wAN2p33gsPx97k6Gs"
            ]
        ];
        $botman = BotManFactory::create($config, new LaravelCache());

        $botman->hears('/start|start|mulai', function (BotMan $bot) {
            $user = $bot->getUser();
            $bot->reply('Assalamualaikum ' . $user->getFirstName() . ', Selamat datang di Hadits Telegram Bot!. ');
            $bot->startConversation(new ExampleConversation());
        })->stopsConversation();

        $botman->hears('/kitab|kitab', function (BotMan $bot) {
            $bot->startConversation(new ExampleConversation());
        })->stopsConversation();

        $botman->hears('/lapor|lapor|laporkan', function (BotMan $bot) {
            $bot->reply('Silahkan laporkan di email example10101010101010@gmail.com . Laporan kamu akan sangat berharga buat kemajuan bot ini.');
        })->stopsConversation();

        $botman->hears('/tentang|about|tentang', function (BotMan $bot) {
            $bot->reply('LatBot Telegram Bot By ManNur. Mohon maaf jika server terasa lamban, dikarenakan menggunakan local');
        })->stopsConversation();

        $botman->fallback(function($bot) {
            $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: Mulai, laporkan, about');
        });
        
        $botman->listen();
    }
}
