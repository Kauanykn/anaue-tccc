<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Cadastro | Anauê</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/cadastro.css') }}"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

</head>

<body>

<main class="cadastro">

    <img
        src="{{ asset('images/cadastro-fundo.jpeg') }}"
        class="cadastro__background"
        alt=""
    >

    <div class="cadastro__conteudo">

        <img
            src="{{ asset('images/logo.png') }}"
            class="cadastro__logo"
            alt="Anauê"
        >

        <section class="cadastro__card">

            <h1>CADASTRAR</h1>

            <form
                action="{{ route('register.store') }}"
                method="POST"
            >

                @csrf

                <div class="campo-cadastro">
                    <label for="name">Nome completo:</label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        required
                    >

                    @error('name')
                        <p class="erro">{{ $message }}</p>
                    @enderror
                </div>


                <div class="campo-cadastro">
                    <label for="email">Email:</label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                    >

                    @error('email')
                        <p class="erro">{{ $message }}</p>
                    @enderror
                </div>


                <div class="campo-cadastro">
                    <label for="telefone">Telefone:</label>

                    <input
                        type="text"
                        name="telefone"
                        id="telefone"
                        value="{{ old('telefone') }}"
                        required
                    >

                    @error('telefone')
                        <p class="erro">{{ $message }}</p>
                    @enderror
                </div>


                <div class="campo-cadastro">

                    <label for="senhaCadastro">Senha:</label>

                    <div class="campo-senha">

                        <input
                            type="password"
                            name="password"
                            id="senhaCadastro"
                            required
                        >

                        <button
                            type="button"
                            class="mostrar-senha"
                            id="mostrarSenhaCadastro"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </button>

                    </div>

                    @error('password')
                        <p class="erro">{{ $message }}</p>
                    @enderror

                </div>


                <button
                    type="submit"
                    class="btn-cadastrar"
                >
                    Criar conta
                </button>


                <p class="ja-tem-conta">
                    Já tem uma conta?

                    <a href="{{ route('login') }}">
                        Entrar
                    </a>
                </p>

            </form>

        </section>

    </div>

</main>

</body>

</html>

<script src="{{ asset('jss/login.js') }}"></script>
