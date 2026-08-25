@extends('layouts.app')

@section('title', 'Editar Pacote')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-pacotes.css') }}">
@endpush

@section('content')

<section class="admin-pacote">

    <div class="admin-pacote__container">

        <div class="admin-pacote__topo">

            <div>
                <span>PAINEL ADMINISTRATIVO</span>

                <h1>Editar pacote</h1>

                <p>
                    Altere as informações do pacote {{ $pacote->nome }}.
                </p>
            </div>

            <a
                href="{{ route('admin.pacotes.index') }}"
                class="btn-voltar"
            >
                <i class="fa-solid fa-arrow-left"></i>
                Voltar
            </a>

        </div>


        {{-- ERROS --}}
        @if ($errors->any())

            <div class="mensagem-erros">

                @foreach ($errors->all() as $erro)
                    <p>{{ $erro }}</p>
                @endforeach

            </div>

        @endif


        <form
            action="{{ route('admin.pacotes.update', $pacote) }}"
            method="POST"
            enctype="multipart/form-data"
            class="form-pacote"
        >

            @csrf
            @method('PUT')


            {{-- INFORMAÇÕES PRINCIPAIS --}}
            <div class="form-secao">

                <h2>Informações principais</h2>


                <div class="form-grid">

                    <div class="campo campo-grande">

                        <label for="nome">
                            Nome do pacote
                        </label>

                        <input
                            type="text"
                            name="nome"
                            id="nome"
                            value="{{ old('nome', $pacote->nome) }}"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="duracao">
                            Duração
                        </label>

                        <input
                            type="number"
                            name="duracao"
                            id="duracao"
                            min="1"
                            value="{{ old('duracao', $pacote->duracao) }}"
                            required
                        >

                        <small>Em horas</small>

                    </div>

                </div>


                <div class="campo">

                    <label for="descricao">
                        Descrição
                    </label>

                    <textarea
                        name="descricao"
                        id="descricao"
                        rows="5"
                        required
                    >{{ old('descricao', $pacote->descricao) }}</textarea>

                </div>


                {{-- IMAGEM ATUAL --}}
                <div class="campo">

                    <label>
                        Imagem atual
                    </label>

                    <div class="imagem-atual">

                        <img
                            src="{{ asset('storage/' . $pacote->imagem) }}"
                            alt="{{ $pacote->nome }}"
                        >

                    </div>

                </div>


                {{-- NOVA IMAGEM --}}
                <div class="campo">

                    <label for="imagem">
                        Trocar imagem
                    </label>

                    <input
                        type="file"
                        name="imagem"
                        id="imagem"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Deixe vazio para continuar usando a imagem atual.
                    </small>

                </div>


                <div class="checkboxes">

                    <label>

                        <input
                            type="checkbox"
                            name="decoracao_inclusa"
                            value="1"
                            {{ old('decoracao_inclusa', $pacote->decoracao_inclusa) ? 'checked' : '' }}
                        >

                        Decoração inclusa

                    </label>


                    <label>

                        <input
                            type="checkbox"
                            name="ativo"
                            value="1"
                            {{ old('ativo', $pacote->ativo) ? 'checked' : '' }}
                        >

                        Pacote ativo

                    </label>

                </div>

            </div>


            {{-- CARDÁPIO --}}
            <div class="form-secao">

                <h2>Cardápio</h2>

                <p class="form-ajuda">
                    Edite os itens e categorias do cardápio.
                </p>

                <div class="campo">

                    <textarea
                        name="cardapio"
                        id="cardapio"
                        rows="14"
                        required
                    >{{ old('cardapio', $pacote->cardapio) }}</textarea>

                </div>

            </div>


            {{-- VALORES --}}
            <div class="form-secao">

                <h2>Valores</h2>


                <h3>Segunda à quinta, exceto feriado</h3>

                <div class="form-grid form-grid--precos">

                    <div class="campo">

                        <label for="preco_semana_30">
                            30 pessoas
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="preco_semana_30"
                            id="preco_semana_30"
                            value="{{ old('preco_semana_30', $pacote->preco_semana_30) }}"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="preco_semana_50">
                            50 pessoas
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="preco_semana_50"
                            id="preco_semana_50"
                            value="{{ old('preco_semana_50', $pacote->preco_semana_50) }}"
                            required
                        >

                    </div>

                </div>


                <h3>Sexta, sábado, domingo ou feriado</h3>

                <div class="form-grid form-grid--precos">

                    <div class="campo">

                        <label for="preco_fim_semana_30">
                            30 pessoas
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="preco_fim_semana_30"
                            id="preco_fim_semana_30"
                            value="{{ old('preco_fim_semana_30', $pacote->preco_fim_semana_30) }}"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="preco_fim_semana_50">
                            50 pessoas
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="preco_fim_semana_50"
                            id="preco_fim_semana_50"
                            value="{{ old('preco_fim_semana_50', $pacote->preco_fim_semana_50) }}"
                            required
                        >

                    </div>

                </div>


                <div class="form-grid form-grid--precos">

                    <div class="campo">

                        <label for="valor_excedente">
                            Convidado excedente
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="valor_excedente"
                            id="valor_excedente"
                            value="{{ old('valor_excedente', $pacote->valor_excedente) }}"
                            required
                        >

                    </div>


                    <div class="campo">

                        <label for="parcelas">
                            Parcelamento
                        </label>

                        <input
                            type="number"
                            name="parcelas"
                            id="parcelas"
                            min="1"
                            value="{{ old('parcelas', $pacote->parcelas) }}"
                            required
                        >

                        <small>
                            Número máximo de parcelas
                        </small>

                    </div>

                </div>

            </div>


            {{-- BOTÕES --}}
            <div class="form-acoes">

                <a
                    href="{{ route('admin.pacotes.index') }}"
                    class="btn-cancelar"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn-salvar"
                >
                    <i class="fa-solid fa-floppy-disk"></i>

                    Salvar alterações
                </button>

            </div>

        </form>

    </div>

</section>

@endsection