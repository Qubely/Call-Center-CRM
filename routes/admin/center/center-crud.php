<?php

use App\Http\Controllers\Admin\Center\List\Crud\CenterCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('center/list',CenterCrudController::class)->except(['destroy', 'show']);
    Route::post('center/list/list',[CenterCrudController::class,'list']);
    Route::post('center/list/delete-list',[CenterCrudController::class,'deleteList']);
    Route::post('center/list/update-list',[CenterCrudController::class,'updateList']);
    //vpx_attach
});
