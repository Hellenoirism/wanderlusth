    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\LandingController;
    use App\Http\Controllers\ReservasiController;
    use App\Http\Controllers\Admin\DashboardController;
    use App\Http\Controllers\Admin\ArmadaController;
    use App\Http\Controllers\Admin\FasilitasController;
    use App\Http\Controllers\Admin\ReservasiController as AdminReservasiController;
    use App\Http\Controllers\Admin\ProfileController;
    use App\Http\Controllers\Admin\LaporanController;
    use App\Http\Controllers\Admin\PembayaranController;

    /*
    |--------------------------------------------------------------------------
    | LANDING & GUEST
    |--------------------------------------------------------------------------
    */

    Route::get('/', [LandingController::class, 'index'])->name('landing');

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
    | AUTH (BREEZE)
    |--------------------------------------------------------------------------
    */
    require __DIR__ . '/auth.php';


    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['auth', 'isAdmin'])
        ->group(function () {

            Route::resource('fasilitas', FasilitasController::class)
            ->parameters(['fasilitas' => 'fasilitas']);
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');
            Route::get('/profile', [ProfileController::class, 'edit'])
                ->name('profile');
            Route::patch('/profile', [ProfileController::class, 'update'])
                ->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])
                ->name('profile.destroy');
            Route::resource('armada', ArmadaController::class);
            Route::resource('reservasi', AdminReservasiController::class)
                ->only(['index', 'create','store', 'show', 'update', 'destroy']);
            Route::resource('pembayaran', PembayaranController::class)
                ->only([
                    'index',
                    'store',
                    'show'
                ]);

            Route::get(
                '/pembayaran/create/{reservasi}',
                [PembayaranController::class, 'create']
            )->name('pembayaran.create');

            Route::get('/laporan', [LaporanController::class, 'index'])
                ->name('laporan.index');

            Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])
                ->name('laporan.pdf');
            

        Route::put(
            '/reservasi/{reservasi}/update-status',
            [AdminReservasiController::class, 'updateStatus']
        )->name('reservasi.update-status');
        });
