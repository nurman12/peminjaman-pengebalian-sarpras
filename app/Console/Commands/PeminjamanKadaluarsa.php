<?php

namespace App\Console\Commands;

use App\Models\Draft;
use App\Models\Sarpras;
use App\Models\Validasi;
use Illuminate\Console\Command;

class PeminjamanKadaluarsa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'peminjaman:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengebalikan data sarpras yang dipinjam tetapi tidak diambil sampai masa aktif pinjaman habis';

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
        // pinjaman tidak diambil==========================================================>
        $expired = Validasi::where('tanggal_finish', date("Y-m-d"))
            ->where('status', 0)
            ->get()
            ->toArray();

        // back data sarpras
        foreach ($expired as $item) {
            $this->backData($item);
        }
    }
    private function backData($item)
    {
        $draft = Draft::where('validasi_id', $item['id'])->get();

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
        Validasi::where('id', $item['id'])
            ->update([
                'status' => 3
            ]);
    }
}
