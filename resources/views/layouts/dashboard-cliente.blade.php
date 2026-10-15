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
    <link rel="stylesheet" href="{{ asset('css/responsivo.css') }}">
</head>

<body>

    <form
    id="form-logout"
    action="{{ route('logout') }}"
    method="POST"
    style="display: none;"
>
    @csrf
</form>

<div class="dashboard">

@include('cliente.partials.sidebar')

    {{-- CONTEÚDO --}}
    <main class="dashboard__conteudo">

        @yield('content')

    </main>

</div>

</body>
</html>
