<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    protected $guarded = ['id'];

    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }

    public function rekeningWithTrashed()
    {
        return $this->belongsTo(Rekening::class, 'rekening_id')->withTrashed();
    }
}
