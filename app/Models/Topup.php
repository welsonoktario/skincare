<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'created_at' => 'datetime:d M Y H:i:s',
        'dibayar' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
