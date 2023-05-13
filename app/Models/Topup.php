<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
