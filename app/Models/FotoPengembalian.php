<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoPengembalian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class);
    }
}
