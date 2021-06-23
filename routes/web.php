<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/logout', function () {
    Auth::logout();
    return Redirect::route('login');
})->name('logout'); 

Route::middleware('auth')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
