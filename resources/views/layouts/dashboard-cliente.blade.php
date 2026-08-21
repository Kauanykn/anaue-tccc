<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('title', 'Área do Cliente') | Anauê</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/cliente-dashboard.css') }}"
    >
</head>

<body>

<div class="dashboard">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="sidebar__logo">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Anauê Espaço Infantil"
            >
        </div>

        <nav class="sidebar__menu">

            <a
                href="{{ route('cliente.dashboard') }}"
                class="sidebar__link ativo"
            >
                <i class="fa-solid fa-house"></i>
                <span>Visão Geral</span>
            </a>

            <a href="#" class="sidebar__link">
                <i class="fa-regular fa-file-lines"></i>
                <span>Orçamentos</span>
            </a>

            <a href="#" class="sidebar__link">
                <i class="fa-solid fa-box-open"></i>
                <span>Meus Dados</span>
            </a>

        </nav>

    </aside>


    {{-- CONTEÚDO --}}
    <main class="dashboard__conteudo">

        @yield('content')

    </main>

</div>

</body>
</html>