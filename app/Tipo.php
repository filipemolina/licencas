<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
	// Mass Assignment

	protected $fillable = ['sigla', 'descricao', 'prazo'];

    // Relacionamento com as licenças

    public function licencas()
    {
    	return $this->hasMany('App\Licenca');
    }
}
