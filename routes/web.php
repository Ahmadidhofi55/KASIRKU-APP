<?php

use App\Models\Jenis;
use App\Models\Merek;
use App\Models\Supliyer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MerekController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SupliyerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/* auth admin/login admin */
Route::middleware(['auth', 'user-access:kasir'])->group(function () {
    Route::get('/kasir/dash', [HomeController::class, 'kasir'])->name('kasir.kasir')->middleware('auth');
});

/* LOGIN MANAJER */
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::get('/owner/dash', [HomeController::class, 'owner'])->name('owner.owner')->middleware('auth');

});

Route::get('/profil',[HomeController::class,'profile'])->name('profil')->middleware('auth');
//get data transaksi
Route::get('/api/transaksi-count', [HomeController::class, 'getTransaksiCount'])->name('getTransaksiCount');

//pembayaran
Route::get('/pembayaran',[PembayaranController::class,'index'])->name('pembayaran.index')->middleware('auth');
Route::get('/pembayaran/read', [PembayaranController::class,'get'])->name('pembayaran.read')->middleware('auth');
Route::get('/pembayaran/show/{id}',[PembayaranController::class,'show'])->name('pembayaran.show')->middleware('auth');
Route::post('/pembayaran/store',[PembayaranController::class,'store'])->name('pembayaran.store')->middleware('auth');
Route::post('/pembayaran/update/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update')->middleware('auth');
Route::delete('/pembayaran/delete/{id}',[PembayaranController::class,'destroy'])->name('pembayaran.destroy')->middleware('auth');

//Jenis Produk
Route::get('/jenis',[JenisController::class,'index'])->name('jenis.index')->middleware('auth');
Route::get('/jenis/read', [JenisController::class,'get'])->name('jenis.read')->middleware('auth');
Route::get('/jenis/show/{id}',[JenisController::class,'show'])->name('jenis.show')->middleware('auth');
Route::post('/jenis/store',[JenisController::class,'store'])->name('jenis.store')->middleware('auth');
Route::post('/jenis/update/{id}', [JenisController::class, 'update'])->name('jenis.update')->middleware('auth');
Route::delete('/jenis/delete/{id}',[JenisController::class,'destroy'])->name('jenis.destroy')->middleware('auth');

//Merek Produk
Route::get('/merek',[MerekController::class,'index'])->name('merek.index')->middleware('auth');
Route::get('/merek/read', [MerekController::class,'get'])->name('merek.read')->middleware('auth');
Route::get('/merek/show/{id}',[MerekController::class,'show'])->name('merek.show')->middleware('auth');
Route::post('/merek/store',[MerekController::class,'store'])->name('merek.store')->middleware('auth');
Route::post('/merek/update/{id}', [MerekController::class, 'update'])->name('merek.update')->middleware('auth');
Route::delete('/merek/delete/{id}',[MerekController::class,'destroy'])->name('merek.destroy')->middleware('auth');

//Member
Route::get('/member',[MemberController::class,'index'])->name('member.index')->middleware('auth');
Route::get('/member/read', [MemberController::class,'get'])->name('member.read')->middleware('auth');
Route::get('/member/show/{id}',[MemberController::class,'show'])->name('member.show')->middleware('auth');
Route::post('/member/store',[MemberController::class,'store'])->name('member.store')->middleware('auth');
Route::post('/member/update/{id}', [MemberController::class, 'update'])->name('member.update')->middleware('auth');
Route::delete('/member/delete/{id}',[MemberController::class,'destroy'])->name('member.destroy')->middleware('auth');

//Produk
Route::get('/produk',[ProdukController::class,'index'])->name('produk.index')->middleware('auth');
Route::get('/produk/read', [ProdukController::class,'get'])->name('produk.read')->middleware('auth');
Route::get('/produk/show/{id}',[ProdukController::class,'show'])->name('produk.show')->middleware('auth');
Route::post('/produk/store',[ProdukController::class,'store'])->name('produk.store')->middleware('auth');
Route::post('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update')->middleware('auth');
Route::delete('/produk/delete/{id}',[ProdukController::class,'destroy'])->name('produk.destroy')->middleware('auth');

//Supliyer
Route::get('/supliyer',[SupliyerController::class,'index'])->name('supliyer.index')->middleware('auth');
Route::get('/supliyer/read', [SupliyerController::class,'get'])->name('supliyer.read')->middleware('auth');
Route::get('/supliyer/show/{id}',[SupliyerController::class,'show'])->name('supliyer.show')->middleware('auth');
Route::post('/supliyer/store',[SupliyerController::class,'store'])->name('supliyer.store')->middleware('auth');
Route::post('/supliyer/update/{id}', [SupliyerController::class, 'update'])->name('supliyer.update')->middleware('auth');
Route::delete('/supliyer/delete/{id}',[SupliyerController::class,'destroy'])->name('supliyer.destroy')->middleware('auth');


//Produk Reading
Route::get('/produk/reading', [ProdukController::class,'reading'])->name('produk.reading')->middleware('auth');

Route::get('/api/merek', function () {
    return Merek::all(['id', 'name']);
});

Route::get('/api/jenis', function () {
    return Jenis::all(['id', 'name']);
});

Route::get('/api/supliyer', function () {
    return Supliyer::all(['id', 'name']);
});
