<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Depoimento extends Model
{
    protected $fillable = [
        'usuario_id',
        'nome',
        'nota',
        'comentario',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
