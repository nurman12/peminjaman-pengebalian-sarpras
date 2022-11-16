<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\DraftController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SarprasController;
use App\Http\Controllers\SarprasKeluarController;
use App\Http\Controllers\SarprasMasukController;
use App\Http\Controllers\ValidasiController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'DONE';
});

// Route::get('/storage-link', function () {
//     $target  = '/home/sarprask/sarpras/storage/app/public';
//     $link    = '/home/sarprask/public_html/storage';
//     symlink($target, $link);
//     return 'DONE';
// });

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/', [DashController::class, 'welcome']);
Route::get('/dashboard', [DashController::class, 'index'])->name('dashboard');
Route::get('/barang', [DashController::class, 'barang']);
Route::get('/ruangan', [DashController::class, 'ruangan']);
Route::get('/sarpras_detail/{id}', [DashController::class, 'sarpras_detail']);
Route::post('/sarpras/search', [DashController::class, 'search']);
Route::get('/about', [DashController::class, 'about']);
Route::get('/contact', [DashController::class, 'contact']);
Route::get('/faqs', [DashController::class, 'faqs']);

Route::post('/draft', [DraftController::class, 'store'])->name('draft.store');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'cekroles:BMN'], function () {
        Route::get('/pengguna/export', [PenggunaController::class, 'userexport'])->name('pengguna.export');
        Route::post('/pengguna/import', [PenggunaController::class, 'userimport'])->name('pengguna.import');
        Route::post('/pengguna/{id}/edit', [PenggunaController::class, 'password']);

        Route::resource('pengguna', PenggunaController::class);
        Route::delete('pengguna_delete/{id}', [PenggunaController::class, 'delete']);
        Route::resource('sarpras', SarprasController::class);
        Route::delete('sarpras_delete/{id}', [SarprasController::class, 'delete']);
        Route::resource('sarpras_masuk', SarprasMasukController::class);
        Route::resource('sarpras_keluar', SarprasKeluarController::class);
        Route::resource('peminjaman', PeminjamanController::class)->except(['show']);
        Route::resource('pengembalian', PengembalianController::class)->except(['show']);
        Route::resource('rating', RatingController::class);
        Route::resource('bot', BotController::class);

        Route::post('/cek_qrcode', [DraftController::class, 'cek_qr_code']);
        Route::get('/validasi_edit/{id}', [ValidasiController::class, 'add_sarpras'])->name('validasi_edit.add');
        Route::post('/validasi_edit', [ValidasiController::class, 'store_add_sarpras'])->name('validasi_edit.store');
        Route::put('/validasi_edit/{id}', [ValidasiController::class, 'update_peminjaman'])->name('validasi_edit.update');
        Route::delete('/validasi_edit/{id}', [ValidasiController::class, 'destroy_sarpras'])->name('validasi_edit.destroy');
    });
    Route::group(['middleware' => 'cekroles:Mahasiswa,Dosen'], function () {
        Route::get('/permohonans', [DashController::class, 'permohonan']);
        Route::get('/peminjamans', [DashController::class, 'peminjaman']);
        Route::get('/pengembalians', [DashController::class, 'pengembalian']);

        Route::get('/draft_count', [DraftController::class, 'draft_count']);
        Route::get('/draft_count/{id}', [DraftController::class, 'draft_count_update']);
        Route::get('/draft/mini', [DraftController::class, 'mini_draft']);
        Route::post('/draft/mini/destroy/{id}', [DraftController::class, 'mini_draft_destroy']);
        Route::get('/draft_', [DraftController::class, 'draft_']);
        Route::get('/draft_update/{id}', [DraftController::class, 'draft_update']);
        Route::put('/draft_qty/{id}', [DraftController::class, 'update_qty']);
        Route::resource('draft', DraftController::class)->except(['store']);

        Route::post('/draft_update/{id}', [DraftController::class, 'draft_update_delete']);
        Route::post('/draft/print', [DraftController::class, 'print']);
    });
    Route::group(['middleware' => 'cekroles:BMN,Koordinator,KTU'], function () {
        Route::get('belum_validasi', [ValidasiController::class, 'belum_validasi']);
        Route::get('sudah_validasi', [ValidasiController::class, 'sudah_validasi']);

        Route::get('/l_kadaluarsa', [LaporanController::class, 'kadaluarsa']);
        Route::get('/l_ketersediaan', [LaporanController::class, 'ketersediaan']);
        Route::get('/l_kerusakan', [LaporanController::class, 'kerusakan']);
        Route::get('/l_peminjaman', [LaporanController::class, 'peminjaman']);
        Route::get('/l_pengembalian', [LaporanController::class, 'pengembalian']);
        Route::get('/getSarprasKembali/{id}', [LaporanController::class, 'getSarpras']);
        Route::get('/l_pengembalian/filter', [LaporanController::class, 'f_pegembalian']);
    });

    Route::resource('validasi', ValidasiController::class);
    Route::put('/validasi_update/{id}', [ValidasiController::class, 'update_lanjut']);

    Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
    Route::get('/pengembalian/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/edit', [ProfileController::class, 'index']);
    Route::get('/changePassword', [ProfileController::class, 'index']);
    Route::post('/edit/{id}', [ProfileController::class, 'update'])->name('update_profile');
    Route::post('/changePassword', [ProfileController::class, 'password'])->name('changePassword');
});
// Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
 


/*
|--------------------------------------------------------------------------
| Note
|--------------------------------------------------------------------------
| - Disini saya menggunakan Whatsapp API menggunakan Node.js
| - php artisan schedule:work
| - pak imron
*/