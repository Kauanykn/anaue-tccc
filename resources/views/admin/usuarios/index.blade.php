<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Usuários | Anauê</title>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
>

<link
    rel="stylesheet"
    href="{{ asset('css/admin-dashboard.css') }}"
>

</head>

<div class="modal-permissao" id="modal-permissao">

<div class="modal-permissao-conteudo">

    <button
        type="button"
        class="modal-permissao-fechar"
        onclick="fecharModal()"
    >
        ×
    </button>

    <h2>
        Alterar permissão
    </h2>

    <p>
        Confirme o usuário antes de alterar sua permissão.
    </p>


    <div class="usuario-modal-info">

    <div class="usuario-modal-avatar">

    <img
        id="usuario-modal-avatar"
        src=""
        alt=""
    >

    </div>

        <div>
            <strong id="usuario-modal-nome"></strong>

            <span id="usuario-modal-email"></span>
        </div>

    </div>


    <form id="form-permissao">

        @csrf

        @method('PUT')

        <input
            type="hidden"
            id="usuario-id"
            name="usuario_id"
        >


        <div class="campo-permissao">

            <label>
                Nova permissão
            </label>


            <label class="opcao-permissao">

                <input
                    type="radio"
                    name="role"
                    value="admin"
                    id="role-admin"
                >

                <span>
                    Administrador
                </span>

            </label>


            <label class="opcao-permissao">

                <input
                    type="radio"
                    name="role"
                    value="usuario"
                    id="role-usuario"
                >

                <span>
                    Usuário
                </span>

            </label>

        </div>


        <div class="acoes-permissao">

            <button
                type="button"
                class="btn-cancelar-permissao"
                onclick="fecharModal()"
            >
                Cancelar
            </button>

            <button
                type="submit"
                class="btn-confirmar-permissao"
            >
                Confirmar
            </button>

        </div>

    </form>

</div>

</div>



<script>

    const usuarios = @json($usuarios);

    function abrirModal(id) {

        const usuario = usuarios.find(usuario => usuario.id === id);

        document.getElementById('usuario-modal-nome').textContent = usuario.name;
        document.getElementById('usuario-modal-email').textContent = usuario.email;

        const avatar = document.getElementById('usuario-modal-avatar');

            if (usuario.avatar) {

                
                avatar.src = "{{ asset('storage') }}/" + usuario.avatar;
                avatar.alt = "Foto de " + usuario.name;
                avatar.style.display = 'block';
            

            } else {

                
                avatar.src = "";
                avatar.alt = "";
                avatar.style.display = 'none';
                

            }


            if (!usuario) {
                        return;
            }

        document.getElementById('usuario-id').value = usuario.id;

        document.getElementById('role-admin').checked =
            usuario.role === 'admin';

        document.getElementById('role-usuario').checked =
            usuario.role === 'usuario';

        document.getElementById('modal-permissao').style.display = 'flex';
    }


    function fecharModal() {

        document.getElementById('modal-permissao').style.display = 'none';
    }

</script>

</body>

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
            class="admin-link"
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
            href="{{ route('admin.orcamentos.index') }}"
            class="admin-link"
        >
            <i class="fa-solid fa-file-invoice-dollar"></i>
            Orçamentos
        </a>

        <a
            href="{{ route('admin.depoimentos.index') }}"
            class="admin-link"
        >
            <i class="fa-solid fa-star"></i>
            Avaliações
        </a>

        <a
            href="{{ route('admin.usuarios.index') }}"
            class="admin-link ativo"
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


{{-- CONTEÚDO --}}
<main class="admin-conteudo">

    <header class="admin-topo">

        <div>
            <span>GERENCIAMENTO DE USUÁRIOS</span>

            <h1>
                Usuários
            </h1>

            <p>
                Gerencie as permissões dos usuários cadastrados.
            </p>
        </div>

        <a
            href="{{ route('home') }}"
            class="btn-site"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Voltar para o site
        </a>

    </header>


    <section class="admin-cards">

        @forelse ($usuarios as $usuario)

            <div
                class="admin-card"
                onclick="abrirModal({{ $usuario->id }})"
                style="cursor: pointer;"
            >

            <div class="admin-card__icone">

            @if ($usuario->avatar)

                <img
                    src="{{ asset('storage/' . $usuario->avatar) }}"
                    alt="Foto de {{ $usuario->name }}"
                >

            @else

                <i class="fa-solid fa-user"></i>

            @endif

            </div>

                <div>
                    <span>Nome</span>

                    <strong>
                        {{ $usuario->name }}
                    </strong>

                    <small>
                        {{ $usuario->email }}
                    </small>

                    <small>
                        {{ $usuario->telefone ?? 'Sem telefone' }}
                    </small>

                    <small>
                        {{ $usuario->role === 'admin' ? 'Administrador' : 'Usuário' }}
                    </small>
                </div>

            </div>


        @empty

            <p>Nenhum usuário cadastrado.</p>

        @endforelse

    </section>

</main>

</div>

</body>
</html>
