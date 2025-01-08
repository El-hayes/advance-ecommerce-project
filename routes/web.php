<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BackEnd\AdminProfileController;
use App\Http\Controllers\FrontEnd\IndexController;
use Illuminate\Support\Facades\Auth;


Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});


// All Admin Routes
Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');})->name('dashboard');
});

// admin logout
Route::get('admin/logout', [adminController::class, 'destroy'])->name('admin.logout');
// admin profile view
Route::get('admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
// Admin profile Edit
Route::get('admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
// Admin profile Store
Route::post('admin/profile/store', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');
// Admin Change password
Route::get('admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');
// Update Change password
Route::post('update/change/password', [AdminProfileController::class, 'adminUpdateChangePassword'])->name('update.change.password');





// // All user Routes

Route::middleware([
    'auth:sanctum,web',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $userData = User::find(Auth::user()->id);
        return view('dashboard', compact('userData'));})->name('dashboard');
});

Route::get('/', [IndexController::class, 'index'])->name('home');

// user logout
Route::get('user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
// user profile
Route::get('user/profile', [IndexController::class, 'userProfile'])->name('user.profile');
// update user profile
Route::post('user/profile/store', [IndexController::class, 'userProfileStore'])->name('user.profile.store');
// change user password
Route::get('user/change/password', [IndexController::class, 'userChangePassword'])->name('user.change.password');
// user password update
Route::post('user/password/update', [IndexController::class, 'userPasswordUpdate'])->name('user.password.update');
