<!-- Navbar bootstrap -->
<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">Sobre o Projeto</a>
        </li>
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Minha conta
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Oficinas</a></li>
            <li><hr class="dropdown-divider"></li>
            <!-- Logout -->
            <li>
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                    <a class="dropdown-item" href=" {{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">Sair</a>
                </form>
            </li>
          </ul>
        </li>
        @endauth
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Entrar</a>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
