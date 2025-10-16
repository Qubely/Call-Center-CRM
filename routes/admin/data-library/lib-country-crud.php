<?php

use App\Http\Controllers\Admin\DataLibrary\Country\Crud\LibCountryCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/country',LibCountryCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/country/list',[LibCountryCrudController::class,'list']);
    Route::post('data-library/country/delete-list',[LibCountryCrudController::class,'deleteList']);
    Route::post('data-library/country/update-list',[LibCountryCrudController::class,'updateList']);
    //vpx_attach
});
