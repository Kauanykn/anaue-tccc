@extends('layouts.dashboard-cliente')

@section('title', 'Visão Geral')

@section('content')

<div class="cliente-topo">

    <div>
    <h1>
            Olá, {{ Auth::user()->name }} 👋
        </h1>

        <p>
            Aqui você acompanha tudo sobre a sua festa
        </p>  
    </div>
    <a href="{{ route('home') }}" class="btn-voltar-home">
            <i class="fa-solid fa-arrow-left"></i>
            Voltar para o site
        </a>

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
