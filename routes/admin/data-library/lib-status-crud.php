<?php

use App\Http\Controllers\Admin\DataLibrary\SystemStatus\Crud\LibStatusCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/system-status',LibStatusCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/system-status/list',[LibStatusCrudController::class,'list']);
    Route::post('data-library/system-status/delete-list',[LibStatusCrudController::class,'deleteList']);
    Route::post('data-library/system-status/update-list',[LibStatusCrudController::class,'updateList']);
    //vpx_attach
});
