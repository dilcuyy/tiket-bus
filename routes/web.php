<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuteBusController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\AdminReviewController;
use App\Models\Booking;

// ===========================
// Halaman Pencarian & Proses
// ===========================
Route::get('/', [RuteBusController::class, 'index'])->name('beranda');
Route::post('/cari', [RuteBusController::class, 'cari'])->name('cari.tiket');
Route::get('/hasil', [RuteBusController::class, 'hasil'])->name('hasil.pencarian');

// ===========================
// Booking dan Konfirmasi
// ===========================
Route::get('/booking/{rute_id}', [BookingController::class, 'showBookingForm'])->name('booking.form');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/konfirmasi/{id}', [BookingController::class, 'konfirmasi'])->name('konfirmasi');
Route::get('/riwayat', [BookingController::class, 'riwayat'])->name('riwayat');

// ===========================
// API Endpoint untuk Kursi
// ===========================
Route::get('/api/kursi/{ruteId}', function ($ruteId) {
    return Booking::where('rute_bus_id', $ruteId)
        ->pluck('kursi')
        ->map(fn($k) => (string) $k)
        ->values();
});

// ===========================
// Halaman Rute (Publik)
// ===========================
Route::get('/rute', [RuteBusController::class, 'listRute'])->name('rute.index');

// ===========================
// Halaman Kontak
// ===========================
Route::get('/kontak', [KontakController::class, 'form'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'kirim'])->name('kontak.kirim');

// ===========================
// Admin Routes
// ===========================
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [RuteBusController::class, 'admin'])->name('dashboard');

    // Rute CRUD
    Route::get('/rute/create', [RuteBusController::class, 'create'])->name('rute.create');
    Route::post('/rute', [RuteBusController::class, 'store'])->name('rute.store');
    Route::get('/rute/{id}/edit', [RuteBusController::class, 'edit'])->name('rute.edit');
    Route::put('/rute/{id}', [RuteBusController::class, 'update'])->name('rute.update');
    Route::delete('/rute/{id}', [RuteBusController::class, 'destroy'])->name('rute.delete');

    // Booking admin
    Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('bookings');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    // Review (dari tabel kontaks)
    Route::get('/review', [AdminReviewController::class, 'index'])->name('review.index');
    Route::delete('/review/{id}', [AdminReviewController::class, 'destroy'])->name('review.destroy');
});

// Pilih satu aja, ini udah cukup:
Route::get('/booking/{id}/pdf', [BookingController::class, 'generatePdf']);
