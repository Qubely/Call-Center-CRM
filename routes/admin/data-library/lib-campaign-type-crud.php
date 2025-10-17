<?php

use App\Http\Controllers\Admin\DataLibrary\CampaignType\Crud\LibCampaignTypeCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/campaign-type',LibCampaignTypeCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/campaign-type/list',[LibCampaignTypeCrudController::class,'list']);
    Route::post('data-library/campaign-type/delete-list',[LibCampaignTypeCrudController::class,'deleteList']);
    Route::post('data-library/campaign-type/update-list',[LibCampaignTypeCrudController::class,'updateList']);
    //vpx_attach
});
