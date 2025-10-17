<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class Campaign extends Model
{
    use BaseTrait;
    protected $table = "campaigns";
    protected $casts = [
        'validity' => 'date:Y-m-d',
        'billing_rate' => 'double',
        'payout_rate' => 'double',
    ];
    protected $fillable = [
        'name',
        'client_id',
        'type',
        'country',
        'billing_rate',
        'payout_rate',
        'validity',
    ];
    //vpx_attach
}
