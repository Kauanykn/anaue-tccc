<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    // O plural automático do Eloquent gera "adicionals", mas a tabela se chama "adicionais".
    protected $table = 'adicionais';

    protected $fillable = [
        'nome',
        'descricao',
        'preco'
    ];
}
