<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class Company extends Model
{
    use BaseTrait;
    protected $table = "companies";
    protected $fillable = [
        'name',
        'serial',
        'country',
        'time_zone',
        'address',
        'tax_id',
        'email',
        'store_by',
        'last_updated_by'
    ];
    //vpx_attach
}
