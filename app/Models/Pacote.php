<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacote extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'duracao',
        'decoracao_inclusa',
        'imagem',
        'cardapio',
        'preco_semana_30',
        'preco_semana_50',
        'preco_fim_semana_30',
        'preco_fim_semana_50',
        'valor_excedente',
        'parcelas',
        'ativo',
    ];

    protected $casts = [
        'decoracao_inclusa' => 'boolean',
        'ativo' => 'boolean',
    ];
}
