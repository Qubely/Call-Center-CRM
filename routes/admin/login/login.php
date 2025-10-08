<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Login\AdminLoginController;

//vpx_imports

Route::get('admin/login', [AdminLoginController::class,'index'])->name('admin.login.index');
Route::post('admin/login', [AdminLoginController::class,'login'])->name('admin.login');

//vpx_attach
