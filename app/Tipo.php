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

    public function numeral()
    {
    	switch($this->prazo)
            {
                case 1:
                    return "um";
                    break;
                case 2:
                    return "dois";
                    break;
                case 3:
                    return "três";
                    break;
                case 4:
                    return "quatro";
                    break;
                case 5:
                    return "cinco";
                    break;
                case 6:
                    return "seis";
                    break;
                case 7:
                    return "sete";
                    break;
                case 8:
                    return "oito";
                    break;
                case 9:
                    return "nove";
                    break;
                case 10:
                    return "dez";
                    break;
            }
    }
}
