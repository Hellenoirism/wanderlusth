<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArmadaController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\ReservasiController as AdminReservasiController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\LaporanController;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\ReservasiController;

/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])
    ->name('landing');

/*
|--------------------------------------------------------------------------
| RESERVASI CUSTOMER
|--------------------------------------------------------------------------
*/

Route::get('/reservasi', [ReservasiController::class, 'create'])
    ->name('reservasi.create');

Route::post('/reservasi', [ReservasiController::class, 'store'])
    ->name('reservasi.store');

Route::get(
    '/reservasi/success/{reservasi}',
    [ReservasiController::class, 'success']
)->name('reservasi.success');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth','verified', 'isAdmin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | PROFILE
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile');

        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::delete('/profile', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');

        /*
        |--------------------------------------------------------------------------
        | MASTER DATA
        |--------------------------------------------------------------------------
        */

        Route::resource('armada', ArmadaController::class);

        Route::resource('fasilitas', FasilitasController::class)
            ->parameters([
                'fasilitas' => 'fasilitas'
            ]);

        /*
        |--------------------------------------------------------------------------
        | RESERVASI
        |--------------------------------------------------------------------------
        */

        Route::resource('reservasi', AdminReservasiController::class)
            ->only([
                'index',
                'show',
                'destroy',
                'create',
                'store'
            ]);

        Route::put(
            '/reservasi/{reservasi}/update-status',
            [AdminReservasiController::class, 'updateStatus']
        )->name('reservasi.update-status');

    /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN
        |--------------------------------------------------------------------------
        */

    Route::resource('pembayaran', PembayaranController::class)
        ->except(['create', 'show']);

    Route::get(
        '/pembayaran/create/{reservasi}',
        [PembayaranController::class, 'create']
    )->name('pembayaran.create');

        /*
        |--------------------------------------------------------------------------
        | LAPORAN
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])
            ->name('laporan.pdf');
    });
