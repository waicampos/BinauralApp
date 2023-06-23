<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    // hasMany -> ofThat Model = retorna todos os registros de model que posuem this como chave_estrangeira
    // belongsToMany -> ofThat Model = retorna
    use HasFactory;


    /** Buscas de Projetos no Banco de Dados */
    public static function findActiveById($id) 
    {
        return Projeto::where('id', $id)->where('status_id', 1)->firstOrFail();
    }


    /** Buscas nas Chaves Estrangeiras */
    public function grupos() 
    {
        return $this->hasMany('App\Models\Grupo');
    }

    public function status() 
    {
        return $this->belongsTo('App\Models\Status');
    }

    // public function grupo($id) {
    //     $grupo = Grupo::where('projeto_id', $this->id)->where('numero', $id)->firstOrFail();
    //     // $sql = "SELECT * FROM grupos WHERE grupos.projeto_id = $this->id AND grupos.numero = $id";
    //     // preciso, dentro do projeto, dar um find or fail no grupo especificado pelo id (que no caso será o seu número, não o id de verdade)
    //     return $grupo;
    // }


    // https://laravel.com/docs/10.x/eloquent-relationships#many-to-many

    public function participantes() 
    {
        return $this->belongsToMany(User::class, 'participante_projeto');
    }

    public function equipe() 
    {
        //
    }


    /** Parte 'comum' a Projetos e Grupos */
    public function duracao() 
    {
        $inicio = date_create($this->data_inicio);
        $fim = date_create($this->data_fim);
        $diff = date_diff($inicio, $fim);
        $duracaoFormatada = [];
        if ($diff->y > 1) {
            $duracaoFormatada[] = $diff->format("%y anos");
        }
        if ($diff->m > 1) {
            $duracaoFormatada[] = $diff->format("%m meses");
        }
        if ($diff->d > 1) {
            $duracaoFormatada[] = $diff->format("%d dias");
        }
        return implode(", ", $duracaoFormatada);
        // Aqui deveria retornar um json
    }


    /** Parte 'comum' a Projetos, Grupos e Participantes */
    public function documentos() 
    {
        //
    }


    public function questionarios() 
    {
        //
    }


    public function eegs() 
    {
        //
    }


    public function binaurais() 
    {
        //
    }


    public function oficinasDatas() 
    {
        // 
    }


    public function oficinasLogs() 
    {
        //
    }


    public function isActive() 
    {
        return $this->status->isActive();
    }


    public function gerarAgenda() 
    {
        // a partir das datas das oficinas, gera uma lista ordenada com todas as datas
        // Gerar uma espécie de json
        // {"Projeto": "nome do projeto"; "Projeto Id": id; "Oficinas": [{"data": ; "Grupo_numero": ; "Grupo nome": }, ]}
    }


    /** Regras de Cadastro no Banco de Dados */
    public function cadastrarProjeto() 
    {
        return $this->save();
    }


}
