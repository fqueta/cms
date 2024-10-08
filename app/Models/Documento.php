<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Documento extends Model
{
    use HasFactory,Notifiable;
    protected $casts = [
        'config' => 'array',
    ];
    protected $fillable = [
        'token',
        'nome',
        'url',
        'tipo',
        'ativo',
        'autor',
        'config',
        'conteudo',
        'excluido',
        'reg_excluido',
        'deletado',
        'reg_deletado',
    ];
}
