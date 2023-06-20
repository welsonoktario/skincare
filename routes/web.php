<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\AlamatController;
use App\Http\Controllers\User\BarangController;
use App\Http\Controllers\User\CekKandunganController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\KategoriController;
use App\Http\Controllers\User\ProfilController;
use App\Http\Controllers\User\TopupController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\TransaksiController;
use App\Http\Controllers\User\TokoController;
use App\Http\Controllers\User\WishlistController;

use App\Http\Controllers\Toko\BarangController as TokoBarangController;
use App\Http\Controllers\Toko\EtalaseController as TokoEtalaseController;
use App\Http\Controllers\Toko\HomeController as TokoHomeController;
use App\Http\Controllers\Toko\PenarikanController as TokoPenarikanController;
use App\Http\Controllers\Toko\PesananController as TokoPesananController;
use App\Http\Controllers\Toko\RekeningController as TokoRekeningController;

use App\Http\Controllers\Admin\BarangPengecekanController as AdminBarangPengecekanController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\InteraksiKandunganController as AdminInteraksiKandunganController;
use App\Http\Controllers\Admin\KandunganController as AdminKandunganController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\Admin\TokoController as AdminTokoController;
use App\Http\Controllers\Admin\VerifikasiBarangController as AdminVerifikasiBarangController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\admin\PenarikanController as AdminPenarikanController;
use App\Http\Controllers\Admin\VerifikasiTokoController as AdminVerifikasiTokoController;
use App\Http\Controllers\Toko\EkspedisiController;
use App\Models\Kategori;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['as' => 'user.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [HomeController::class, 'search'])->name('home.search');
    Route::get('/seller/{toko}', [TokoController::class, 'index'])->name('toko.index');

    Route::get('/cek-kandungan', [CekKandunganController::class, 'index'])->name('cek-kandungan.index');
    Route::get('/cek-kandungan/{id}', [CekKandunganController::class, 'show'])->name('cek-kandungan.show');
    Route::post('/cek-kandungan', [CekKandunganController::class, 'index'])->name('cek-kandungan.cek');

    Route::resources([
        'kategori' => KategoriController::class,
        'produk' => BarangController::class,
    ]);

    Route::middleware(['auth'])->group(function () {
        Route::group(['prefix' => 'checkout'], function () {
            Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
            Route::get('alamats', [CheckoutController::class, 'loadAlamats'])->name('checkout.alamats');
            Route::get('kota', [CheckoutController::class, 'loadKota'])->name('checkout.loadKota');
            Route::post('ongkir', [CheckoutController::class, 'loadOngkir'])->name('checkout.loadOngkir');
            Route::post('get-payment', [CheckoutController::class, 'getPayment'])->name('checkout.getPayment');
            Route::post('payment_post', [CheckoutController::class, 'payment_post'])->name('checkout.checkout');
            Route::get('pembayaran', [CheckoutController::class, 'pembayaran'])->name('checkout.pembayaran');
        });

        Route::patch('alamat/{alamat}/set-utama', [AlamatController::class, 'setUtama'])->name('alamat.setUtama');
        Route::get('kategori/lainnya', [KategoriController::class, 'lainnya'])->name('kategori.lainnya');

        Route::prefix('profil')->group(function () {
            // Route::get('/alamat', [AlamatController::class, 'index']) => skincare.com/profil/alamat
            // Route::get('/alamat/{id}', [AlamatController::class, 'show']) => skincare.com/alamat/{alamat}
            // Route::get('/alamat/{id}/create', [AlamatController::class, 'create']) => skincare.com/alamat/{alamat}/create
            // Route::get('/alamat/{id}/edit', [AlamatController::class, 'edit']) => skincare.com/alamat/{alamat}/edit
            // Route::put('/alamat/{id}', [AlamatController::class, 'update']) => skincare.com/alamat/{id}
            // Route::post('/alamat', [AlamatController::class, 'store']) => skincare.com/alamat
            // Route::delete('/alamat/{id}', [AlamatController::class, 'destroy']) => skincare.com/alamat/{alamat}
            Route::resource('alamat', AlamatController::class, ['as' => 'profil']);
        });

        Route::group(['prefix' => 'topup'], function () {
            Route::post('get-topup', [TopupController::class, 'getTopup'])->name('topup.getTopup');
            Route::post('process-topup', [TopupController::class, 'processTopup'])->name('topup.process');
        });

        Route::resources([
            'topup' => TopupController::class,
            'keranjang' => KeranjangController::class,
            'profil' => ProfilController::class,
            'transaksi' => TransaksiController::class,
            'wishlist' => WishlistController::class
        ]);
    });
});

Route::group(['prefix' => 'toko', 'as' => 'toko.', 'middleware' => 'auth'], function () {
    Route::middleware(['hasToko'])->group(function () {
        Route::get('/', [TokoHomeController::class, 'index'])->name('hometoko');
        Route::get('ekspedisi', [EkspedisiController::class, 'index'])->name('ekspedisi.index');
        Route::put('ekspedisi', [EkspedisiController::class, 'update'])->name('ekspedisi.update');

        Route::resource('barang', TokoBarangController::class);
        Route::resource('akun', TokoAkunController::class);
        Route::resource('etalase', TokoEtalaseController::class);
        Route::resource('pesanan', TokoPesananController::class);
        Route::resource('profil', TokoProfilController::class);
        Route::resource('rekening', TokoRekeningController::class);
        Route::resource('bank', TokoBankController::class);
        Route::resource('penarikan', TokoPenarikanController::class);
    });

    Route::get('/create', [TokoHomeController::class, 'create'])->name('create');
    Route::post('/', [TokoHomeController::class, 'store'])->name('store');
    Route::get('{toko}/edit', [TokoHomeController::class, 'edit'])->name('edit');
    Route::put('{toko}/update', [TokoHomeController::class, 'update'])->name('update');
    Route::get('{provinsi}/kota', [TokoHomeController::class, 'loadKota'])->name('loadKota');
    Route::get('/barang/{id}/foto', [TokoBarangController::class, 'loadFotos'])->name('barang.foto');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth.admin']], function () {
    Route::group(['prefix' => 'interaksi-kandungan', 'as' => 'interaksi-kandungan.'], function () {
        Route::get('/', [AdminInteraksiKandunganController::class, 'index'])->name('index');
        Route::get('/create', [AdminInteraksiKandunganController::class, 'create'])->name('create');
        Route::post('/', [AdminInteraksiKandunganController::class, 'store'])->name('store');
        Route::get('/{k1}/{k2}/edit', [AdminInteraksiKandunganController::class, 'edit'])->name('edit');
        Route::put('/{k1}/{k2}', [AdminInteraksiKandunganController::class, 'update'])->name('update');
        Route::delete('/{k1}/{k2}', [AdminInteraksiKandunganController::class, 'destroy'])->name('destroy');
    });

    Route::get('home', [AdminHomeController::class, 'index'])->name('homeadmin');
    Route::resource('toko', AdminTokoController::class);
    Route::resource('member', AdminMemberController::class);
    Route::resource('verifikasibarang', AdminVerifikasiBarangController::class);
    Route::resource('verifikasitoko', AdminVerifikasiTokoController::class);
    Route::resource('kategori', AdminKategoriController::class);
    Route::resource('kandungan', AdminKandunganController::class);
    Route::resource('barang-pengecekan', AdminBarangPengecekanController::class);
    Route::resource('penarikan', AdminPenarikanController::class);
});

require __DIR__ . '/auth.php';
