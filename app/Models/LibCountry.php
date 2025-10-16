<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibCountry extends Model
{
    use BaseTrait;
    protected $table = "lib_countries";
    protected $fillable = [
        'name',
        'serial',
        'code',
        'store_by',
        'last_updated_by'
    ];
    //vpx_attach
}
