<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKandungan extends Model
{
    use HasFactory;

    public function kandungan()
    {
        return $this->hasOne(Kandungan::class);
    }
}
