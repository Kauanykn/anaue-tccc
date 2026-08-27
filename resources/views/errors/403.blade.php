<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Página não encontrada | Anauê</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/404.css') }}"
    >
</head>

<body>

<main class="erro-404">

    <div class="erro-404__conteudo">

        <img
            src="{{ asset('images/logo.png') }}"
            alt="Anauê Espaço Infantil"
            class="erro-404__logo"
        >

        <span class="erro-404__numero">
            404
        </span>

        <h1>
            Opa! Essa página não foi encontrada
        </h1>

        <p>
            Parece que você entrou em um cantinho que não existe.
            Vamos voltar para a festa?
        </p>

        <div class="erro-404__acoes">

            <a
                href="{{ route('home') }}"
                class="btn-home"
            >
                <i class="fa-solid fa-house"></i>
                Voltar para a página inicial
            </a>

            <button
                type="button"
                class="btn-voltar"
                onclick="history.back()"
            >
                <i class="fa-solid fa-arrow-left"></i>
                Voltar
            </button>

        </div>

    </div>

</main>

</body>

</html>