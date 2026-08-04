<nav class="navbar">

    <div class="nav-container">

        <div class="nav-left">
            <a href="{{ route('home') }}">Início</a>
            <a href="#">Pacotes</a>
            <a href="#">Galeria</a>
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

            <a href="#" class="usuario">
                <i class="fa-regular fa-user"></i>
            </a>
        </div>

    </div>

</nav>
