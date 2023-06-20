<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    protected $table = 'participante_projeto';

    public function user()
    {

    }

    public function binaural()
    {

    }

    public function projeto() 
    {

    }

    public function grupo()
    {

    }

    public function eegs() 
    {

    }

    public function questionarios () 
    {

    }

    public function proximaOficina()
    {

    }

    public function gerarAgenda ()
    {

    }

    public function idade() 
    {

    }

    public function autorizaUsoDeDados() 
    {

    }

    public function termoAutorizacao()
    {

    }

    public function enviarTermoPorEmail()
    {

    }

    public function cadastrarParticipante()
    {
        $this->save();
    }

}
