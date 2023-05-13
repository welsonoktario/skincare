<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = ['id'];

    public function transaksiDetails()
    {
        return $this->belongsTo(TransaksiDetail::class);
    }

    public function user()
    {
        return $this->belongsToThrough(User::class, [Transaksi::class, TransaksiDetail::class]);
    }

    public function fotos()
    {
        return $this->morphMany(Foto::class, 'fotoable');
    }
}
