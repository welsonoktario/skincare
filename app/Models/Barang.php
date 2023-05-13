<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['placeholder'];

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

    public function fotos()
    {
        return $this->morphMany(Foto::class, 'fotoable');
    }

    public function getPlaceholderAttribute()  {
        return count($this->fotos)
            ? $this->fotos[0]->path
            : '/img/placeholder.jpeg';
    }
}
