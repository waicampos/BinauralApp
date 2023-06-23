
@extends('layouts.cadastro')
@section('content')

    <p>Cadastro</p>
    
    <form action="/cadastrar_participante" method="post">
        @csrf
        <div class="form-group">
            <label for="nome">Nome </label>
            <input type="text" name="DTO[nome]" id="nome" class="form-control" required 
                pattern="(^\w+\D)" value="{{ session('dto')->nome ?? '' }}">
        </div>

        <div class="form-group">
            <label for="sobrenome">Sobrenome </label>
            <input type="text" name="DTO[sobrenome]" id="sobrenome" class="form-control" required 
                pattern="(^\w+\D)" value="{{ session('dto')->sobrenome ?? '' }}">
        </div>

        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento: </label>
            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" required
                value="{{ session('dto')->data_nascimento ?? '' }}">
        </div>

        <div class="form-group">
            <label for="email">E-mail: </label>
            <input type="email" name="DTO[email]" id="email" class="form-control" required 
                value="{{ session('dto')->email ?? '' }}">
        </div>

        <div class="form-group">
            <label for="senha">Senha: </label>
            <input type="password" name="DTO[senha]" id="senha" class="form-control" required 
                value="{{ session('dto')->senha ?? '' }}">
        </div>

        <div class="botoes_navegacao_cadastro">
            <button class="btn btn-secondary" type="submit" name="voltar">Voltar</button>
            <button class="btn btn-secondary" type="submit" name="avancar">Avançar</button>
        </div>

    </form>


@endsection




