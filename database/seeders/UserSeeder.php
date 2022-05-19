<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'Admin BMN',
            'email' => 'rrohman760@gmail.com',
            'password' => bcrypt('12345678'),
            'password_tidack_enkripsi' => '12345678',
            'nim_nidn' => '962916038',
            'roles' => 'BMN',
            'status_mhs' => 'Aktif',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'maskumambang',
            'rt' => '2',
            'rw' => '6',
            'desa' => 'wilis',
            'kota' => 'Kota Kediri',
            'no_telp' => '089123821782',
        ]);
    }
}
