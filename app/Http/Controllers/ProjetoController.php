<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Projeto;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    
    public function cadastrarParticipante(Request $request, $projeto_id, $grupo_id) {
        $projeto = Projeto::findOrFail($projeto_id);
        $grupo = $projeto->grupo($grupo_id);
        $request->session()->put('projeto', $projeto);
        $request->session()->put('grupo', $grupo);
        return view('projetos.cadastro_participante.tela_01', ['request' => $request]);
    }

    public function cadastrarParticipanteIndicadores(Request $request) {

        $request->session()->put('data_nascimento', $request->data_nascimento);
        $request->session()->put('genero', $request->genero);
        $request->session()->put('cor', $request->cor);
        
        return view('projetos.cadastro_participante.tela_03', ['request' => $request]);

    }

    public function cadastrarParticipanteAutorizacao(Request $request) {
        $request->session()->put('autorizacao', $request->autorizacao);
        return view('projetos.cadastro_participante.tela_05', ['request' => $request]);
    }

    public function cadastrarParticipanteQuestionario (Request $request) {
        $request->session()->put('sentimento', $request->sentimento);
        return view('projetos.cadastro_participante.tela_06', ['request' => $request]);
    }







    public function verProjeto($projeto_id) {
        $projeto = Projeto::findOrFail($projeto_id);
        return view('projetos.ver_projeto', ['projeto' => $projeto]);
    }

    public function verGrupo($grupo_id) {
        $grupo = Grupo::findOrFail($grupo_id);
        return view('projetos.ver_grupo', ['grupo' => $grupo]);
    }

}
