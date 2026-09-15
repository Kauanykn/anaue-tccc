@extends('layouts.dashboard-cliente')

@section('title', 'Visão Geral')

@section('content')


<a href="{{ route('home') }}" class="btn-voltar-home">
        <i class="fa-solid fa-arrow-left"></i>
        Voltar para o site
    </a>

    <h2 class="meu-perfil-h2">Meu perfil</h2>

<section class="perfil-cliente">
    
    

    <div class="perfil-info">

        @if(Auth::user()->avatar)

            <img 
                src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                alt="Foto de perfil"
                class="avatar-cliente"
            >

        @else

            <div class="avatar-letra">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

        @endif

        <div class="perfil-dados">

            <h3>{{ Auth::user()->name }}</h3>

            <p>{{ Auth::user()->email }}</p>
            <p>{{ Auth::user()->telefone }}</p>

        </div>

    </div>

    <form action="{{ route('cliente.avatar') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="avatar-acoes">

    <label for="avatar" class="escolher-arquivo">
        <i class="fa-solid fa-camera"></i>
        Escolher foto
    </label>

    <input 
        id="avatar"
        type="file"
        name="avatar"
        accept="image/*"
    >

    <button class="alterar-foto" type="submit">
        <i class="fa-solid fa-upload"></i>
        Alterar foto
    </button>

    @if(Auth::user()->avatar)
    <form action="{{ route('cliente.avatar.remover') }}" method="POST">
        @csrf
        @method('DELETE')
    
        <button type="submit" class="remover-foto">
            <i class="fa-solid fa-trash"></i>
            Remover foto
        </button>
    </form>
    
    
    @endif
</div>

    </form>


</section>

<hr><br>

<div class="cliente-topo">

    <div>
        <p>
            Aqui você acompanha tudo sobre a sua festa
        </p>  
    </div>

</div>

<section class="evento-destaque">

    <span>SEU EVENTO</span>

    <h2>
        Aniversário da Alice - 5 anos
    </h2>

    <p>
        14 de setembro de 2026 • Salão Jardim Verde • Pacote Coquetel
    </p>


</section>


@endsection
