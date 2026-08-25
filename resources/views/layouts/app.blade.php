<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Anauê Espaço Infantil</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">

    @stack('styles')
  
</head>
<body>
    @include('components.navbar')

    <main>
        @yield('content')
    </main>
    <footer>
         @include('components.footer')
    </footer>

</body>
</html>
