@extends('layouts.app')

@section('title', 'Depoimentos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/depoimentos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-depoimentos.css') }}">
@endpush

@section('content')

<section class="depoimentos admin-depoimentos">

    {{-- CABEÇALHO --}}
    <div class="depoimentos-topo">
        <div>
            <span class="depoimentos-label">— PAINEL ADMINISTRATIVO</span>

            <h1>Depoimentos dos clientes</h1>

            <p>
                Gerencie as avaliações publicadas pelos clientes do Anauê.
            </p>
        </div>
    </div>


    {{-- MENSAGEM DE SUCESSO --}}
    @if(session('success'))
        <div class="admin-mensagem-sucesso">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif


    {{-- NENHUM DEPOIMENTO --}}
    @if($depoimentos->isEmpty())

        <div class="admin-depoimentos-vazio">
            <i class="fa-regular fa-comments"></i>

            <h2>Nenhum depoimento cadastrado</h2>

            <p>
                Ainda não existem avaliações publicadas pelos clientes.
            </p>
        </div>

    @else

        {{-- GRID DOS DEPOIMENTOS --}}
        <div class="depoimentos-grid">

            @foreach($depoimentos as $depoimento)

                <article class="card-depoimento">

                    {{-- USUÁRIO --}}
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

                        <div>
                            <h2>
                                {{ $depoimento->usuario->name }}
                            </h2>

                            <small>
                                cliente Anauê
                            </small>
                        </div>

                    </div>


                    {{-- NOTA --}}
                    <div class="nota-depoimento">

                        @for($i = 1; $i <= 5; $i++)

                            @if($i <= $depoimento->nota)
                                ★
                            @else
                                ☆
                            @endif

                        @endfor

                    </div>


                    {{-- COMENTÁRIO --}}
                    <p class="comentario-depoimento">
                        {{ $depoimento->comentario }}
                    </p>


                    {{-- DATA --}}
                    <small class="data-depoimento">
                        {{ $depoimento->created_at->format('d \d\e F \d\e Y') }}
                    </small>


                    {{-- AÇÃO ADMIN --}}
                    <div class="acoes-depoimento admin-acoes">

                        <form
                            action="{{ route('admin.depoimentos.destroy', $depoimento) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn-excluir-depoimento"
                                onclick="return confirm('Tem certeza que deseja excluir este depoimento?')"
                            >
                                <i class="fa-regular fa-trash-can"></i>
                                Excluir avaliação
                            </button>

                        </form>

                    </div>

                </article>

            @endforeach

        </div>

    @endif

</section>

@endsection