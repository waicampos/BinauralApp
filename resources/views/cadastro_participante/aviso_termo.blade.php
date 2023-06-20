@extends('layouts.main')

@section('content')

    <div class="">
        <p>Na próxima tela você verá o <strong>Termo de Consentimento Livre e Esclarecido</strong></p>
        <p>É muito importante que você leia todo o texto com calma e atenção. Leve o tempo que precisar!</p>
        <p>Você pode decidir se irá colaborar com o projeto autorizando o uso de seus dados ou não.</p>
        <p>Após a finalização do cadastro, esta opção não pode ser alterada, ok?</p>                    
    </div>

    <form action="/cadastrar_participante" method="post">
        @csrf
        <div class="botoes_navegacao_cadastro">
            <button class="btn btn-secondary" type="submit" name="voltar">Voltar</button>
            <button class="btn btn-secondary" type="submit" name="avancar">Avançar</button>
        </div>

@endsection




