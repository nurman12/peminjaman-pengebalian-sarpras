<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SarprasDetail extends Model
{
    use HasFactory;

    protected $table = 'sarpras_detail';

    public function sarpras()
    {
        return $this->belongsTo(Sarpras::class);
    }
    public function sarpras_keluar()
    {
        return $this->belongsTo(Sarpras_Keluar::class);
    }
    public function sarpras_masuk()
    {
        return $this->belongsTo(Sarpras_Masuk::class);
    }
}
