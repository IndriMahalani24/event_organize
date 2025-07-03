<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


// Guest & Member
Route::get('/', [GuestController::class, 'landing'])->name('landing');

Route::middleware(['auth'])->group(function () {
    Route::get('/registrations/{id}/upload', [RegistrationController::class, 'showUploadForm'])->name('registrations.upload');
    Route::post('/registrations/{id}/upload', [RegistrationController::class, 'uploadProof'])->name('registrations.upload.submit');
});

Route::middleware(['auth'])->get('/registrations/{id}/qr', [QrController::class, 'show'])->name('registrations.qr');

Route::middleware(['auth'])->get('/events/{id}', [EventController::class, 'show'])->name('events.show');

/*
|--------------------------------------------------------------------------
| Root
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/dashboard', function () {
    $user = Auth::user();
    switch ($user->role->id) {
        case 1:
            return redirect()->route('adminList');
        case 2:
            return redirect()->route('landing');
        case 3:
            return redirect()->route('landing');   
        case 4:
            return redirect()->route('events.index');
        default:
            abort(403, 'Role tidak dikenali.');
    }
})->middleware(['auth', 'verified'])->name('dashboard');
/*
|--------------------------------------------------------------------------
| Protected Routes (Butuh Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    /*
    |-------------------------------
    | Profile Routes
    |-------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |-------------------------------
    | Admin Routes (role_id = 1)
    |-------------------------------
    */
    Route::middleware(['rolee:1'])->prefix('adm')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('adminList');
        Route::get('/create', [AdminController::class, 'create'])->name('adminCreate');
        Route::post('/create', [AdminController::class, 'store'])->name('adminStore');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('adminEdit');
        Route::put('/edit/{id}', [AdminController::class, 'update'])->name('adminUpdate');
        Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('adminDestroy');
    });

      /*
    |-------------------------------
    | Admin Routes (role_id = 2)
    |-------------------------------
    */

    Route::middleware(['auth', 'rolee:2'])->prefix('panitia')->group(function () {
        Route::get('/event', [PanitiaController::class, 'index'])->name('panitia.event.index');
        Route::get('/event/create', [PanitiaController::class, 'create'])->name('panitia.event.create');
        Route::post('/event/create', [PanitiaController::class, 'store'])->name('panitia.event.store');
        Route::get('/event/edit/{id}', [PanitiaController::class, 'edit'])->name('panitia.event.edit');
        Route::put('/event/edit/{id}', [PanitiaController::class, 'update'])->name('panitia.event.update');
    });

    Route::middleware(['auth', 'rolee:3'])->prefix('keuangan')->group(function () {
        Route::get('/registrasi', [FinanceController::class, 'index'])->name('finance.index');
        Route::post('/registrasi/{id}/approve', [FinanceController::class, 'approve'])->name('finance.approve');
    });

    Route::middleware(['auth', 'rolee:4'])->prefix('member')->group(function () {
        Route::get('/events/{id}/order', [RegistrationController::class, 'order'])->name('events.order');
        Route::post('/events/{id}/order', [RegistrationController::class, 'store'])->name('events.store');
    });


    /*
    |-------------------------------
    | Event Routes (role_id = 4)
    |-------------------------------
    */
    Route::middleware(['rolee:2,3,4'])->group(function () {
        Route::get('/events', [EventController::class, 'index'])->name('events.index');
        Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
    });
});

require __DIR__ . '/auth.php';