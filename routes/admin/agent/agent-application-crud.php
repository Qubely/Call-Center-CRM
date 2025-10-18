<?php

use App\Http\Controllers\Admin\Agent\Application\Crud\AgentApplicationCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('agent/application',AgentApplicationCrudController::class)->except(['destroy', 'show']);
    Route::post('agent/application/list',[AgentApplicationCrudController::class,'list']);
    Route::post('agent/application/delete-list',[AgentApplicationCrudController::class,'deleteList']);
    Route::post('agent/application/update-list',[AgentApplicationCrudController::class,'updateList']);
    //vpx_attach
});
