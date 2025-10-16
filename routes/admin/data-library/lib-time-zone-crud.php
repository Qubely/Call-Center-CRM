<?php

use App\Http\Controllers\Admin\DataLibrary\TimeZone\Crud\LibTimeZoneCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/time-zone',LibTimeZoneCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/time-zone/list',[LibTimeZoneCrudController::class,'list']);
    Route::post('data-library/time-zone/delete-list',[LibTimeZoneCrudController::class,'deleteList']);
    Route::post('data-library/time-zone/update-list',[LibTimeZoneCrudController::class,'updateList']);
    //vpx_attach
});
