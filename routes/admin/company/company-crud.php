<?php

use App\Http\Controllers\Admin\Company\List\Crud\CompanyCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('company/list',CompanyCrudController::class)->except(['destroy', 'show']);
    Route::post('company/list/list',[CompanyCrudController::class,'list']);
    Route::post('company/list/delete-list',[CompanyCrudController::class,'deleteList']);
    Route::post('company/list/update-list',[CompanyCrudController::class,'updateList']);
    //vpx_attach
});
