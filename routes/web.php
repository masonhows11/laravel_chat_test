<?php


use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome')->name('home');

Route::group(['middleware' => ['web','auth']], function () {

    Route::get('/chatroom', [ChatController::class,'index'])->name('chat.room');

});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__.'/auth.php';
