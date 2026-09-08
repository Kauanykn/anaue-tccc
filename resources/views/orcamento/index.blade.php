@extends('layouts.app')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/orcamento.css') }}">
@endpush

<section class="orcamento-page">
    <div class="container">
        <a href="{{ url('/') }}" class="breadcrumb"><span class="breadcrumb-arrow">&larr;</span> Voltar para a página inicial</a>
        <h1 class="page-title">Vamos planejar sua festa?</h1>
        <p class="page-subtitle">Preencha os dados abaixo e nossa equipe te retorna<br class="hide-mobile">com uma proposta personalizada em até 24h.</p>

        <div class="planner-grid">
            <section class="card calendar-card">
                <div class="calendar-header">
                    <h2 class="card-heading">Confira a disponibilidade</h2>
                    <div class="calendar-nav">
                        <button type="button" id="mes-anterior" class="calendar-nav-btn" aria-label="Mês anterior">←</button>
                        <span class="calendar-month" id="calendar-month"></span>
                        <button type="button" id="proximo-mes" class="calendar-nav-btn" aria-label="Próximo mês">→</button>
                    </div>
                </div>
                <div class="calendar" id="calendario" data-datas-indisponiveis='@json($datasIndisponiveis)'>
                    <div class="calendar-weekdays"><span>D</span><span>S</span><span>T</span><span>Q</span><span>Q</span><span>S</span><span>S</span></div>
                    <div class="calendar-grid" id="calendar-grid"></div>
                </div>
                <div class="calendar-legend">
                    <span class="legend-item"><i class="legend-dot legend-dot--available"></i>Disponível</span>
                    <span class="legend-item"><i class="legend-dot legend-dot--reserved"></i>Indisponível</span>
                    <span class="legend-item"><i class="legend-dot legend-dot--selected"></i>Data selecionada</span>
                </div>
            </section>

            <section class="card form-card">
                <form action="{{ route('orcamento.store') }}" method="POST" class="orcamento-form">
                    @csrf
                    @if (session('success'))
                        <p style="color: green; margin-bottom: 16px;">{{ session('success') }}</p>
                    @endif
                    @if ($errors->any())
                        <div style="color: #b91c1c; margin-bottom: 16px;">
                            <p>Corrija os campos abaixo:</p>
                            <ul>@foreach ($errors->all() as $erro)<li>{{ $erro }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <div class="form-row">
                        <div class="form-field"><label for="nome">Nome *</label><input type="text" id="nome" name="nome" value="{{ old('nome') }}" placeholder="Seu nome" required></div>
                        <div class="form-field"><label for="telefone">Telefone/WhatsApp *</label><input type="tel" id="telefone" name="telefone" value="{{ old('telefone') }}" placeholder="(15) 99999-9999" required></div>
                    </div>
                    <div class="form-row form-row--single">
                        <div class="form-field"><label for="email">E-mail</label><input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="seunome@gmail.com"></div>
                    </div>
                    <hr class="form-divider">
                    <div class="form-row">
                        <div class="form-field"><label for="aniversariante">Nome do aniversariante/evento</label><input type="text" id="aniversariante" name="aniversariante" value="{{ old('aniversariante') }}" placeholder="Nome"></div>
                        <div class="form-field"><label for="idade">Idade que está completando</label><input type="text" id="idade" name="idade" value="{{ old('idade') }}" placeholder="Ex.: 5 anos"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-field"><label for="data_evento">Data desejada *</label><input type="date" id="data_evento" name="data_evento" value="{{ old('data_evento') }}" required></div>
                        <div class="form-field"><label for="quantidade_convidados">Número de convidados</label><input type="number" id="quantidade_convidados" name="quantidade_convidados" value="{{ old('quantidade_convidados') }}" min="1" placeholder="Ex.: 40"></div>
                    </div>
                    <div class="form-row form-row--single">
                        <div class="form-field">
                            <label for="pacote">Pacote de interesse</label>
                            <div class="select-wrap">
                                <select id="pacote" name="pacote">
                                    <option value="">Selecione um pacote</option>

                                    @foreach ($pacotes as $pacote)
                                        <option value="{{ $pacote->nome }}" @selected(old('pacote') === $pacote->nome)>
                                            {{ $pacote->nome }}
                                        </option>
                                    @endforeach

                                    <option value="Ainda não sei" @selected(old('pacote') === 'Ainda não sei')>
                                        Ainda não sei
                                    </option>
                                </select>
                                <svg class="select-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M6 9l6 6 6-6"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="form-row form-row--single">
                        <div class="form-field"><label for="observacoes">Conte um pouco sobre a festa (opcional)</label><textarea id="observacoes" name="observacoes" rows="4" placeholder="Tema, alguma necessidade especial...">{{ old('observacoes') }}</textarea></div>
                    </div>
                    <div class="form-footer">
                        <p class="form-disclaimer">Ao enviar, você concorda em ser contatado por e-mail ou WhatsApp sobre seu orçamento.</p>
                        <button type="submit" class="btn-submit">Enviar solicitação</button>
                    </div>
                </form>
            </section>

            <aside class="card steps-card">
                <h2 class="card-heading">O que acontece depois</h2>
                <ol class="steps-list">
                    <li class="step-item"><span class="step-number">1</span><div class="step-text"><p class="step-title">Recebemos seu pedido</p><p class="step-desc">Confirmação por e-mail na hora.</p></div></li>
                    <li class="step-item"><span class="step-number">2</span><div class="step-text"><p class="step-title">Análise de disponibilidade</p><p class="step-desc">Conferimos a agenda pra sua data.</p></div></li>
                    <li class="step-item"><span class="step-number">3</span><div class="step-text"><p class="step-title">Proposta personalizada</p><p class="step-desc">Você recebe os valores em até 24h.</p></div></li>
                    <li class="step-item"><span class="step-number">4</span><div class="step-text"><p class="step-title">Confirmação</p><p class="step-desc">Aprovando, é só assinar o contrato.</p></div></li>
                </ol>
            </aside>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const calendario = document.getElementById('calendario');
    const grid = document.getElementById('calendar-grid');
    const titulo = document.getElementById('calendar-month');
    const anterior = document.getElementById('mes-anterior');
    const proximo = document.getElementById('proximo-mes');
    const campoData = document.getElementById('data_evento');
    const indisponiveis = JSON.parse(calendario.dataset.datasIndisponiveis);
    const hoje = new Date();
    hoje.setHours(0, 0, 0, 0);
    const meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    let mes = hoje.getMonth();
    let ano = hoje.getFullYear();

    const paraBanco = (data) => {
        const dia = String(data.getDate()).padStart(2, '0');
        const mesDoAno = String(data.getMonth() + 1).padStart(2, '0');
        return `${data.getFullYear()}-${mesDoAno}-${dia}`;
    };

    function desenhar() {
        grid.innerHTML = '';
        titulo.textContent = `${meses[mes]} ${ano}`;
        const primeiroDia = new Date(ano, mes, 1).getDay();
        const totalDias = new Date(ano, mes + 1, 0).getDate();

        for (let indice = 0; indice < primeiroDia; indice++) {
            const vazio = document.createElement('div');
            vazio.className = 'calendar-cell calendar-cell--empty';
            grid.appendChild(vazio);
        }

        for (let dia = 1; dia <= totalDias; dia++) {
            const data = new Date(ano, mes, dia);
            data.setHours(0, 0, 0, 0);
            const valor = paraBanco(data);
            const botao = document.createElement('button');
            botao.type = 'button';
            botao.textContent = dia;
            botao.className = 'calendar-cell';

            if (data < hoje || indisponiveis.includes(valor)) {
                botao.classList.add('calendar-cell--reserved');
                botao.disabled = true;
            } else if (campoData.value === valor) {
                botao.classList.add('calendar-cell--selected');
            } else {
                botao.classList.add('calendar-cell--available');
                botao.addEventListener('click', () => {
                    campoData.value = valor;
                    desenhar();
                });
            }
            grid.appendChild(botao);
        }
        anterior.disabled = ano === hoje.getFullYear() && mes === hoje.getMonth();
    }

    proximo.addEventListener('click', () => {
        mes++;
        if (mes === 12) { mes = 0; ano++; }
        desenhar();
    });
    anterior.addEventListener('click', () => {
        if (ano === hoje.getFullYear() && mes === hoje.getMonth()) return;
        mes--;
        if (mes === -1) { mes = 11; ano--; }
        desenhar();
    });
    campoData.addEventListener('change', desenhar);
    desenhar();
});
</script>
@endsection
