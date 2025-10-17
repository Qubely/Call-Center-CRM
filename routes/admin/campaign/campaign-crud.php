<?php

use App\Http\Controllers\Admin\Campaign\List\Crud\CampaignCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('campaign/list',CampaignCrudController::class)->except(['destroy', 'show']);
    Route::post('campaign/list/list',[CampaignCrudController::class,'list']);
    Route::post('campaign/list/delete-list',[CampaignCrudController::class,'deleteList']);
    Route::post('campaign/list/update-list',[CampaignCrudController::class,'updateList']);
    //vpx_attach
});
