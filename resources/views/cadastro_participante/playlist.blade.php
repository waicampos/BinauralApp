@extends('layouts.main')


@section('content')
           
    <h3>Playlist</h3>

    <div class="busca-spotify">
        <form action="/playlist/buscar" method="post">
            @csrf
            <input type="text" name="busca" id="busca" placeholder="Busca no spotify">
            <button type="submit" class="btn btn-secondary">Buscar</button>
        </form>
    </div>


    <form action="/playlist/criar" method="post">  
        @csrf 
        <div class="playlist-search-result">
                @if (isset($searchResult))
                    <select name='track' id='track'>
                        @foreach($searchResult->tracks->items as $song) 
                            <option value="{{$song->uri}}"> {{$song->name}} </option>                   
                            @foreach ($song->artists as $artist) 
                                Artist: {{$artist->name}} <br>
                            @endforeach
                            Duration: $song->duration_ms<br>
                        @endforeach
                    </select>
                @endif
        </div>
        <div class="">
            <input type="text" name="playlist_name" id="playlist_name" placeholder="Nome da nova playlist">
        </div>
        <button type="submit">Salvar Música na playlist</button>
    </form>

    
    <!-- <form action="/cadastrar_participante" method="post">
        @csrf        
        <div class="botoes_navegacao_cadastro">
            <button class="btn btn-secondary" type="submit" name="voltar">Voltar</button>
            <button class="btn btn-secondary" type="submit" name="avancar">Avançar</button>
        </div>

    </form> -->
            

@endsection
