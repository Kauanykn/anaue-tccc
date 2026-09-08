<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'aniversariante',
        'idade',
        'data_evento',
        'quantidade_convidados',
        'pacote',
        'observacoes',
        'mensagem',
        'status',
    ];

    protected $casts = [
        'data_evento' => 'date',
    ];

}
