<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rekening extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function penarikans()
    {
        return $this->hasMany(Penarikan::class, 'rekening_id');
    }
}
