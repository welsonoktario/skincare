<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alamat extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    public $casts = ['is_utama' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
