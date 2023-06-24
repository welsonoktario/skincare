<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function etalases()
    {
        return $this->hasMany(Etalase::class);
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

    public function penarikans()
    {
        return $this->morphMany(Penarikan::class, 'penarikanable');
    }

    public function ekspedisis()
    {
        return $this->belongsToMany(Ekspedisi::class, 'ekspedisi_tokos', 'toko_id', 'ekspedisi_id');
    }

    public function getRatingAttribute()
    {
        $rating = collect([]);

        foreach ($this->transaksis as $transaksi) {
            foreach ($transaksi->transaksiDetails as $td) {
                if ($td->ulasan) {
                    $rating->add($td->ulasan->rating);
                } else {
                    $rating->add(null);
                }
            }
        }

        return count($rating)
            ? floatval(round($rating->avg(), 2))
            : 0;
    }
}
