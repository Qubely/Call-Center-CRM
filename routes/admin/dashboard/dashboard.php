<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;

//vpx_imports

Route::get('admin/dashboard', [AdminDashboardController::class,'index'])->name('admin.dashboard.index');

//vpx_attach
