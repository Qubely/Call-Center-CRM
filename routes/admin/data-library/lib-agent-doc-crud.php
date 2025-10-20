<?php

use App\Http\Controllers\Admin\DataLibrary\AgentDoc\Crud\LibAgentDocCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/agent-doc',LibAgentDocCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/agent-doc/list',[LibAgentDocCrudController::class,'list']);
    Route::post('data-library/agent-doc/delete-list',[LibAgentDocCrudController::class,'deleteList']);
    Route::post('data-library/agent-doc/update-list',[LibAgentDocCrudController::class,'updateList']);
    //vpx_attach
});
