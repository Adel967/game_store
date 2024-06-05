<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\UserSelectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/user-selection', [UserSelectionController::class, 'index'])->name('user_selection');

// Route::get('/conversation/{user?}', [ConversationController::class, 'index'])->name('conversation');

// Route::middleware(['auth', 'filament'])->group(function () {
//     Route::get('/admin/conversation/{user?}', [ConversationController::class, 'index'])->name('conversation');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/conversation/{user?}', [ConversationController::class, 'index'])->name('conversation');
});
