<?php

namespace App\Console\Commands;

use App\Mail\ReminderEmail;
use App\Mail\ReminderEmailTomorrow;
use App\Models\User;
use App\Models\Validasi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to user about reminders.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // get all remider for tomorow=====================================================>
        $tomorrows = Validasi::where('tanggal_finish', date('Y-m-d', strtotime('tomorrow')))
            ->where('status', 1)
            ->orderBy('user_id', 'asc')
            ->get();

        // group by user 
        $item = [];
        foreach ($tomorrows as $tomorrow) {
            $item[$tomorrow->user_id][] = $tomorrow->toArray();
        }

        // send email 
        foreach ($item as $userId => $tomorrows) {
            $this->sendEmailToUserTomorrow($userId, $tomorrows);
            $this->sendWhatsAppTomorrow($tomorrows);
        }

        // get all raminders for today====================================================>
        $reminders = Validasi::where('validasi.tanggal_finish', now()->format('Y-m-d'))
            ->where('status', 1)
            ->orderBy('user_id', 'asc')
            ->get();
        // group by user 
        $data = [];
        foreach ($reminders as $reminder) {
            $data[$reminder->user_id][] = $reminder->toArray();
        }

        // send email 
        foreach ($data as $userId => $reminders) {
            $this->sendEmailToUser($userId, $reminders);
            $this->sendWhatsApp($reminders);
        }
    }
    private function sendEmailToUserTomorrow($userId, $tomorrows)
    {
        $user = User::find($userId);

        Mail::to($user)->send(new ReminderEmailTomorrow($user, $tomorrows));
    }
    private function sendEmailToUser($userId, $reminders)
    {
        $user = User::find($userId);

        Mail::to($user)->send(new ReminderEmail($user, $reminders));
    }
    private function sendWhatsApp($reminders)
    {
        foreach ($reminders as $reminder) {

            $user = User::where('id', $reminder['user_id'])->first();

            if ($user->no_telp) {
                $message = "Halo, Yth: " . $user->name . "\nSaya memberitahukan bahwa pinjaman anda dengan \nKeperluan : "  . $reminder['keperluan'] . " \nKegiatan dilaksanakan mulai " . date('d/m/ Y', strtotime($reminder['tanggal_start'])) . " sampai " . date('d/m/Y', strtotime($reminder['tanggal_finish'])) . ", \n\nMasa peminjaman berakhir *hari ini*, mohon mengembalikan sarpras tepat waktu \n\nTerima kasih";

                $number = $user->no_telp;
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
        }
    }
    private function sendWhatsAppTomorrow($tomorrows)
    {
        foreach ($tomorrows as $reminder) {

            $user = User::where('id', $reminder['user_id'])->first();

            if ($user->no_telp) {
                $message = "Halo, Yth: " . $user->name . "\nSaya memberitahukan bahwa pinjaman anda dengan \nKeperluan : "  . $reminder['keperluan'] . " \nKegiatan dilaksanakan mulai " . date('d/m/ Y', strtotime($reminder['tanggal_start'])) . " sampai " . date('d/m/Y', strtotime($reminder['tanggal_finish'])) . ", \n\nMasa peminjaman berakhir *besok*, mohon mengembalikan sarpras tepat waktu \n\nTerima kasih";

                $number = $user->no_telp;
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
        }
    }
}
