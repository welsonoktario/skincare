<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $guarded = ['id'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class);
    }
}
