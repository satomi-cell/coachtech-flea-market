<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MypageController;

Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item_id}', [ItemController::class, 'show'])
    ->name('items.show');
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');
Route::get('/verify', function () {
    return view('auth.verify');
})->middleware('auth');
Route::post('/email/verification-notification', function () {
    auth()->user()->sendEmailVerificationNotification();
    return back();
})->middleware('auth')->name('verification.send');
Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->intended('/mypage/profile');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/verify-email', function () {
    $user = auth()->user();
    $user->email_verified_at = now();
    $user->save();
    return redirect('/mypage/profile');
})->middleware('auth');
Route::post('/items', [ItemController::class, 'store']);
Route::middleware('auth')->group(function () {
    Route::get('/sell', [ItemController::class, 'create']);
    Route::post('/sell', [ItemController::class, 'store']);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mypage/profile', function () {
        return view('mypage.profile');
    });
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mypage/profile', [ProfileController::class, 'edit']);
     Route::post('/mypage/profile', [ProfileController::class, 'update']);
});
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [MypageController::class, 'index']);
});