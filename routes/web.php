<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ExhibitionController;

Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item_id}', [ItemController::class, 'show'])
    ->name('items.show');
Route::post('/item/{item}/comment', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('comments.store');
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
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mypage', [MypageController::class, 'index']);
    Route::get('/mypage/profile', [ProfileController::class, 'edit']);
    Route::post('/mypage/profile', [ProfileController::class, 'update']);
});
Route::post('/item/{item}/like', [LikeController::class, 'store'])
    ->middleware('auth');
Route::delete('/item/{item}/like', [LikeController::class, 'destroy'])
    ->middleware('auth');
Route::middleware('auth')->group(function () {

    Route::get('/purchase/{item}', [PurchaseController::class, 'create'])
        ->name('purchase.create');
    Route::post('/purchase/{item}', [PurchaseController::class, 'store']);
    Route::get('/purchase/address/{item}', [PurchaseController::class, 'address']);
    Route::post('/purchase/address/{item}', [PurchaseController::class, 'updateAddress']);
    Route::get('/purchase/success/{item}', [PurchaseController::class, 'success'])
        ->name('purchase.success');

    Route::get('/purchase/cancel/{item}', [PurchaseController::class, 'cancel'])
        ->name('purchase.cancel');
});
Route::middleware('auth')->group(function () {
    Route::get('/sell', [ExhibitionController::class, 'create']);
    Route::post('/sell', [ExhibitionController::class, 'store']);
});