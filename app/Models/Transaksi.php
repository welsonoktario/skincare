<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];
    protected $appends = ['ulasan_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    public function ekspedisi()
    {
        return $this->belongsTo(Ekspedisi::class);
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }

    // Mengambil jumlah ulasan transaksi
    public function getUlasanCountAttribute()
    {
        $ulasanCount = 0;

        foreach ($this->transaksiDetails as $td) {
            if ($td->ulasan) {
                $ulasanCount++;
            }
        }

        return $ulasanCount;
    }
}
