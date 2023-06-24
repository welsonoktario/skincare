<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Barang extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $appends = ['placeholder', 'hargaDiskon'];

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public function ulasans()
    {
        return $this->hasManyDeep(Ulasan::class, [TransaksiDetail::class]);
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    public function etalase()
    {
        return $this->belongsTo(Etalase::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function kandungans()
    {
        return $this->belongsToMany(Kandungan::class, 'barang_kandungans');
    }

    public function fotos()
    {
        return $this->hasMany(FotoBarang::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

    public function getPlaceholderAttribute()
    {
        return count($this->fotos)
            ? "/storage/{$this->fotos[0]->path}"
            : '/img/placeholder.jpeg';
    }

    public function getHargaDiskonAttribute()
    {
        $jenisDiskon = $this->jenis_diskon;
        $nominalDiskon = $this->nominal_diskon;

        if (!$jenisDiskon) {
            return null;
        }

        if ($jenisDiskon == 'persen') {
            return $this->harga - ($this->harga * $nominalDiskon / 100);
        }

        if ($jenisDiskon == 'nominal') {
            return $this->harga - $nominalDiskon;
        }
    }

    public function getRatingAttribute()
    {
        $rating = collect([]);

        foreach ($this->transaksiDetails as $td) {
            if ($td->ulasan) {
                $rating->add($td->ulasan->rating);
            } else {
                $rating->add(null);
            }
        }

        return count($rating)
            ? floatval(round($rating->avg(), 2))
            : 0;
    }
}
