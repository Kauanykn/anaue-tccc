<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>@yield('title', 'Painel Administrativo | Anauê')</title>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
>

<link
    rel="stylesheet"
    href="{{ asset('css/admin-dashboard.css') }}"
>

@stack('styles')

</head>

<body>

<div class="admin-dashboard">

@include('admin.partials.sidebar')

<main class="admin-conteudo">

    @yield('content')

</main>

</div>

@stack('scripts')

</body>

</html>
