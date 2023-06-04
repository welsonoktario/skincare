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

use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\TokoController as AdminTokoController;
use App\Http\Controllers\admin\VerifikasiBarang as AdminVerifikasiBarangController;
use App\Http\Controllers\admin\MemberController as AdminMemberController;
use App\Http\Controllers\admin\TopupController as AdminTopupController;
use App\Http\Controllers\toko\BarangController as TokoBarangController;
use App\Http\Controllers\toko\HomeController as TokoHomeController;

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
    Route::get('/toko/{toko}', [TokoController::class, 'index'])->name('toko.index');

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
            Route::get('/alamat', [AlamatController::class, 'findAll']);
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
    // skincare.com/toko/akun
    Route::get('/', [TokoHomeController::class, 'index'])->name('hometoko');
    Route::resource('barang', TokoBarangController::class);
    Route::resource('akun', TokoAkunController::class);
    Route::resource('etalase', TokoEtalaseController::class);
    Route::resource('pesanan', TokoPesananController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('home', [AdminHomeController::class, 'index'])->name('homeadmin');
    Route::resource('toko', AdminTokoController::class, ['as' => 'admin']);
    Route::resource('member', AdminMemberController::class, ['as' => 'admin']);
    Route::resource('verifikasibarang', AdminVerifikasiBarangController::class, ['as' => 'admin']);
    Route::resource('topup', AdminTopupController::class, ['as' => 'admin']);
});


require __DIR__ . '/auth.php';
