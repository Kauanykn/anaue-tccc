@extends('layouts.dashboard-cliente')

@section('title', 'Meus Orçamentos')

@section('content')
    <a href="{{ route('home') }}" class="btn-voltar-home">
        <i class="fa-solid fa-arrow-left"></i>
        Voltar para o site
    </a>

    <header class="orcamentos-cliente__cabecalho">
        <div>
            <p class="orcamentos-cliente__eyebrow">ÁREA DO CLIENTE</p>
            <h1>Meus orçamentos</h1>
            <p>Acompanhe todas as solicitações que você enviou.</p>
        </div>

        <a href="{{ route('orcamento') }}" class="btn-solicitar-orcamento">
            <i class="fa-solid fa-plus"></i>
            Solicitar orçamento
        </a>
    </header>

    @if ($orcamentos->isEmpty())
        <section class="orcamentos-cliente__vazio">
            <i class="fa-regular fa-file-lines"></i>
            <h2>Nenhum orçamento solicitado ainda</h2>
            <p>Quando você enviar uma solicitação, ela aparecerá aqui para acompanhamento.</p>
        </section>
    @else
        <section class="orcamentos-cliente__lista" aria-label="Lista de orçamentos">
            @foreach ($orcamentos as $orcamento)
                <article class="orcamento-cliente-card">
                    <div class="orcamento-cliente-card__topo">
                        <div>
                            <span>ORÇAMENTO #{{ str_pad($orcamento->id, 4, '0', STR_PAD_LEFT) }}</span>
                            <h2>{{ $orcamento->aniversariante ? 'Festa de ' . $orcamento->aniversariante : 'Seu evento' }}</h2>
                        </div>
                        <strong class="status-cliente status-cliente--{{ $orcamento->status }}">
                            {{ ucfirst($orcamento->status) }}
                        </strong>
                    </div>

                    <dl class="orcamento-cliente-card__dados">
                        <div>
                            <dt>Data do evento</dt>
                            <dd>{{ $orcamento->data_evento?->format('d/m/Y') ?? 'Não informada' }}</dd>
                        </div>
                        <div>
                            <dt>Pacote</dt>
                            <dd>{{ $orcamento->pacote ?? 'Personalizado' }}</dd>
                        </div>
                        <div>
                            <dt>Convidados</dt>
                            <dd>{{ $orcamento->quantidade_convidados ?? 'Não informado' }}</dd>
                        </div>
                        <div>
                            <dt>Solicitado em</dt>
                            <dd>{{ $orcamento->created_at->format('d/m/Y') }}</dd>
                        </div>
                    </dl>

                    <p class="orcamento-cliente-card__mensagem">
                        @if ($orcamento->status === 'pendente')
                            Recebemos sua solicitação e nossa equipe está analisando os detalhes.
                        @elseif ($orcamento->status === 'aprovado')
                            Seu orçamento foi aprovado. Em breve entraremos em contato para os próximos passos.
                        @else
                            Não conseguimos aprovar este orçamento. Fale conosco para verificar outras possibilidades.
                        @endif
                    </p>
                </article>
            @endforeach
        </section>
    @endif
@endsection
