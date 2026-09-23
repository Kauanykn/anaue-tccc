<aside class="admin-sidebar">

    <div class="admin-logo">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="Anauê"
        >
    </div>
    
    <button
    type="button"
    class="admin-sidebar-toggle"
    id="admin-sidebar-toggle"
    aria-label="Recolher menu"
    
    >
    
    <i class="fa-solid fa-chevron-left"></i>
    
</button>


<nav class="admin-menu">

    <a
        href="{{ route('admin.dashboard') }}"
        class="admin-link {{ request()->routeIs('admin.dashboard') ? 'ativo' : '' }}"
    >
        <i class="fa-solid fa-house"></i>
        Dashboard
    </a>

    <a
        href="{{ route('admin.pacotes.index') }}"
        class="admin-link {{ request()->routeIs('admin.pacotes.*') ? 'ativo' : '' }}"
    >
        <i class="fa-solid fa-box-open"></i>
        Pacotes
    </a>

    <a
        href="{{ route('admin.galeria.index') }}"
        class="admin-link {{ request()->routeIs('admin.galeria.*') ? 'ativo' : '' }}"
    >
        <i class="fa-regular fa-images"></i>
        Galeria
    </a>

    <a
        href="{{ route('admin.orcamentos.index') }}"
        class="admin-link {{ request()->routeIs('admin.orcamentos.*') ? 'ativo' : '' }}"
    >
        <i class="fa-solid fa-file-invoice-dollar"></i>
        Orçamentos
    </a>

    <a
        href="{{ route('admin.depoimentos.index') }}"
        class="admin-link {{ request()->routeIs('admin.depoimentos.*') ? 'ativo' : '' }}"
    >
        <i class="fa-solid fa-star"></i>
        Avaliações
    </a>

    <a
        href="{{ route('admin.usuarios.index') }}"
        class="admin-link {{ request()->routeIs('admin.usuarios.*') ? 'ativo' : '' }}"
    >
        <i class="fa-solid fa-users"></i>
        Usuários
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

<script>
    const sidebar = document.querySelector('.admin-sidebar');
    const botaoSidebar = document.getElementById('admin-sidebar-toggle');

    // Recupera o estado salvo
    if (localStorage.getItem('adminSidebar') === 'recolhida') {
        sidebar.classList.add('recolhida');
    }

    botaoSidebar.addEventListener('click', function () {

        sidebar.classList.toggle('recolhida');

        // Salva o estado atual
        if (sidebar.classList.contains('recolhida')) {

            localStorage.setItem('adminSidebar', 'recolhida');

        } else {

            localStorage.setItem('adminSidebar', 'aberta');

        }

    });
</script>

