<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    use HasFactory;

    protected $table = 'draft';

    public function sarpras()
    {
        return $this->belongsTo(Sarpras::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validasi()
    {
        return $this->belongsTo(Validasi::class);
    }

    public function sarpras_keluar()
    {
        return $this->hasOne(SarprasDetail::class);
    }

    public function sarpras_masuk()
    {
        return $this->hasOne(SarprasDetail::class);
    }
}
