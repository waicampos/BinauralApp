<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Participante;
use App\Models\ParticipanteDTO;
use App\Models\Projeto;
use Exception;
use Illuminate\Http\Request;

class CadastroParticipanteController extends Controller
{

    public $viewsFolder = 'cadastro_participante.';
    public $views = [
        1 => 'inicio',
        2 => 'indicadores',
        3 => 'aviso_termo',
        4 => 'termo',
        5 => 'questionario',
        6 => 'playlist',
        7 => 'revisar',
    ];

    public $actualView;

    public Request $request;
    public $paginaAtual;
    public $dto;

    public $log = [];
   

    public function iniciar($projeto_id, $grupo_numero) 
    {
        // Aqui tem que fazer o esquema de ver se existe o projeto e o grupo
        // FindOrFail projeto
        // FindOrFail grupo
        $projeto = new Projeto();
        $grupo = new Grupo();
        $projeto = $projeto->findActiveById($projeto_id);
        $grupo = $grupo->findActive($projeto->id, $grupo_numero);

        $this->dto = new ParticipanteDTO();
        $this->dto->projeto_id = $projeto->id;
        $this->dto->grupo_numero = $grupo->numero;

        $this->paginaAtual = 1;

        $this->atualizarSessao();

        $this->gerarActualView();

        return view($this->actualView);
    }


    public function cadastrar(Request $request) 
    {       
        $this->atualizarAtributos($request);

        $this->popularDTO();

        if(isset($this->request['finalizar'])) {
            $this->finalizar();
        }

        $this->atualizarPaginaAtual();

        $this->atualizarSessao();

        $this->gerarActualView();

        return view($this->actualView, ['request' => $this->request, 'dto' => $this->dto, 'log' => $this->log]);

        //return view('cadastro_participante.indicadores');

    }


    public function atualizarAtributos(Request $request) 
    {
        $this->request = $request;
        $this->dto = session('dto');
        $this->paginaAtual = session('paginaAtual');
    }


    public function popularDTO() 
    {
        try {
            foreach($this->request->DTO as $attr => $value) {
                if(property_exists($this->dto, $attr)) {
                    $this->dto->$attr = $value;
                    //$this->log[] = "cheguei na 89;
                }
            }    
        }
        catch (Exception $e) {
            return;
        }
    }


    public function atualizarSessao()
    {
        session([
            'paginaAtual' => $this->paginaAtual, 
            'dto' => $this->dto
        ]);
    }


    public function atualizarPaginaAtual()
    {
        if (isset($this->request['avancar'])) {
            $this->paginaAtual = session('paginaAtual') + 1;
        }
        else if (isset($this->request['voltar'])) {
            $this->paginaAtual = session('paginaAtual') - 1;
        }
    }


    public function gerarActualView() 
    {
        $this->actualView = $this->viewsFolder . $this->views[$this->paginaAtual];
    }


    public function finalizar()
    {
        $user = auth()->user();
        $participante = new Participante();

        // Então, aqui, fazer a correspondência entre o DTO e a tabela participantes
        // $table->foreignId('user_id')->constrained();
        // $table->foreignId('projeto_id')->constrained();
        // $table->foreignId('grupo_id')->constrained();
        // $table->string('playlist_url')->nullable();
        // $table->boolean('autoriza_uso_dados');
        // $table->foreignId('status_id')->constrained(table: 'status', column: 'id');
        // $table->timestamps();

        // DTO
        // public $nome;
        // public $sobrenome;
        // public $data_nascimento;
        // public $projeto_nome;
        // public $projeto_id;
        // public $indicadores = ['genero' => null, 'cor' => null];
        // public $grupo_numero;
        // public $documento;
        // public $autorizacao;
        // public $playlist_uri;
        // public $questionario_inicial = ['sentimento' => null];

        // As classes ainda não estão alinhadas...
        // Devido ao User

        // Supondo que eu tenha um user com os atributos:
        // id
        // nome
        // data_nascimento

        // São estas tabelas que precisa atualizar:
        // participante_projeto
        // indicadores (precisa iterar)
        // questionario (precisa iterar)

        // Tabela indicadores vai precisar: (como teste)
        // id_projeto
        // id_grupo
        // id_participante
        // genero (ia ter que ter outra tabela) (vamos fazer do jeito simples primeiro)
        // cor (ia ter que ter outra tabela) (vamos fazer do jeito simples primeiro)

        // Tabela questionario
        // id_projeto
        // id_grupo
        // id_participante
        // sentimento


        foreach($this->dto as $property => $value) {
            if(property_exists($participante, $property)) {
                $participante->$property = $value;
            }
        }
       
        $participante->save();

        return redirect('home'); 
        // tem que mandar mensagem
    }




    // Daqui para baixo, não estou mais usando
    

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
