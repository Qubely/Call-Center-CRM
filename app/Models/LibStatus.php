<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibStatus extends Model
{
    use BaseTrait;
    protected $table = "lib_statuses";
    protected $fillable = [
        'status_for',
        'name',
    ];
    //vpx_attach
}
