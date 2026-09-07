<nav class="navbar">

    <div class="nav-container">

        <div class="nav-menu" id="nav-menu">

        <div class="nav-left">
            <a href="{{ route('home') }}">Início</a>
            <a href="{{ route('pacotes') }}">Pacotes</a>
            <a href="{{ route('galeria') }}">Galeria</a>
        </div>

        <div class="nav-right">
            <a href="{{ route('sobre') }}">Sobre</a>
            <a href="{{ route('depoimentos') }}">Depoimentos</a>




          @auth

        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')

            <a href="{{ route('admin.dashboard') }}" class="usuario">
                <i class="fa-solid fa-user-shield"></i>
            </a>

        @else

            <a href="{{ route('cliente.dashboard') }}" class="usuario">
                <i class="fa-solid fa-user"></i>
            </a>

        @endif

        @else

        <a href="{{ route('login') }}" class="usuario">
            <i class="fa-regular fa-user"></i>
        </a>

        @endauth
    
        </div>

        </div>

        <a href="{{ route('home') }}" class="logo-link" aria-label="Página inicial">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo Anauê"
                class="logo"
            >
        </a>

        <button type="button" class="nav-toggle" aria-label="Abrir menu de navegação" aria-controls="nav-menu" aria-expanded="false">
            <i class="fa-solid fa-bars"></i>
        </button>

    </div>

</nav>
