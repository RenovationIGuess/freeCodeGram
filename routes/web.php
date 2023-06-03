<?php

use App\Http\Controllers\FollowsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', [ProfilesController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Post
// Route::prefix('p')->group(function () {

// });

Route::post('/follow/{user}', [FollowsController::class, 'store']);

// If create is lower than {post} => conflict and create will be 404
Route::get('/', [PostsController::class, 'index']);
Route::get('/p/create', [PostsController::class, 'create']);
Route::get('/p/{post}', [PostsController::class, 'show']);
Route::post('/p', [PostsController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User
Route::get('/profile/{user}', [ProfilesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('profiles.show');
Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profiles.edit');
Route::patch('/profile/{user}', [ProfilesController::class, 'update'])->name('profiles.update');


// require __DIR__ . '/auth.php';

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
