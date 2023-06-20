<!-- preciso salvar o conteúdo na session, mesmo quando vai pra trás -->
<!-- A melhor forma de fazer isso seria por aqui mesmo... logo antes de apertar nos botões.. ou, melhor ainda, ao selecionar a opção -->
<!-- se fosse ao selecionar a opção, teria que ser um javascript -->
<!-- E eu não quero usar javascript, quero deixar o mais livre de js events possível -->

@extends('layouts.main')

@section('content')
           
    <h3>Questionário</h3>
    <p>Por favor, leia atentamente e responda ao questionário abaixo: </p>

    <form action="/cadastrar_participante" method="post">
        @csrf

        <label for="sentimentos">Como você está se sentindo hoje?</label>
            @foreach( ['Ansioso','Depressivo','Dificuldade para relaxar ou dormir','Desatento ou sem foco', 'Dificuldade para resolver problemas ou estudo'] as $sentimento )
            <div class="form-check">
                <input type="radio" class="form-check-input" id="{{$sentimento}}" name="DTO[questionario_inicial][sentimento]" value="{{$sentimento}}" required {{ session('dto')->questionario_inicial['sentimento'] === $sentimento ? "checked" : "" }} >
                <label class="form-check-label" for="{{$sentimento}}">{{$sentimento}}</label>
            </div>
            @endforeach
        
        <!-- Então, pra qualquer um dos dois, tem que ser um botão, que envia um post... -->
        <!-- Ai ai ai... Lascou-se! -->
        <!-- Acho que não tenho como escapar do javascript, tenho? -->
        <div class="botoes_navegacao_cadastro">
            <button class="btn btn-secondary" type="submit" name="voltar">Voltar</button>
            <button class="btn btn-secondary" type="submit" name="avancar">Avançar</button>
        </div>

    </form>
            


@endsection




