<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SarprasDetail extends Model
{
    protected $table = 'sarpras_detail';
    protected $fillabel = ['user_id', 'draft_id', 'tanggal', 'jenis', 'jumlah', 'hilang', 'keterangan'];

    use HasFactory;

    public function sarpras()
    {
        return $this->belongsTo(Sarpras::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function rusak()
    {
        return $this->hasOne(Rusak::class);
    }
}
