<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    // Atributos para o Mass Assignment

    protected $fillable = [ 'cnpj', 'razao_social', 'telefone', 'contato' ];
}
