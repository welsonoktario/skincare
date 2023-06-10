<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangPengecekan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kandungans()
    {
        return $this->belongsToMany(Kandungan::class);
    }
}
