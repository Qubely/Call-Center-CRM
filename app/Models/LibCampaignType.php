<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibCampaignType extends Model
{
    use BaseTrait;
    protected $table = "lib_campaign_types";
    protected $fillable = [
        'name',
        //'serial'
    ];
    //vpx_attach
}
