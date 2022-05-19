<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    use HasFactory;

    protected $table = 'validasi';

    public function draft()
    {
        return $this->hasMany(Draft::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}
