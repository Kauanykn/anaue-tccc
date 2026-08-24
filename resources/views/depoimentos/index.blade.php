@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/depoimentos.css') }}">


<h1>Página de Depoimentos</h1>

@foreach($depoimentos as $depoimento)

<div class="depoimento">
    
    <div class="depoimento-usuario">
        
        @if($depoimento->usuario->avatar)
        
        <img
        src="{{ asset('storage/' . $depoimento->usuario->avatar) }}"
        alt="Foto de {{ $depoimento->usuario->name }}"
        class="depoimento-avatar"
        >
        
            @else
            
            <div class="depoimento-avatar-letra">
                {{ strtoupper(substr($depoimento->usuario->name, 0, 1)) }}
            </div>
            
            @endif
            
            <h2>{{ $depoimento->usuario->name }}</h2>
            
        </div>
        
        <p>Nota: {{ $depoimento->nota }}/5</p>
        
        <p>{{ $depoimento->comentario }}</p>
        
    </div>
    
    @endforeach
    
    @if(!$meuDepoimento)
    
    <form action="{{ route('depoimentos.store') }}" method="POST">
        @csrf
        
        <input type="number" name="nota" min="1" max="5" placeholder="Nota de 1 a 5">
        
        <textarea name="comentario" placeholder="Seu comentário"></textarea>
        
        <button type="submit">Enviar avaliação</button>
    </form>

    @endif

    @endsection('content')