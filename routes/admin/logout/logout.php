<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Logout\AdminLogoutController;

//vpx_imports

Route::get('admin/logout', [AdminLogoutController::class,'logout'])->name('admin.logout');

//vpx_attach
