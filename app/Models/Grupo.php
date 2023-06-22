<?php

namespace App\Models;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    /** Buscas de Grupos no Banco de Dados */
    public static function findActive($projeto_id, $group_number) 
    {
        $grupo = Grupo::where('projeto_id', $projeto_id)->where('numero', $group_number)->where('status', 1)->firstOrFail();
        //$grupo = Grupo::where('projeto_id', $projeto_id)->where('numero', $group_number)->firstOrFail();
        // if ($grupo->isActive()) {
        //     return $grupo;
        // }
        return $grupo;
    }

    public function projeto() {
        return $this->belongsTo('App\Models\Projeto');
    }

    public function participantes() {
        //return $this->belongsToMany(User::class, 'participante_projeto', 'user_id', 'grupo_id', 'numero');
        // Precisaria setar que quero pegar 
    }

    public function status() {
        return $this->belongsTo('App\Models\Status');
    }

    public function dia() {
        return $this->belongsTo('App\Models\Dia', 'oficina_dia');
    }

    /** Métodos específicos de Grupo */

    public function hasVaga() {
        //return $this->max_participantes < count($this->participantes);
    }


    /** Parte 'comum' a Projetos e Grupos */
    public function duracao() 
    {
        return $this->projeto->getDuracao();
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
        return json_encode([
            "Dia_Id" => $this->dia->id, 
            "Dia_Nome" => $this->dia->nome,
            "Horario" => $this->oficina_horario
        ]);
    }


    public function traduzirDias($diaIngles) {
        $dict = [
            "sunday" => "Domingo",
            "monday" => "Segunda-feira",
            "tuesday" => "Terça-feira",
            "wednesday" => "Quarta-feira",
            "thursday" => "Quinta-feira",
            "friday" => "Sexta-feira",
            "saturday" => "Sábado",
        ];
        return $dict[$diaIngles];
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
        // Aqui vai pegar as datas
        // Vai marcar os feriados
        // Vai marcar as datasCanceladas
        // Vai retornar a agenda
        $startDate = Carbon::today()->toDateString();
        $endDate = $this->projeto->fim;
        $weekday = $this->dia->nome;

        return $this->gerarDatas($startDate, $endDate, $weekday);
    }

    public function marcarFeriado()
    {
        // Pega uma data; marca ela como feriado
        // Precisa salver isto em algum lugar no banco de dados, certo...
    }

    public function cancelarDataOficina()
    {
        // Pega uma data e marca ela como cancelada
        // Precisa salvar isto no banco de dados
    }


    public function gerarDatas($startDate, $endDate, $weekday) 
    {

        $hora = $this->oficina_horario;

        $endDate = date_create($endDate . " " . $hora);
        date_modify($endDate, "+1 day");
        $endDate = date_format($endDate,"Y-m-d");
        
        $datePeriod = new DatePeriod(
            new DateTime("$weekday $startDate $hora"),
            DateInterval::createFromDateString("next $weekday"),
            new DateTime("$weekday $endDate")
        );

        $datelist = [];
        foreach($datePeriod as $date) {
            $datelist[] = $date;
        }

        return $datelist;

    }

    public function proximaOficina() 
    {
        // Gera datas pela agenda
        // Retorna a oficina
        // Caso a próxima seja feriado, manda aviso também
        $datas = $this->gerarAgenda();
        return $datas[0];

    }


    /** Regras de Cadastro no Banco de Dados */
    public function cadastrarGrupo() 
    {
        return $this->save();
    }
    

}
