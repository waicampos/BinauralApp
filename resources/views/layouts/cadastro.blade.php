@include('components.html_header')
@section('title', 'Cadastro em Projeto')

    <!-- Navbar Vai Aqui com include -->
    @include('components.banner-logo')
    
    <main class="container-fluid main">
        
        <!-- Session Flash Message -->
        @if (session('msg'))
            <p class="msg">{{ session('msg') }}</p>
        @endif

        <!-- Conteúdo -->
        @yield('content')
        
    </main> 

@include('components.html_footer')