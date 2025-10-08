<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Setup\AdminProfileSetupController;
use App\Http\Controllers\Admin\Setup\AdminUserSetupController;

//vpx_imports

//vpx_attach
Route::get('admin/setup/profile', [AdminProfileSetupController::class,'index'])->name('admin.profile.setup');
Route::post('admin/setup/profile', [AdminProfileSetupController::class,'update']);

Route::get('admin/setup/profile-update', [AdminUserSetupController::class,'index'])->name('admin.user.setup');
Route::post('admin/setup/profile-update', [AdminUserSetupController::class,'updateProfile']);

Route::get('admin/setup/password-update', [AdminUserSetupController::class,'password'])->name('admin.user.password');
Route::post('admin/setup/password-update', [AdminUserSetupController::class,'updatePassword']);


