<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etalase extends Model
{
    protected $guarded = ['id'];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
