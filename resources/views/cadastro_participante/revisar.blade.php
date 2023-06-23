@extends('layouts.main')

@section('content')
            
    <h3>Revise seus dados abaixo</h3>

    <div class="cadastro_confirma_dado">
        <label for="nome">Nome: </label>
        <span id="nome">{{session('dto')->nome}} {{session('dto')->sobrenome}}</span>
    </div>
    <div class="cadastro_confirma_dado">
        <label for="data_nascimento">Data de Nascimento: </label>
        <span id="data_nascimento">{{session('dto')->data_nascimento}}</span>
    </div>
    <div class="cadastro_confirma_dado">
        <label for="nome">Email: </label>
        <span id="nome">{{session('dto')->email}}</span>
    </div>
    <div class="cadastro_confirma_dado">
        <label for="documento">RG: </label>
        <span id="documento">{{session('dto')->documento}}</span>
    </div>
    <div class="cadastro_confirma_dado">
        <label for="genero">Gênero: </label>
        <span id="genero">{{session('dto')->indicadores['genero']}}</span>
    </div>
    <div class="cadastro_confirma_dado">
        <label for="cor">Cor: </label>
        <span id="cor">{{session('dto')->indicadores['cor']}}</span>
    </div>
    <div class="cadastro_confirma_dado">
        <label for="projeto_nome">Projeto: </label>
        <span id="projeto_nome">{{session('dto')->projeto_nome}}</span>
    </div>
    <div class="cadastro_confirma_dado">
        <label for="grupo">Grupo: </label>
        <span id="grupo">{{session('dto')->grupo_numero}}</span>
    </div>
    <div class="cadastro_confirma_dado">
        <label for="autorizacao">Termo de Autorização: </label>
        <span id="autorizacao">{{session('dto')->autorizacao}}</span>
    </div>
    <div class="cadastro_confirma_dado">
        <label for="questionario">Questionário: </label>
        <span id="questionario">{{session('dto')->questionario_inicial['sentimento']}}</span>
    </div>         

    <form action="/cadastrar_participante/finalizar" method="post">
        @csrf
        <!-- Aqui sim vamos ter um post! -->
        <div class="botoes_navegacao_cadastro">
            <button class="btn btn-secondary" type="submit" name="voltar">Voltar</button>
            <button class="btn btn-secondary" type="submit" name="finalizar">Finalizar</button>
        </div>
    </form>


@endsection




