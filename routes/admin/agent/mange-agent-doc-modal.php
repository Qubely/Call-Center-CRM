<?php

use App\Http\Controllers\Admin\Agent\Application\Crud\Modal\MangeAgentDoc\MangeAgentDocModalController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::post('agent/application/crud/mange-agent-doc/display',[MangeAgentDocModalController::class,'display']);
    Route::post('agent/application/crud/mange-agent-doc/store',[MangeAgentDocModalController::class,'store']);
    Route::post('agent/application/crud/mange-agent-doc/delete',[MangeAgentDocModalController::class,'delete']);
    //vpx_attach
});
