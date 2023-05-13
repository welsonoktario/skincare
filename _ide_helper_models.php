<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Alamat
 *
 * @property int $id
 * @property int $user_id
 * @property int $provinsi_id
 * @property int $kota_id
 * @property string $alamat
 * @property string $nama
 * @property string $penerima
 * @property string $kontak
 * @property bool $is_utama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Kota $kota
 * @property-read \App\Models\Provinsi $provinsi
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaksi> $transaksis
 * @property-read int|null $transaksis_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat whereIsUtama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat whereKontak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat whereKotaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat wherePenerima($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat whereProvinsiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Alamat withoutTrashed()
 */
	class Alamat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Barang
 *
 * @property int $id
 * @property int $toko_id
 * @property int|null $etalase_id
 * @property int $kategori_id
 * @property string $nama
 * @property string $deskripsi
 * @property string $status
 * @property int $harga
 * @property int $stok
 * @property int $berat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Etalase|null $etalase
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Foto> $fotos
 * @property-read int|null $fotos_count
 * @property-read mixed $placeholder
 * @property-read \App\Models\Kategori $kategori
 * @property-read \App\Models\Toko $toko
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TransaksiDetail> $transaksiDetails
 * @property-read int|null $transaksi_details_count
 * @method static \Database\Factories\BarangFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Barang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Barang query()
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereBerat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereEtalaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereStok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereTokoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Barang whereUpdatedAt($value)
 */
	class Barang extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ekspedisi
 *
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Toko> $tokos
 * @property-read int|null $tokos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ekspedisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ekspedisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ekspedisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ekspedisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ekspedisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ekspedisi whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ekspedisi whereUpdatedAt($value)
 */
	class Ekspedisi extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Etalase
 *
 * @property int $id
 * @property int $toko_id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Barang> $barangs
 * @property-read int|null $barangs_count
 * @property-read \App\Models\Toko $toko
 * @method static \Illuminate\Database\Eloquent\Builder|Etalase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Etalase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Etalase query()
 * @method static \Illuminate\Database\Eloquent\Builder|Etalase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etalase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etalase whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etalase whereTokoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Etalase whereUpdatedAt($value)
 */
	class Etalase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Foto
 *
 * @property int $id
 * @property string $path
 * @property string $fotoable_type
 * @property int $fotoable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $fotoable
 * @method static \Illuminate\Database\Eloquent\Builder|Foto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Foto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Foto query()
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereFotoableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereFotoableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereUpdatedAt($value)
 */
	class Foto extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Kategori
 *
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Barang> $barangs
 * @property-read int|null $barangs_count
 * @method static \Database\Factories\KategoriFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereUpdatedAt($value)
 */
	class Kategori extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Kota
 *
 * @property int $id
 * @property int $provinsi_id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Kota newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kota newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kota query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kota whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kota whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kota whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kota whereProvinsiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kota whereUpdatedAt($value)
 */
	class Kota extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Penarikan
 *
 * @property int $id
 * @property int $toko_id
 * @property int $nominal
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $penarikanable
 * @method static \Illuminate\Database\Eloquent\Builder|Penarikan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Penarikan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Penarikan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Penarikan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penarikan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penarikan whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penarikan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penarikan whereTokoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Penarikan whereUpdatedAt($value)
 */
	class Penarikan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Provinsi
 *
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinsi whereUpdatedAt($value)
 */
	class Provinsi extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Toko
 *
 * @property int $id
 * @property int $user_id
 * @property int $kota_id
 * @property string $nama
 * @property string|null $foto
 * @property string $alamat
 * @property string $deskripsi
 * @property string $no_telepon
 * @property int $saldo
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Barang> $barangs
 * @property-read int|null $barangs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ekspedisi> $ekspedisis
 * @property-read int|null $ekspedisis_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Etalase> $etalases
 * @property-read int|null $etalases_count
 * @property-read \App\Models\Kota $kota
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Penarikan> $penarikans
 * @property-read int|null $penarikans_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaksi> $transaksis
 * @property-read int|null $transaksis_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TokoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Toko newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Toko query()
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereKotaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereNoTelepon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereSaldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Toko whereUserId($value)
 */
	class Toko extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Topup
 *
 * @property int $id
 * @property int $user_id
 * @property int $nominal
 * @property string $status
 * @property string $bukti_pembayaran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Topup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topup query()
 * @method static \Illuminate\Database\Eloquent\Builder|Topup whereBuktiPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topup whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topup whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topup whereUserId($value)
 */
	class Topup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaksi
 *
 * @property int $id
 * @property int $user_id
 * @property int $toko_id
 * @property int $ekspedisi_id
 * @property int $alamat_id
 * @property int $total_harga
 * @property int $ongkos_pengiriman
 * @property string $jenis_pembayaran
 * @property string $status
 * @property string|null $bukti_pembayaran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Alamat $alamat
 * @property-read \App\Models\Ekspedisi $ekspedisi
 * @property-read \App\Models\Toko $toko
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TransaksiDetail> $transaksiDetails
 * @property-read int|null $transaksi_details_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereAlamatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereBuktiPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereEkspedisiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereJenisPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereOngkosPengiriman($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereTokoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereTotalHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaksi whereUserId($value)
 */
	class Transaksi extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TransaksiDetail
 *
 * @property int $id
 * @property int $transaksi_id
 * @property int $barang_id
 * @property int $sub_total
 * @property int $jumlah
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Barang $barang
 * @property-read \App\Models\Transaksi $transaksi
 * @property-read \App\Models\Ulasan|null $ulasan
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiDetail whereBarangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiDetail whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiDetail whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiDetail whereTransaksiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransaksiDetail whereUpdatedAt($value)
 */
	class TransaksiDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ulasan
 *
 * @property int $id
 * @property int $transaksi_detail_id
 * @property string|null $komentar
 * @property string $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Foto> $fotos
 * @property-read int|null $fotos_count
 * @property-read \App\Models\TransaksiDetail|null $transaksiDetails
 * @method static \Illuminate\Database\Eloquent\Builder|Ulasan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ulasan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ulasan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ulasan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ulasan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ulasan whereKomentar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ulasan whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ulasan whereTransaksiDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ulasan whereUpdatedAt($value)
 */
	class Ulasan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $username
 * @property string $nama
 * @property string $no_hp
 * @property string $email
 * @property string $role
 * @property int $saldo
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Alamat> $alamats
 * @property-read int|null $alamats_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Barang> $keranjangs
 * @property-read int|null $keranjangs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Barang> $keranjangsWithToko
 * @property-read int|null $keranjangs_with_toko_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Barang> $keranjangsWithTokoEskpedisi
 * @property-read int|null $keranjangs_with_toko_eskpedisi_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Penarikan> $penarikans
 * @property-read int|null $penarikans_count
 * @property-read \App\Models\Toko|null $toko
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Topup> $topups
 * @property-read int|null $topups_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaksi> $transaksis
 * @property-read int|null $transaksis_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Barang> $wishlists
 * @property-read int|null $wishlists_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSaldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

