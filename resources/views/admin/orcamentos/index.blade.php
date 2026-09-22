@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-orcamentos.css') }}">

<section class="orcamentos-admin">
    <header class="orcamentos-admin__cabecalho">
        <div>
            <span class="orcamentos-admin__eyebrow">PAINEL ADMINISTRATIVO</span>
            <h1>Pedidos de orçamento</h1>
            <p>Analise os pedidos e informe a decisão ao cliente.</p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn-voltar">
            <i class="fa-solid fa-arrow-left"></i>
            Voltar ao painel
        </a>
    </header>

    @if (session('success'))
        <div class="alerta-sucesso">{{ session('success') }}</div>
    @endif

    @if ($orcamentos->isEmpty())
        <div class="orcamentos-vazio">
            <i class="fa-regular fa-file-lines"></i>
            <h2>Nenhum orçamento recebido ainda.</h2>
            <p>As solicitações dos clientes aparecerão aqui.</p>
        </div>
    @else
        <div class="orcamentos-lista">
            @foreach ($orcamentos as $orcamento)
                <article class="orcamento-card">
                    <div class="orcamento-card__topo">
                        <div>
                            <span class="orcamento-card__codigo">
                                PEDIDO #{{ str_pad($orcamento->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                            <h2>{{ $orcamento->nome }}</h2>
                        </div>

                        <span class="status status--{{ $orcamento->status }}">
                            {{ ucfirst($orcamento->status) }}
                        </span>
                    </div>

                    <div class="orcamento-card__dados">
                        <div>
                            <small>ANIVERSARIANTE</small>
                            <strong>{{ $orcamento->aniversariante ?? 'Não informado' }}</strong>
                            @if ($orcamento->idade)
                                <span>{{ $orcamento->idade }}</span>
                            @endif
                        </div>

                        <div>
                            <small>DATA DO EVENTO</small>
                            <strong>
                                {{ $orcamento->data_evento?->format('d/m/Y') ?? 'Não informada' }}
                            </strong>
                        </div>

                        <div>
                            <small>CONVIDADOS</small>
                            <strong>{{ $orcamento->quantidade_convidados ?? 'Não informado' }}</strong>
                        </div>

                        <div>
                            <small>PACOTE</small>
                            <strong>{{ $orcamento->pacote ?? 'Não informado' }}</strong>
                        </div>
                    </div>

                    <div class="orcamento-card__contato">
                        <span><i class="fa-solid fa-phone"></i> {{ $orcamento->telefone }}</span>
                        @if ($orcamento->email)
                            <span><i class="fa-solid fa-envelope"></i> {{ $orcamento->email }}</span>
                        @endif
                        <span><i class="fa-regular fa-clock"></i> {{ $orcamento->created_at->format('d/m/Y \à\s H:i') }}</span>
                    </div>

                    @if ($orcamento->observacoes)
                        <div class="orcamento-card__observacoes">
                            <strong>Observações</strong>
                            <p>{{ $orcamento->observacoes }}</p>
                        </div>
                    @endif

                    @if ($orcamento->status === 'pendente')
                        <form
                            action="{{ route('admin.orcamentos.status', $orcamento) }}"
                            method="POST"
                            class="orcamento-card__acoes"
                        >
                            @csrf
                            @method('PATCH')

                            <button type="submit" name="status" value="aprovado" class="btn-status btn-status--aprovar">
                                <i class="fa-solid fa-check"></i>
                                Aprovar orçamento
                            </button>

                            <button type="submit" name="status" value="recusado" class="btn-status btn-status--recusar">
                                <i class="fa-solid fa-xmark"></i>
                                Recusar
                            </button>
                        </form>
                    @else
                        <p class="orcamento-card__finalizado">
                            Este orçamento já foi {{ $orcamento->status }}.
                        </p>
                    @endif
                </article>
            @endforeach
        </div>
    @endif
</section>

@endsection