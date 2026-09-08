@extends('layouts.app')

@section('content')

<section style="max-width: 1200px; margin: 50px auto; padding: 0 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 20px; margin-bottom: 30px;">
        <div>
            <span>PAINEL ADMINISTRATIVO</span>
            <h1>Pedidos de orçamento</h1>
            <p>Veja as solicitações enviadas pelos clientes.</p>
        </div>

        <a
            href="{{ route('admin.dashboard') }}"
            style="padding: 10px 16px; background: #eee; border-radius: 8px; text-decoration: none; color: #222;"
        >
            Voltar ao painel
        </a>
    </div>

    @if ($orcamentos->isEmpty())
        <div style="padding: 30px; text-align: center; background: #f7f7f7; border-radius: 12px;">
            <h2>Nenhum orçamento recebido ainda.</h2>
            <p>Quando um cliente preencher o formulário, ele aparecerá aqui.</p>
        </div>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; background: white;">
                <thead>
                    <tr style="background: #f1f1f1;">
                        <th style="padding: 12px; text-align: left;">Cliente</th>
                        <th style="padding: 12px; text-align: left;">Aniversariante</th>
                        <th style="padding: 12px; text-align: left;">Contato</th>
                        <th style="padding: 12px; text-align: left;">Evento</th>
                        <th style="padding: 12px; text-align: left;">Convidados</th>
                        <th style="padding: 12px; text-align: left;">Pacote e observações</th>
                        <th style="padding: 12px; text-align: left;">Status</th>
                        <th style="padding: 12px; text-align: left;">Enviado em</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orcamentos as $orcamento)
                        <tr style="border-bottom: 1px solid #e5e5e5;">
                            <td style="padding: 12px;">
                                <strong>{{ $orcamento->nome }}</strong>
                            </td>

                            <td style="padding: 12px;">
                                {{ $orcamento->aniversariante ?? 'Não informado' }}
                                @if ($orcamento->idade)
                                    <br><small>{{ $orcamento->idade }}</small>
                                @endif
                            </td>

                            <td style="padding: 12px;">
                                {{ $orcamento->telefone }}

                                @if ($orcamento->email)
                                    <br>
                                    <small>{{ $orcamento->email }}</small>
                                @endif
                            </td>

                            <td style="padding: 12px;">
                                @if ($orcamento->data_evento)
                                    {{ $orcamento->data_evento->format('d/m/Y') }}
                                @else
                                    Não informada
                                @endif
                            </td>

                            <td style="padding: 12px;">
                                {{ $orcamento->quantidade_convidados ?? 'Não informado' }}
                            </td>

                            <td style="padding: 12px;">
                                {{ $orcamento->pacote ?? 'Não informado' }}
                                @if ($orcamento->observacoes)
                                    <br><small>{{ $orcamento->observacoes }}</small>
                                @endif
                            </td>

                            <td style="padding: 12px;">
                                {{ ucfirst($orcamento->status) }}
                            </td>

                            <td style="padding: 12px;">
                                {{ $orcamento->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</section>

@endsection
