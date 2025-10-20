<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;

class AgentApplicationDoc extends Model
{
    use BaseTrait;
    protected $table = "agent_application_docs";
    //vpx_attach
    public function type()
    {
        return $this->hasOne(LibAgentDoc::class,'id','lib_agent_doc_id');
    }
}
