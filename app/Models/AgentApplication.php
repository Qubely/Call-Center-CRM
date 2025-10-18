<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class AgentApplication extends Model
{
    use BaseTrait;
    protected $table = "agent_applications";
    protected $fillable = [
        'name',
        //'serial'
    ];
    //vpx_attach
}
