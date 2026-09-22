<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $fillable = [
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
