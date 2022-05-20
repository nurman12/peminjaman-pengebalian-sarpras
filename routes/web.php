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
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/pengguna/export', [PenggunaController::class, 'userexport'])->name('pengguna.export');
Route::post('/pengguna/import', [PenggunaController::class, 'userimport'])->name('pengguna.import');
Route::resource('pengguna', PenggunaController::class);
Route::post('/pengguna/{id}/edit', [PenggunaController::class, 'password']);

Route::get('/', [DashController::class, 'welcome']);
Route::get('/dashboard', [DashController::class, 'index'])->name('dashboard');
Route::get('/barang', [DashController::class, 'barang']);
Route::get('/ruangan', [DashController::class, 'ruangan']);
Route::get('/sarpras_detail/{id}', [DashController::class, 'sarpras_detail']);
Route::get('/about', [DashController::class, 'about']);
Route::get('/contact', [DashController::class, 'contact']);
Route::get('/faqs', [DashController::class, 'faqs']);

Route::get('/draft_count', [DraftController::class, 'draft_count']);
Route::get('/draft_count/{id}', [DraftController::class, 'draft_count_update']);
Route::get('/draft/mini', [DraftController::class, 'mini_draft']);
Route::post('/draft/mini/destroy/{id}', [DraftController::class, 'mini_draft_destroy']);
Route::get('/draft_', [DraftController::class, 'draft_']);
Route::get('/draft_update/{id}', [DraftController::class, 'draft_update']);
Route::put('/draft_qty/{id}', [DraftController::class, 'update_qty']);
Route::resource('draft', DraftController::class);
Route::post('/draft_update/{id}', [DraftController::class, 'draft_update_delete']);
Route::post('/draft/print', [DraftController::class, 'print']);
Route::post('/cek_qrcode', [DraftController::class, 'cek_qr_code']);

Route::resource('sarpras', SarprasController::class);

Route::resource('sarpras_masuk', SarprasMasukController::class);

Route::resource('sarpras_keluar', SarprasKeluarController::class);

Route::get('/expired_validasi', [ValidasiController::class, 'expired_validasi'])->name('expired_validasi');
Route::resource('validasi', ValidasiController::class);
Route::put('/validasi_update/{id}', [ValidasiController::class, 'update_lanjut']);
Route::get('/validasi_edit/{id}', [ValidasiController::class, 'add_sarpras'])->name('validasi_edit.add');
Route::post('/validasi_edit', [ValidasiController::class, 'store_add_sarpras'])->name('validasi_edit.store');
Route::put('/validasi_edit/{id}', [ValidasiController::class, 'update_peminjaman'])->name('validasi_edit.update');
Route::delete('/validasi_edit/{id}', [ValidasiController::class, 'destroy_sarpras'])->name('validasi_edit.destroy');

Route::resource('peminjaman', PeminjamanController::class);

Route::resource('pengembalian', PengembalianController::class);

Route::get('belum_validasi', [ValidasiController::class, 'belum_validasi']);
Route::get('sudah_validasi', [ValidasiController::class, 'sudah_validasi']);

Route::resource('rating', RatingController::class);

Route::get('/ketersediaan', [LaporanController::class, 'ketersediaan']);
Route::get('/kerusakan', [LaporanController::class, 'kerusakan']);

Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/edit', [ProfileController::class, 'index']);
Route::get('/changePassword', [ProfileController::class, 'index']);
Route::post('/edit/{id}', [ProfileController::class, 'update'])->name('update_profile');
Route::post('/changePassword', [ProfileController::class, 'password'])->name('changePassword');

// Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);

Route::post('/bot', [BotController::class, 'response'])->name('bot');

Route::get('/perangkat', [WhatsAppController::class, 'perangkat']);
Route::put('/perangkat', [WhatsAppController::class, 'update_sender']);
Route::put('/perangkats', [WhatsAppController::class, 'restart']);

Route::get('/message', [WhatsAppController::class, 'message']);
Route::get('/schedule', [WhatsAppController::class, 'schedule']);


/*
|--------------------------------------------------------------------------
| Note
|--------------------------------------------------------------------------
| - Disni saya menggunakan layanan WhatsApp Gateway dari wablas
|
|
*/