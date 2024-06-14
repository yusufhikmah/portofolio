<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\halamanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Expr\FuncCall;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('home','dashboard');

Route::get('/auth',[authController::class, "index"])->name('login')->middleware('guest');
Route::get('/auth/redirect', [authController::class, "redirect"])->middleware('guest');
Route::get('/auth/callback', [authController::class, "callback"])->middleware('guest');
Route::get('/auth/logout',[authController::class,"logout"]);

Route::get('/dashboard', function (){
    return view('dashboard.index');
});

Route::prefix('dashboard')->middleware('auth')->group(
    function(){
        Route::get('/',function(){
            return view('dashboard.layout');
        });
        Route::get('/',[halamanController::class, 'index']);
        Route::resource('halaman', halamanController::class);
    }
);