<?php

use App\Http\Controllers\Api\GoogleOauth2;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Auth::routes();


// 分类列表
Route::get('google/index', [GoogleOauth2::class, 'index']);
Route::get('google/callback', [GoogleOauth2::class, 'callback']);


Route::get('/auth/redirect', function () {
    return  Socialite::driver('google')->redirect();
});

Route::get('/auth/callback', function () {
    $code = request()->get('code');
    dump($code);

    $state = request()->get('state');
    dump($state);
});
