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
        return $this->belongsToMany(Barang::class, 'barang_kandungans');
    }

    public function barangPengecekans()
    {
        return $this->belongsToMany(BarangPengecekan::class, 'barang_pengecekan_kandungans');
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
