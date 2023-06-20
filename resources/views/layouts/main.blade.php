@include('components.html_header')

    <!-- Navbar Vai Aqui com include -->
    
    <main class="container-fluid main">
        
        <!-- Session Flash Message -->
        @if (session('msg'))
            <p class="msg">{{ session('msg') }}</p>
        @endif

        <!-- Conteúdo -->
        @yield('content')
        
    </main> 

@include('components.html_footer')