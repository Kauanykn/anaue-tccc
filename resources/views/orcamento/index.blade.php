@extends('layouts.app')

@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/orcamento.css') }}">
@endpush



<section class="orcamento-page">
    <div class="container">

        <a href="{{ url('/') }}" class="breadcrumb">
            <span class="breadcrumb-arrow">&larr;</span> Voltar para a página inicial
        </a>

        <h1 class="page-title">Vamos planejar sua festa?</h1>
        <p class="page-subtitle">
            Preencha os dados abaixo e nossa equipe te retorna<br class="hide-mobile">
            com uma proposta personalizada em até 24h.
        </p>

        <div class="planner-grid">

            {{-- ---------- CALENDÁRIO ---------- --}}
            <section class="card calendar-card">
                <div class="calendar-header">
                    <h2 class="card-heading">Confira a disponibilidade</h2>

                    <div class="calendar-nav">
                        <button type="button" class="calendar-nav-btn" aria-label="Mês anterior">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M15 18l-6-6 6-6"/></svg>
                        </button>
                        <span class="calendar-month">Setembro 2026</span>
                        <button type="button" class="calendar-nav-btn" aria-label="Próximo mês">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M9 6l6 6-6 6"/></svg>
                        </button>
                    </div>
                </div>

                @php
                    // Estes dados virão do backend futuramente.
                    $weekdays = ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'];

                    // offset = quantas células vazias antes do dia 1 (Setembro/2026 começa numa terça-feira)
                    $offset = 2;
                    $daysInMonth = 30;
                    $reservedDays = [5, 12, 13, 19, 26];
                    $selectedDay  = null;
                @endphp

                <div class="calendar">
                    <div class="calendar-weekdays">
                        @foreach ($weekdays as $day)
                            <span>{{ $day }}</span>
                        @endforeach
                    </div>

                    <div class="calendar-grid">
                        @for ($i = 0; $i < $offset; $i++)
                            <div class="calendar-cell calendar-cell--empty"></div>
                        @endfor

                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $state = 'available';
                                if (in_array($day, $reservedDays)) $state = 'reserved';
                                if ($day === $selectedDay) $state = 'selected';
                            @endphp
                            <button type="button" class="calendar-cell calendar-cell--{{ $state }}">
                                {{ $day }}
                            </button>
                        @endfor
                    </div>
                </div>

                <div class="calendar-legend">
                    <span class="legend-item"><i class="legend-dot legend-dot--available"></i>Disponível</span>
                    <span class="legend-item"><i class="legend-dot legend-dot--reserved"></i>Já reservado</span>
                    <span class="legend-item"><i class="legend-dot legend-dot--selected"></i>Data selecionada</span>
                </div>
            </section>

            {{-- ---------- FORMULÁRIO ---------- --}}
            <section class="card form-card">
                <form action="{{ url('/orcamento') }}" method="POST" class="orcamento-form">
                    @csrf

                    <div class="form-row">
                        <div class="form-field">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" placeholder="Seu nome">
                        </div>
                        <div class="form-field">
                            <label for="telefone">Telefone/WhatsApp</label>
                            <input type="tel" id="telefone" name="telefone" placeholder="(15) 92222-0000">
                        </div>
                    </div>

                    <div class="form-row form-row--single">
                        <div class="form-field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="seunome@gmail.com">
                        </div>
                    </div>

                    <hr class="form-divider">

                    <div class="form-row">
                        <div class="form-field">
                            <label for="aniversariante">Nome do aniversariante/evento</label>
                            <input type="text" id="aniversariante" name="aniversariante" placeholder="Nome">
                        </div>
                        <div class="form-field">
                            <label for="idade">Idade que está completando</label>
                            <input type="text" id="idade" name="idade" placeholder="5 anos">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="data">Data desejada</label>
                            <input type="text" id="data" name="data" placeholder="dd/mm/aaaa">
                        </div>
                        <div class="form-field">
                            <label for="convidados">Número de convidados</label>
                            <input type="text" id="convidados" name="convidados" placeholder="Ex: 40">
                        </div>
                    </div>

                    <div class="form-row form-row--single">
                        <div class="form-field">
                            <label for="pacote">Pacote de interesse</label>
                            <div class="select-wrap">
                                <select id="pacote" name="pacote">
                                    <option>Brinca legal</option>
                                    <option>Festa completa</option>
                                    <option>Espaço + decoração</option>
                                    <option>Ainda não sei</option>
                                </select>
                                <svg class="select-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="form-row form-row--single">
                        <div class="form-field">
                            <label for="observacoes">Conte um pouco sobre a festa (opcional)</label>
                            <textarea id="observacoes" name="observacoes" rows="4" placeholder="Tema, alguma necessidade especial..."></textarea>
                        </div>
                    </div>

                    <div class="form-footer">
                        <p class="form-disclaimer">Ao enviar, você concorda em ser contatado por e-mail ou WhatsApp sobre seu orçamento.</p>
                        <button type="submit" class="btn-submit">Enviar solicitação</button>
                    </div>
                </form>
            </section>

            {{-- ---------- O QUE ACONTECE DEPOIS ---------- --}}
            <aside class="card steps-card">
                <h2 class="card-heading">O que acontece depois</h2>

                <ol class="steps-list">
                    <li class="step-item">
                        <span class="step-number">1</span>
                        <div class="step-text">
                            <p class="step-title">Recebemos seu pedido</p>
                            <p class="step-desc">Confirmação por e-mail na hora.</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <span class="step-number">2</span>
                        <div class="step-text">
                            <p class="step-title">Análise de disponibilidade</p>
                            <p class="step-desc">Conferimos a agenda pra sua data.</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <span class="step-number">3</span>
                        <div class="step-text">
                            <p class="step-title">Proposta personalizada</p>
                            <p class="step-desc">Você recebe os valores em até 24h.</p>
                        </div>
                    </li>
                    <li class="step-item">
                        <span class="step-number">4</span>
                        <div class="step-text">
                            <p class="step-title">Confirmação</p>
                            <p class="step-desc">Aprovando, é só assinar o contrato.</p>
                        </div>
                    </li>
                </ol>
            </aside>

        </div>
    </div>
</section>

@endsection