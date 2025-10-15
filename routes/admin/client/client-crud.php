<?php

use App\Http\Controllers\Admin\Client\ClientList\Crud\ClientCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('client/client-list',ClientCrudController::class)->except(['destroy', 'show']);
    Route::post('client/client-list/list',[ClientCrudController::class,'list']);
    Route::post('client/client-list/delete-list',[ClientCrudController::class,'deleteList']);
    Route::post('client/client-list/update-list',[ClientCrudController::class,'updateList']);
    //vpx_attach
});
