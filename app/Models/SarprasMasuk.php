<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SarprasMasuk extends Model
{
    use HasFactory;

    protected $table = 'sarpras_masuk';

    public function sarpras()
    {
        return $this->belongsTo(Sarpras::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
