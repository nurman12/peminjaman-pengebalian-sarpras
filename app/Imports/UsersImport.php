<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name' => $row['nama'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'password_tidack_enkripsi' => $row['password'],
            'nim_nidn' => $row['nimnidn'],
            'roles' => $row['level'],
            'status_mhs' => $row['status'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'alamat' => $row['alamat'],
            'rt' => $row['rt'],
            'rw' => $row['rw'],
            'desa' => $row['desa'],
            'kota' => $row['kota'],
            'no_telp' => $row['nomer_telpon'],
        ]);
    }
}
