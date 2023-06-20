<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipanteDTO extends Model
{
    use HasFactory;

    public $nome;
    public $sobrenome;
    public $data_nascimento;
    public $projeto_nome;
    public $projeto_id;
    public $indicadores = ['genero' => null, 'cor' => null];
    public $grupo_numero;
    public $documento;
    public $autorizacao;
    public $playlist_uri;
    public $questionario_inicial = ['sentimento' => null];

}
