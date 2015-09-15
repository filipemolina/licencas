<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Relacionamento com usuários

    public function users()
    {
    	return $this->hasMany('App\Users');
    }
}
