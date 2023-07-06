<x-app-layout>

    @if ($user->is_member())
        <div>
            <p>Você está participando das oficinas do projeto: {{$user->active_group()->project->name}}</p>
        </div>
        <!-- <div class="container">
            <p>Ver Agenda das Oficinas</p>
        </div> -->
        @if ($user->is_workshop_time())
        <div>
            <p>Iniciar oficina</p>
        </div>
        @else
        <div>
            <p>Sua próxima oficina será: {{ $user->proxima_oficina_string() }} </p>
            <p>Se precisar faltar, por favor, nos comunique!</p>
        </div>
        @endif
        <a href="{{ route('comunicar_falta') }}" class="btn btn-secondary">Comunicar Falta</a>
    @else 
    <div>
        <p></p>
    </div>
        <div class="container">
            <a href="{{ route('cadastro') }}" class="btn btn-primary">Participar das Oficinas</a> 
        </div>
    @endif

</x-app-layout>