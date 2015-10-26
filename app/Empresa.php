<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    // Atributos para o Mass Assignment

    protected $fillable = [ 'cnpj', 'razao_social', 'nome_fantasia', 'inscricao_estadual', 'telefone', 'contato' ];

    ////////////// Relacionamentos

    // Licenças dessa Empresa

    public function licencas()
    {
    	return $this->hasMany('App\Licenca');
    }

    // Contato da Empresa

    public function contato()
    {
    	return $this->belongsTo('App\Pessoa');
    }

    // Representantes dessa Empresa

    public function representante_1()
    {
    	return $this->belongsTo('App\Pessoa', 'representante_1_id');
    }

	public function representante_2()
    {
    	return $this->belongsTo('App\Pessoa', 'representante_2_id');
    }

    // Endereços dessa Empresa

    public function endereco_requerente()
    {
    	return $this->belongsTo('App\Endereco', 'endereco_requerente_id');
    }

    public function endereco_empreendimento()
    {
    	return $this->belongsTo('App\Endereco', 'endereco_empreendimento_id');
    }

    public function endereco_correspondencia()
    {
    	return $this->belongsTo('App\Endereco', 'endereco_correspondencia_id');
    }
}
