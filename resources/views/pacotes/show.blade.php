@extends('layouts.app')

@section('title', $pacote->nome)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pacotes-detalhes.css') }}">
@endpush

@section('content')

<section class="pacote-detalhes">

    <div class="pacote-detalhes__container">

        <header class="pacote-topo">

            <span>Conheça o pacote</span>

            <h1>{{ $pacote->nome }}</h1>

            <p>
                {{ $pacote->duracao }} horas de festa
                |
                {{ $pacote->decoracao_inclusa
                    ? 'Decoração inclusa'
                    : 'Decoração não inclusa'
                }}
            </p>

        </header>


        <div class="pacote-banner">

            <img
                src="{{ asset('storage/' . $pacote->imagem) }}"
                alt="{{ $pacote->nome }}"
            >

        </div>


        <section class="descricao-pacote">

            <h2>Sobre o pacote</h2>

            <p>
                {{ $pacote->descricao }}
            </p>

        </section>


        <section class="cardapio">

            <h2>Cardápio</h2>

            <div class="cardapio-conteudo">
                {!! nl2br(e($pacote->cardapio)) !!}
            </div>

        </section>


        <section class="pacote-observacao">

            <span>Informações do pacote</span>

            <h2>Valores</h2>

            <p>
                {{ $pacote->duracao }} horas para aproveitar cada momento.
            </p>

        </section>


        <section class="valores-card">

            <div class="valores-grupo">

                <h3>
                    SEGUNDA À QUINTA, EXCETO FERIADO
                </h3>

                <div class="valor-linha">

                    <span>30 Pessoas</span>

                    <strong>
                        R$
                        <span>
                            {{ number_format(
                                $pacote->preco_semana_30,
                                2,
                                ',',
                                '.'
                            ) }}
                        </span>
                    </strong>

                </div>


                <div class="valor-linha">

                    <span>50 Pessoas</span>

                    <strong>
                        R$
                        <span>
                            {{ number_format(
                                $pacote->preco_semana_50,
                                2,
                                ',',
                                '.'
                            ) }}
                        </span>
                    </strong>

                </div>

            </div>


            <div class="divisor-valores"></div>


            <div class="valores-grupo">

                <h3>
                    SEXTA, SÁBADO, DOMINGO OU FERIADO
                </h3>

                <div class="valor-linha">

                    <span>30 Pessoas</span>

                    <strong>
                        R$
                        <span>
                            {{ number_format(
                                $pacote->preco_fim_semana_30,
                                2,
                                ',',
                                '.'
                            ) }}
                        </span>
                    </strong>

                </div>


                <div class="valor-linha">

                    <span>50 Pessoas</span>

                    <strong>
                        R$
                        <span>
                            {{ number_format(
                                $pacote->preco_fim_semana_50,
                                2,
                                ',',
                                '.'
                            ) }}
                        </span>
                    </strong>

                </div>

            </div>


            <div class="valor-excedente">

                Convidado Excedente:

                <strong>
                    R$
                    {{ number_format(
                        $pacote->valor_excedente,
                        2,
                        ',',
                        '.'
                    ) }}
                </strong>

            </div>


            <p class="valor-observacao">

                Em até {{ $pacote->parcelas }}x sem juros no cartão

                <br>

                (não parcelamos excedentes após a festa)

            </p>

        </section>


        <div class="pacote-cta">

            <div>

                <h2>Gostou desse pacote?</h2>

                <p>
                    Solicite um orçamento personalizado para sua festa.
                </p>

            </div>

            <a href="#" class="btn-orcamento-pacote">
                Solicitar orçamento
            </a>

        </div>

    </div>

</section>

@endsection