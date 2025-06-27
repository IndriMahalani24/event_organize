<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Guest Route (Tidak login)
|--------------------------------------------------------------------------
*/
Route::get('/guest', function () {
    return view('guest.guest');
})->name('guest');

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Redirect Root "/" Berdasarkan Role
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    switch ($user->role->id) {
        case 1:
            return redirect()->route('adminList');
        case 2:
        case 3:
        case 4:
            return redirect()->route('event.event');
        default:
            abort(403, 'Role tidak dikenali.');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/', function () {
//     return redirect()->route('event.event');
// });

Route::get('/event', function () {
            return view('event.event');
        })->name('event.event');
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
    Route::middleware(['role:1'])->prefix('adm')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('adminList');
        Route::get('/create', [AdminController::class, 'create'])->name('adminCreate');
        Route::post('/create', [AdminController::class, 'store'])->name('adminStore');
    });

    /*
    |-------------------------------
    | Event Routes (role_id = 2-4)
    |-------------------------------
    */
    Route::middleware(['role:2,3,4'])->group(function () {
        Route::get('/event', function () {
            return view('event.event');
        })->name('event.event');
    });
});
