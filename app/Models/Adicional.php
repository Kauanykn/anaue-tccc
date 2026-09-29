<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    protected $table = 'adicionais';

    protected $fillable = [
        'nome',
        'descricao',
        'preco'
    ];
}
