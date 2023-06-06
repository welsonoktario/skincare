<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\user\AlamatController;
use App\Http\Controllers\user\BarangController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\KategoriController;
use App\Http\Controllers\user\ProfilController;
use App\Http\Controllers\user\TopupController;
use App\Http\Controllers\user\KeranjangController;
use App\Http\Controllers\user\TransaksiController;
use App\Http\Controllers\user\TokoController;
use App\Http\Controllers\user\WishlistController;

use App\Http\Controllers\toko\BarangController as TokoBarangController;
use App\Http\Controllers\toko\EtalaseController as TokoEtalaseController;
use App\Http\Controllers\toko\HomeController as TokoHomeController;
use App\Http\Controllers\toko\PenarikanController as TokoPenarikanController;
use App\Http\Controllers\toko\PesananMasukController as TokoPesananMasukController;
use App\Http\Controllers\toko\RekeningController as TokoRekeningController;
use App\Http\Controllers\toko\RiwayatTransaksiController as TokoRiwayatTransaksi;

use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\TokoController as AdminTokoController;
use App\Http\Controllers\admin\VerifikasiBarangController as AdminVerifikasiBarangController;
use App\Http\Controllers\admin\MemberController as AdminMemberController;
use App\Http\Controllers\admin\TopupController as AdminTopupController;

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

    Route::resources(([
        'kategori' => KategoriController::class,
        'produk' => BarangController::class,
    ]));

    Route::middleware(['auth'])->group(function () {
        Route::group(['prefix' => 'checkout'], function () {
            Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
            Route::get('alamats', [CheckoutController::class, 'loadAlamats'])->name('checkout.alamats');
            Route::get('kota', [CheckoutController::class, 'loadKota'])->name('checkout.loadKota');
            Route::post('ongkir', [CheckoutController::class, 'loadOngkir'])->name('checkout.loadOngkir');
            Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout.checkout');
            Route::get('pembayaran', [CheckoutController::class, 'pembayaran'])->name('checkout.pembayaran');
        });

        Route::patch('alamat/{alamat}/set-utama', [AlamatController::class, 'setUtama'])->name('user.alamat.setUtama');

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

        Route::resources([
            'topup' => TopupController::class,
            'keranjang' => KeranjangController::class,
            'profil' => ProfilController::class,
            'transaksi' => TransaksiController::class,
            'wishlist' => WishlistController::class
        ]);
    });
});

Route::group(['prefix' => 'toko', 'as' => 'toko.'], function () {
    Route::get('/', [TokoHomeController::class, 'index'])->name('hometoko');
    Route::resource('barang', TokoBarangController::class);
    Route::resource('akun', TokoAkunController::class);
    Route::resource('etalase', TokoEtalaseController::class);
    Route::resource('pesanan', TokoPesananController::class);
    Route::resource('riwayattransaksi', TokoRiwayatTransaksi::class);
    Route::resource('profil', TokoProfilController::class);
    Route::resource('rekening', TokoRekeningController::class);
    Route::resource('bank', TokoBankController::class);
    Route::resource('penarikan', TokoPenarikanController::class);
    Route::resource('pesananmasuk', TokoPesananMasukController::class);
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('home', [AdminHomeController::class, 'index'])->name('homeadmin');
    Route::resource('toko', AdminTokoController::class);
    Route::resource('member', AdminMemberController::class);
    Route::resource('verifikasibarang', AdminVerifikasiBarangController::class);
    Route::resource('verifikasitoko', AdminVerifikasiTokoController::class);
    Route::resource('topup', AdminTopupController::class);
});

require __DIR__ . '/auth.php';
