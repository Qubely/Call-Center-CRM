<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class Center extends Model
{
    use BaseTrait;
    protected $table = "centers";
    protected $fillable = [
        'name',
        'address',
        'image',
        'extension'
    ];
    //vpx_attach
    public function adminUsers()
    {
        return $this->hasMany(AdminUser::class,'center_id','id');
    }
}
