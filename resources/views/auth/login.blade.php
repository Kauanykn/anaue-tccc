<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | Anauê</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/login.css') }}"
    >
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >
</head>

<body>

<main class="login">

<img
    src="{{ asset('images/login-fundo.jpeg') }}"
    alt=""
    class="login__background"
>

<div class="login__conteudo">

    <img
        src="{{ asset('images/logo.png') }}"
        alt="Anauê Espaço Infantil"
        class="login__logo"
    >


    <section class="login__card">

        <h1>LOGIN</h1>

        <form action="{{ route('login.authenticate') }}" method="POST">
                @csrf

            <div class="campo-login">
                <label for="email">Email:</label>

                 <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                >
            </div>


            <div class="campo-login">

    <label for="senha">Senha:</label>

    <div class="campo-senha">
            <input
                type="password"
                name="password"
                id="senha"
                required
            >

            <button
                type="button"
                class="mostrar-senha"
                id="mostrarSenha"
                aria-label="Mostrar senha"
            >
                <i class="fa-regular fa-eye"></i>
            </button>
     </div>

     </div>

            @error('email')
            <p class="erro-login">
            {{ $message }}
            </p>
            @enderror


            <a href="#" class="esqueci-senha">
                Esqueceu a senha?
            </a>


            <button type="submit" class="btn-entrar">
                Entrar
            </button>


            <p class="criar-conta">
                Não tem uma conta?
                <a href="{{ route('register') }}#">Crie uma</a>
            </p>

        </form>

    </section>

</div>

</main>

</body>

</html>
<script src="{{ asset('jss/login.js') }}"></script>