<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibTimeZone extends Model
{
    use BaseTrait;
    protected $table = "lib_time_zones";
    protected $fillable = [
        'name',
        'serial',
        'store_by',
        'last_updated_by'
    ];
    //vpx_attach
}
