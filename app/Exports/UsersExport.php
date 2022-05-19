<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all(
            'name',
            'email',
            'password_tidack_enkripsi',
            'nim_nidn',
            'roles',
            'status_mhs',
            'jenis_kelamin',
            'alamat',
            'rt',
            'rw',
            'desa',
            'kota',
            'no_telp'
        );
    }
    public function headings(): array
    {
        return [
            "Nama", "Email", "Password", "Nim/Nidn", "Level", "Status", "Jenis Kelamin",
            "Alamat", "Rt", "Rw", "Desa", "Kota", "Nomer Telpon"
        ];
    }
}
