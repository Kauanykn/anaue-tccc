<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard Administrativo | Anauê</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/admin-dashboard.css') }}"
    >
</head>

<body>

<div class="admin-dashboard">

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar">

        <div class="admin-logo">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Anauê"
            >
        </div>


        <nav class="admin-menu">

            <a
                href="{{ route('admin.dashboard') }}"
                class="admin-link ativo"
            >
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>


            <a
                href="{{ route('admin.pacotes.index') }}"
                class="admin-link"
            >
                <i class="fa-solid fa-box-open"></i>
                Pacotes
            </a>


            <a
                href="{{ route('admin.galeria.index') }}"
                class="admin-link"
            >
                <i class="fa-regular fa-images"></i>
                Galeria
            </a>

            <a
                href="{{ route('admin.depoimentos.index') }}"
                class="admin-link"
            >
                <i class="fa-solid fa-star"></i>
                Avaliações
            </a>

        </nav>


        <form
            action="{{ route('logout') }}"
            method="POST"
            class="admin-logout"
        >

            @csrf

            <button type="submit">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Sair
            </button>

        </form>

    </aside>


    {{-- CONTEÚDO --}}
    <main class="admin-conteudo">

        <header class="admin-topo">

            <div>
                <span>PAINEL ADMINISTRATIVO</span>

                <h1>
                    Olá, {{ Auth::user()->name }} 👋
                </h1>

                <p>
                    Gerencie as informações do site por aqui.
                </p>
            </div>

            <a href="{{ route('home') }}" class="btn-site">
                <i class="fa-solid fa-arrow-left"></i>
                Voltar para o site
            </a>

        </header>


        <section class="admin-cards">

            <a
                href="{{ route('admin.pacotes.index') }}"
                class="admin-card"
            >

                <div class="admin-card__icone">
                    <i class="fa-solid fa-box-open"></i>
                </div>

                <div>
                    <span>Pacotes cadastrados</span>

                    <strong>
                        {{ $totalPacotes }}
                    </strong>
                </div>

            </a>


            <a
                href="{{ route('admin.galeria.index') }}"
                class="admin-card"
            >

                <div class="admin-card__icone">
                    <i class="fa-regular fa-images"></i>
                </div>

                <div>
                    <span>Fotos na galeria</span>

                    <strong>
                        {{ $totalFotos }}
                    </strong>
                </div>

            </a>

            <section class="admin-depoimentos-resumo">
    
        <div class="admin-depoimentos-info">
    
            <div class="admin-depoimentos-icone">
                <i class="fa-solid fa-star"></i>
            </div>
    
            <div>
                <span>Avaliações dos clientes</span>
    
                <div class="admin-depoimentos-media">
                    <strong>
                        {{ number_format($mediaAvaliacoes, 1, ',', '') }}
                    </strong>
    
                    <span class="admin-depoimentos-estrelas">
                        ★★★★★
                    </span>
                </div>
    
                <small>
                    {{ $totalDepoimentos }}
                    {{ $totalDepoimentos == 1 ? 'depoimento cadastrado' : 'depoimentos cadastrados' }}
                </small>
            </div>
    
        </div>
    
        
    </section>
        </section>



<section class="acoes-rapidas">
    
    <h2>Ações rápidas</h2>

    <div class="acoes-grid">
        
        <a href="{{ route('admin.pacotes.create') }}">
                    <i class="fa-solid fa-plus"></i>

                    <div>
                        <strong>Novo pacote</strong>
                        <span>Cadastrar um novo pacote</span>
                    </div>
                </a>
                
                
                <a href="{{ route('admin.galeria.create') }}">
                    <i class="fa-solid fa-image"></i>
                    
                    <div>
                        <strong>Adicionar foto</strong>
                        <span>Adicionar uma foto à galeria</span>
                    </div>
                </a>
                
                <a
                    href="{{ route('admin.depoimentos.index') }}"
                    class="btn-administrar-depoimentos"
                >
                    <i class="fa-solid fa-star"></i>
                    Administrar avaliações
                </a>

            </div>

        </section>

    </main>

</div>

</body>
</html>