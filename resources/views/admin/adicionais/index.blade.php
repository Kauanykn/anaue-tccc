@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-adicionais.css') }}">
@endpush

@section('content')

<div class="admin-adicionais">

    <div class="admin-adicionais__cabecalho">
        <div>
            <h1>Adicionais</h1>
            <p>Gerencie os adicionais disponíveis para os clientes.</p>
        </div>

        <a href="{{ route('admin.adicionais.create') }}" class="btn-adicionar">
            + Adicionar adicional
        </a>
    </div>

    @if(session('sucesso'))
        <div class="mensagem-sucesso">
            {{ session('sucesso') }}
        </div>
    @endif

    @if($adicionais->count() > 0)

        <div class="adicionais-grid">

            @foreach($adicionais as $adicional)

                <div class="adicional-card">

                    <div class="adicional-card__conteudo">

                        <h2>{{ $adicional->nome }}</h2>

                        @if($adicional->descricao)
                            <p>{{ $adicional->descricao }}</p>
                        @endif

                        <strong>
                            R$ {{ number_format($adicional->preco, 2, ',', '.') }}
                        </strong>

                    </div>

                    <div class="adicional-card__acoes">

                        <a
                            href="{{ route('admin.adicionais.edit', $adicional->id) }}"
                            class="btn-editar"
                        >
                            Editar
                        </a>

                        <form
                            action="{{ route('admin.adicionais.destroy', $adicional->id) }}"
                            method="POST"
                            onsubmit="return confirm('Deseja realmente excluir este adicional?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-excluir">
                                Excluir
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="sem-adicionais">
            <h2>Nenhum adicional cadastrado</h2>
            <p>Comece adicionando uma opção para os clientes.</p>

            <a href="{{ route('admin.adicionais.create') }}" class="btn-adicionar">
                Adicionar primeiro adicional
            </a>
        </div>

    @endif

</div>

@endsection