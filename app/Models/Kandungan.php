<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandungan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

    public function interaksis()
    {
        return $this->belongsToMany(
            Kandungan::class,
            'interaksi_kandungans',
            'kandungan_satu_id',
            'kandungan_dua_id'
        )
            ->withPivot(['jenis_interaksi', 'deskripsi_interaksi', 'sumber'])
            ->withTimestamps();
    }
}
