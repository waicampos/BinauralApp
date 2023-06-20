
@extends('layouts.cadastro')
@section('content')

    <p>XXX, altere ou confirme os dados abaixo:</p>
    
    <form action="/cadastrar_participante" method="post">
        @csrf
        <div class="form-group">
            <label for="documento">RG: </label>
            <input type="text" name="DTO[documento]" id="documento" class="form-control" required 
                pattern="(^\d{1,2}).?(\d{3}).?(\d{3})" value="{{ session('dto')->documento ?? '' }}">
        </div>

        <div class="form-group">
            <label for="Gênero">Gênero: </label>
            @php $generos = ['Feminino', 'Masculino', 'Outro'] @endphp
            @foreach ($generos as $genero) 
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="DTO[indicadores][genero]" id="{{$genero}}" value="{{$genero}}" required {{ session('dto')->indicadores['genero'] === $genero ? "checked" : "" }}>
                    <label for="{{$genero}}"> {{$genero}} </label>   
                </div>
            @endforeach
            
        </div>

        <div class="form-group">
            <label for="cor">Cor/Raça: </label>

            @php $cores = ['Branco/a', 'Indígena', 'Pardo/a', 'Preto/a'] @endphp
            @foreach ($cores as $cor)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="DTO[indicadores][cor]" id="{{$cor}}" value="{{$cor}}" required {{ session('dto')->indicadores['cor'] === $cor ? "checked" : "" }}>
                    <label for="{{$cor}}"> {{$cor}} </label>   
                </div>
            @endforeach
        </div>

        <div class="botoes_navegacao_cadastro">
            <button class="btn btn-secondary" type="submit" name="voltar">Voltar</button>
            <button class="btn btn-secondary" type="submit" name="avancar">Avançar</button>
        </div>

    </form>


@endsection




