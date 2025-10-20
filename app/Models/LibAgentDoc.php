<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class LibAgentDoc extends Model
{
    use BaseTrait;
    protected $table = "lib_agent_docs";
    protected $fillable = [
        'name',
        //'serial'
    ];
    //vpx_attach
}
