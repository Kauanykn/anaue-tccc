<aside class="cliente-sidebar">

    <div class="cliente-logo">
        <img
            src="{{ asset('images/logo.png') }}"
            alt="Anauê"
        >
    </div>
    
    <button
    type="button"
    class="cliente-sidebar-toggle"
    id="cliente-sidebar-toggle"
    aria-label="Recolher menu"
    
    >
    
    <i class="fa-solid fa-chevron-left"></i>
    
</button>


<nav class="cliente-menu">

    <a
        href="{{ route('cliente.dashboard') }}"
        class="cliente-link {{ request()->routeIs('cliente.dashboard') ? 'ativo' : '' }}"
    >
        <i class="fa-solid fa-house"></i>
        Dashboard
    </a>

    <a
        href="{{ route('cliente.orcamentos.orcamentos') }}"
        class="cliente-link {{ request()->routeIs('cliente.orcamentos.orcamentos.*') ? 'ativo' : '' }}"
    >
        <i class="fa-solid fa-file-invoice-dollar"></i>
        Orçamentos
    </a>

        </nav>  

<form
    action="{{ route('logout') }}"
    method="POST"
    class="cliente-logout"
>

    @csrf

    <button type="submit">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        Sair
    </button>

</form>

</aside>

<script>
    const sidebar = document.querySelector('.cliente-sidebar');
    const botaoSidebar = document.getElementById('cliente-sidebar-toggle');

    // Recupera o estado salvo
    if (localStorage.getItem('clienteSidebar') === 'recolhida') {
        sidebar.classList.add('recolhida');
    }

    botaoSidebar.addEventListener('click', function () {

        sidebar.classList.toggle('recolhida');

        // Salva o estado atual
        if (sidebar.classList.contains('recolhida')) {

            localStorage.setItem('clienteSidebar', 'recolhida');

        } else {

            localStorage.setItem('clienteSidebar', 'aberta');

        }

    });
</script>