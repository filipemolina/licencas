<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licenca extends Model
{
    // Atributos para o Mass Assignment

    protected $fillable = [ 'emissao', 'validade', 'empresa_id', 'renovada' ];

    // Relacionamento das Licenças com as empresas

    public function empresa()
    {
    	return $this->belongsTo('App\Empresa');
    }

    // Relacionamento das Licenças com o Tipo de Licença

    public function tipo()
    {
    	return $this->belongsTo('App\Tipo');
    }

    // Criar uma tag HTML mostrando o status atual da licença, baseada na data de vencimento.
    // [Vencida, à Vencer, Renovada ou OK]
    // Utilizada na view 'licenca.index'

    public function statusTag($classe)
    {
    	if($this->validade < date('Y-m-d'))
        {
            // Caso a validade seja menor do que a data atual, Vencida, à menos
            // que tenha sido renovada

            if($this->renovada)
            {
               return '<span class="label bg-blue '.$classe.'">Renovada</span>';
            }

            else
            {   
                return '<span class="label bg-red '.$classe.'">Vencida</span>';
            }
            
        }

        else if($this->validade >= date('Y-m-d') && $this->validade <= date('Y-m-d', strtotime('+6 months')))
        {
            // Caso a Validade seja maior do que a data atual e menor do que a 
            // data máxima permitida, À Vencer (A não ser que esteja renovada)

            if($this->renovada)
            {
                return '<span class="label bg-blue '.$classe.'">Renovada</span>';
            }
            else
            {
                return '<span class="label bg-yellow '.$classe.'">À Vencer</span>';
            }
        }
        else
        {
            // Caso contrário, a validade está OK

            return '<span class="label bg-green '.$classe.'">Ok</span>';
        }
    }
}
