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

@if ($orcamento)
    <section class="evento-destaque evento-destaque--{{ $orcamento->status }}">
        <div class="evento-destaque__topo">
            <span>STATUS DO ORÇAMENTO</span>
            <strong class="status-cliente status-cliente--{{ $orcamento->status }}">
                {{ ucfirst($orcamento->status) }}
            </strong>
        </div>

        <h2>
            {{ $orcamento->aniversariante
                ? 'Festa de ' . $orcamento->aniversariante
                : 'Seu orçamento' }}
        </h2>

        <p>
            {{ $orcamento->data_evento?->format('d \d\e F \d\e Y') }}
            @if ($orcamento->pacote)
                • {{ $orcamento->pacote }}
            @endif
        </p>

        @if ($orcamento->status === 'pendente')
            <p class="evento-destaque__mensagem">
                Recebemos sua solicitação e nossa equipe está analisando os detalhes.
            </p>
        @elseif ($orcamento->status === 'aprovado')
            <p class="evento-destaque__mensagem">
                Seu orçamento foi aprovado! Em breve entraremos em contato para os próximos passos.
            </p>
        @else
            <p class="evento-destaque__mensagem">
                Não conseguimos aprovar este orçamento. Fale conosco para verificar outras possibilidades.
            </p>
        @endif
    </section>
@else
    <section class="evento-destaque">
        <span>SEU EVENTO</span>
        <h2>Você ainda não possui um orçamento</h2>
        <p>Solicite um orçamento para acompanhar a análise por aqui.</p>
    </section>
@endif


@endsection
