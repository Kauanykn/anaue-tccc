<h1>Página de Depoimentos</h1>

@foreach($depoimentos as $depoimento)
    <h2>{{ $depoimento->nome }}</h2>
    <p>Nota: {{ $depoimento->nota }}/5</p>
    <p>{{ $depoimento->comentario }}</p>
@endforeach