<nav class="navbar">

    <div class="nav-container">

        <div class="nav-left">
            <a href="{{ route('home') }}">Início</a>
            <a href="#">Pacotes</a>
            <a href="{{ route('galeria') }}">Galeria</a>
        </div>

        <a href="{{ route('home') }}" class="logo-link">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo Anauê"
                class="logo"
            >
        </a>

        <div class="nav-right">
            <a href="{{ route('sobre') }}">Sobre</a>
            <a href="#">Depoimentos</a>

            <a href="#" class="btn-orcamento">
                Orçamento
            </a>

           @auth
    <a href="{{ route('cliente.dashboard') }}" class="usuario">
        <i class="fa-solid fa-user"></i>
    </a>
@else
    <a href="{{ route('login') }}" class="usuario">
        <i class="fa-regular fa-user"></i>
    </a>
@endauth
        </div>

    </div>

</nav>
