<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licenca extends Model
{
    // Atributos para o Mass Assignment

    protected $fillable = [ 'emissao', 'validade', 'empresa_id' ];
}
