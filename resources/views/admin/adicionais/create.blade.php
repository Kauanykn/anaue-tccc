@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-adicionais.css') }}">
@endpush

@section('content')

<div class="form-adicional">

    <div class="form-adicional__cabecalho">
        <h1>Adicionar adicional</h1>
        <p>Cadastre uma nova opção para os clientes.</p>
    </div>

    @if($errors->any())

        <div class="mensagem-erro">

            @foreach($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach

        </div>

    @endif

    <form
        action="{{ route('admin.adicionais.store') }}"
        method="POST"
    >

        @csrf

        <div class="campo">

            <label for="nome">
                Nome do adicional
            </label>

            <input
                type="text"
                id="nome"
                name="nome"
                value="{{ old('nome') }}"
                placeholder="Ex: Mesa de doces"
                required
            >

        </div>

        <div class="campo">

            <label for="descricao">
                Descrição
            </label>

            <textarea
                id="descricao"
                name="descricao"
                rows="4"
                placeholder="Descreva o que está incluso..."
            >{{ old('descricao') }}</textarea>

        </div>

        <div class="campo">

            <label for="preco">
                Preço
            </label>

            <input
                type="number"
                id="preco"
                name="preco"
                value="{{ old('preco') }}"
                step="0.01"
                min="0"
                placeholder="150.00"
                required
            >

        </div>

        <div class="form-acoes">

            <a
                href="{{ route('admin.adicionais.index') }}"
                class="btn-voltar"
            >
                Cancelar
            </a>

            <button type="submit" class="btn-salvar">
                Salvar adicional
            </button>

        </div>

    </form>

</div>

@endsection