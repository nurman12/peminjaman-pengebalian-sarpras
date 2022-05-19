<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';

    public function validasi()
    {
        return $this->belongsTo(Validasi::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
