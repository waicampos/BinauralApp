
@extends('layouts.cadastro')

@section('content')

    <div class="">
        <p>Bem vindo/a, {{session('dto')->nome}}</p>
    </div>

    <div class="">
        <p>Você irá realizar o seu cadastro como participante do Projeto: {{session('dto')->projeto_id}}</p>
        <p>Grupo nº: {{session('dto')->grupo_numero}}</p>
    </div>

    <div class="">
        <p>Leia atentamente as instruções na tela a seguir<br>
        <p>Confirme seus dados e volte se precisar alterar algo</p>
    </div>

    <form action="/cadastrar_participante" method="post">
        @csrf 
        <div class="botoes_navegacao_cadastro">
            <button type="submit" name="avancar">Avançar</button>
        </div>
    </form>


@endsection




