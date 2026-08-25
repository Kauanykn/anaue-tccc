@extends('layouts.app')

@section('title', 'Cadastrar Pacote')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-pacotes.css') }}">
@endpush

@section('content')

<section class="admin-pacote">

    <div class="admin-pacote__container">

        <div class="admin-pacote__topo">

            <div>
                <span>PAINEL ADMINISTRATIVO</span>
                <h1>Novo pacote</h1>

                <p>
                    Preencha as informações que serão exibidas
                    no site.
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


        <form
            action="{{ route('admin.pacotes.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="form-pacote"
        >

            @csrf


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
                            value="{{ old('nome') }}"
                            placeholder="Ex: Coquetel"
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
                            value="{{ old('duracao', 4) }}"
                            min="1"
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
                    >{{ old('descricao') }}</textarea>

                </div>


                <div class="campo">

                    <label for="imagem">
                        Imagem do pacote
                    </label>

                    <input
                        type="file"
                        name="imagem"
                        id="imagem"
                        accept=".jpg,.jpeg,.png,.webp"
                        required
                    >

                </div>


                <div class="checkboxes">

                    <label>
                        <input
                            type="checkbox"
                            name="decoracao_inclusa"
                            value="1"
                            {{ old('decoracao_inclusa') ? 'checked' : '' }}
                        >

                        Decoração inclusa
                    </label>


                    <label>
                        <input
                            type="checkbox"
                            name="ativo"
                            value="1"
                            checked
                        >

                        Pacote ativo
                    </label>

                </div>

            </div>



            <div class="form-secao">

                <h2>Cardápio</h2>

                <p class="form-ajuda">
                    Coloque um item por linha. Você também pode
                    escrever os títulos das categorias.
                </p>

                <div class="campo">

                    <textarea
                        name="cardapio"
                        id="cardapio"
                        rows="14"
                        placeholder="Para começar bem:
Salgados fritos
Polentinhas
Pastel de carne

Deliciosos e quentinhos:
Pizza
Esfiha
Mini hambúrguer"
                        required
                    >{{ old('cardapio') }}</textarea>

                </div>

            </div>



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
                            name="preco_semana_30"
                            id="preco_semana_30"
                            value="{{ old('preco_semana_30') }}"
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
                            name="preco_semana_50"
                            id="preco_semana_50"
                            value="{{ old('preco_semana_50') }}"
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
                            name="preco_fim_semana_30"
                            id="preco_fim_semana_30"
                            value="{{ old('preco_fim_semana_30') }}"
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
                            name="preco_fim_semana_50"
                            id="preco_fim_semana_50"
                            value="{{ old('preco_fim_semana_50') }}"
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
                            name="valor_excedente"
                            id="valor_excedente"
                            value="{{ old('valor_excedente') }}"
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
                            value="{{ old('parcelas', 8) }}"
                            min="1"
                            required
                        >

                        <small>
                            Número máximo de parcelas
                        </small>

                    </div>

                </div>

            </div>


            <div class="form-acoes">

                <a
                    href="{{ route('admin.pacotes.index') }}"
                    class="btn-cancelar"
                >
                    Cancelar
                </a>

        <button type="submit" class="btn-salvar">
        <i class="fa-solid fa-check"></i>
        Cadastrar pacote
        </button>

            </div>

        </form>

    </div>

</section>

@endsection