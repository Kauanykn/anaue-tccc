@extends('layouts.app')

@section('title', 'Pacotes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pacotes.css') }}">
@endpush

@section('content')

<section class="pagina-pacotes">

    <div class="pacotes-container">

        <h1 class="pacotes-titulo">
            <span>Anauê</span> Espaço Infantil | Pacotes
        </h1>

        @if($pacotes->isEmpty())

    <div class="pacotes-vazio">
        <h2>Nenhum pacote disponível no momento</h2>

        <p>
            Em breve teremos novas opções para sua festa.
        </p>
    </div>

@else

    @foreach($pacotes as $pacote)

        <article
            class="pacote-item {{ $loop->even ? 'pacote-invertido' : '' }}"
        >

            <div class="pacote-imagem">

                <img
                    src="{{ asset('storage/' . $pacote->imagem) }}"
                    alt="{{ $pacote->nome }}"
                >

            </div>


            <div class="pacote-conteudo">

                <h2>
                    {{ $pacote->nome }}
                </h2>

                <small>
                    {{ $pacote->duracao }} horas de festa
                    |

                    {{ $pacote->decoracao_inclusa
                        ? 'Decoração inclusa'
                        : 'Decoração não inclusa'
                    }}
                </small>

                <p>
                    {{ $pacote->descricao }}
                </p>

                <a
                    href="{{ route('pacotes.show', $pacote) }}"
                    class="btn-informacoes"
                >
                    Informações
                </a>

            </div>

        </article>

    @endforeach

@endif
</section>

@endsection