<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class Client extends Model
{
    use BaseTrait;
    protected $table = "clients";
    protected $fillable = [
        'name',
        //'serial'
    ];
    //vpx_attach
}
