<?php

use App\Http\Controllers\Admin\Reset\AdminResetController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::get('admin/reset',[AdminResetController::class,'index'])->name('admin.reset');
Route::post('admin/reset/send-code',[AdminResetController::class,'sendCode']);
Route::post('admin/reset/verify-code',[AdminResetController::class,'verifyCode']);
Route::post('admin/reset/change-pass',[AdminResetController::class,'changePass']);
//vpx_attach

