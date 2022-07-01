<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rusak extends Model
{
    use HasFactory;

    protected $table = 'rusak';
    protected $fillable = ['sarpras_detail_id', 'hilang'];

    public function sarpras_detail()
    {
        return $this->hasOne(SarprasDetail::class);
    }
}
