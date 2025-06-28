<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
<<<<<<< Updated upstream
use App\Http\Controllers\GuestController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\RegistrationController;


// Guest & Member
Route::get('/', [GuestController::class, 'landing'])->name('landing');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Member only
Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('/events/{id}/order', [RegistrationController::class, 'order'])->name('events.order');
    Route::post('/events/{id}/order', [RegistrationController::class, 'store'])->name('events.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/registrations/{id}/upload', [RegistrationController::class, 'showUploadForm'])->name('registrations.upload');
    Route::post('/registrations/{id}/upload', [RegistrationController::class, 'uploadProof'])->name('registrations.upload.submit');
});

Route::middleware(['auth', 'role:keuangan'])->prefix('keuangan')->group(function () {
    Route::get('/registrasi', [FinanceController::class, 'index'])->name('finance.index');
    Route::post('/registrasi/{id}/approve', [FinanceController::class, 'approve'])->name('finance.approve');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
=======
use App\Http\Controllers\Auth\AuthenticatedSessionController;
>>>>>>> Stashed changes

/*
|--------------------------------------------------------------------------
| Guest Route (Tidak login)
|--------------------------------------------------------------------------
*/
// Route::get('/guest', function () {
//     return view('guest.guest');
// })->name('guest');

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Redirect Root "/login" Berdasarkan Role
|--------------------------------------------------------------------------
*/
<<<<<<< Updated upstream
// Route::get('/',[EventController::class, 'index']) -> name('event.index');

// Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
=======
// Route untuk halaman login (default)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

// Route dashboard setelah login
Route::get('/dashboard', function () {
    $user = Auth::user();
>>>>>>> Stashed changes

Route::get('/registrations/{id}/qr', [QrController::class, 'show'])->name('registrations.qr');
Route::middleware(['auth'])->get('/registrations/{id}/qr', [QrController::class, 'show'])->name('registrations.qr');

Route::middleware(['auth'])->get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Route::middleware(['auth'])->post('/events/{id}/register', [EventController::class, 'register'])->name('events.register');

Route::middleware(['auth'])->get('/registrations/{id}/qr', [QrController::class, 'show'])->name('registrations.qr');

// Route::middleware(['auth'])->get('/registrations/{id}/upload', [RegistrationController::class, 'showUploadForm'])->name('registrations.upload');
// Route::middleware(['auth'])->post('/registrations/{id}/upload', [RegistrationController::class, 'uploadProof'])->name('registrations.upload.submit');

Route::middleware(['auth', 'role:keuangan'])->group(function () {
    Route::get('/keuangan/registrasi', [FinanceController::class, 'index'])->name('finance.index');
});



// Route::middleware(['auth', 'role:keuangan'])->prefix('keuangan')->group(function () {
//     Route::get('/registrasi', [FinanceController::class, 'index'])->name('finance.index');
//     Route::post('/registrasi/{id}/approve', [FinanceController::class, 'approve'])->name('finance.approve');
// });

Route::get('/event', [EventController::class, 'index']);



Route::get('/dashboard', function () {
    return redirect()->route('landing');
})->name('dashboard');
// Route::get('/', function () {
//     if (!Auth::check()) {
//         return redirect('/event');
//     }

//     $user = Auth::user();

//     switch ($user->role->id) {
//         case 1:
//             return redirect()->route('adminList');
//         case 2:
//         case 3:
//         case 4:
//             return redirect()->route('event.event');
//         default:
//             abort(403, 'Role tidak dikenali.');
//     }
// })->middleware(['auth', 'verified'])->name('dashboard');


<<<<<<< Updated upstream
// Route::get('/event', function () {
//             return view('event.event');
//         })->name('event.event');
=======
Route::get('/', function () {
            return view('event.event');
        })->name('event.event');
>>>>>>> Stashed changes
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
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('adminEdit');
        Route::put('/edit/{id}', [AdminController::class, 'update'])->name('adminUpdate');
        Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('adminDestroy');
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
