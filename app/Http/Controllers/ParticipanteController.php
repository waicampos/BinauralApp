<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Participante;
use App\Models\ParticipanteDTO;
use App\Models\Projeto;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    
    public function iniciarCadastro($projeto_id, $grupo_numero) {
        $user = auth()->user();
        
        $projeto = Projeto::findActiveById($projeto_id);
        $grupo = Grupo::findActive($projeto_id, $grupo_numero);
        
        $userDTO = new ParticipanteDTO();
        $userDTO->nome = $user->name;
        $userDTO->projeto_id = $projeto->id;
        $userDTO->projeto_nome = $projeto->nome;
        $userDTO->grupo = $grupo->numero;
        
        session(['user' => $userDTO]);
        return view('cadastro_participante.iniciar');
    }


    public function indicadores(Request $request) {
        
        session('user')->genero = $request->genero;
        session('user')->cor = $request->cor;
        session('user')->documento = $request->documento;
     
        return redirect('/aviso_termo');
    }


    public function autorizacao(Request $request) {

        session('user')->autorizacao = $request->autorizacao;

        return redirect('/questionario_inicial');
    }


    public function questionario (Request $request) {

        session('user')->questionario = $request->questionario;

        return redirect('/finalizar_cadastro');
    }

    public function finalizarCadastro(Request $request) {
        // Agora aqui tem que fazer algumas coisas
        // Atualizar a tabela de usuário se ele mudar seus dados (deixa isso pra parte de autenticação)
        // Atualizar a tabela participante_projeto
        // Um participante de um projeto tem:
        // user_id, indicadores (como vai armazenar)
        // autoriza ou não
        // questionário inicial
        // Atualizar a tabela questionário
        // Vamos, primeiro, atualizar a tabela participante_projeto

        $user = auth()->user();
        
        $participante = new Participante();
        $participante->user_id = $user->id;
        $participante->projeto_id = session('user')->projeto_id;
        $participante->grupo_id = session('user')->grupo;
        $participante->playlist_url = "";
        $participante->autoriza_uso_dados = session('user')->autorizacao;
        $participante->status_id = 1;
        
        $participante->save();
        
        // Aí, preciso criar uma DTO do usuário, que vai sendo modificada?

        // Salvar o questionário
        // Primeiro, vamos fazer do jeito mais fácil
        // Deixar uma tabela com as respostas apenas
        // Tabela questionário_perguntas
        // Texto perguntas
        // Tipo (text, radio, checklist, date, number)
        // Opções de resposta
        // Deixar isso para quando a Cris tiver o questionário!

        // return redirect ('/profile');

    }

}
