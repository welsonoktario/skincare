<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    protected $guarded = ['id'];

    public function tokos()
    {
        return $this->belongsToMany(Toko::class, 'ekspedisi_tokos', 'ekspedisi_id', 'toko_id');
    }
}
