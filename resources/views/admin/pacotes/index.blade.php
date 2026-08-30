@extends('layouts.app')

@section('title', 'Pacotes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-pacotes.css') }}">
@endpush

@section('content')

<section class="admin-pacotes-lista">

    <div class="admin-pacote__container">

        <div class="admin-pacote__topo">

            <div>
                <span class="depoimentos-label">— PAINEL ADMINISTRATIVO</span>

                <h1>Pacotes</h1>

                <p>
                    Gerencie os pacotes disponíveis no site.
                </p>
            </div>

            <a
                href="{{ route('admin.pacotes.create') }}"
                class="btn-novo-pacote"
            >
                <i class="fa-solid fa-plus"></i>
                Novo pacote
            </a>

        </div>


        @if(session('success'))

            <div class="mensagem-sucesso">
                <i class="fa-solid fa-circle-check"></i>

                {{ session('success') }}
            </div>

        @endif


        @if($pacotes->isEmpty())

            <div class="pacotes-vazio">

                <i class="fa-solid fa-box-open"></i>

                <h2>Nenhum pacote cadastrado</h2>

                <p>
                    Cadastre o primeiro pacote para ele aparecer aqui.
                </p>

                <a href="{{ route('admin.pacotes.create') }}">
                    Cadastrar pacote
                </a>

            </div>

        @else

            <div class="admin-pacotes-grid">

                @foreach($pacotes as $pacote)

                    <article class="admin-pacote-card">

                        <div class="admin-pacote-card__imagem">

                            <img
                                src="{{ asset('storage/' . $pacote->imagem) }}"
                                alt="{{ $pacote->nome }}"
                            >

                            @if($pacote->ativo)

                                <span class="status-pacote ativo">
                                    Ativo
                                </span>

                            @else

                                <span class="status-pacote inativo">
                                    Inativo
                                </span>

                            @endif

                        </div>


                        <div class="admin-pacote-card__conteudo">

                            <h2>
                                {{ $pacote->nome }}
                            </h2>

                            <p>
                                {{ $pacote->duracao }} horas de festa
                            </p>


                            <div class="admin-pacote-card__acoes">

                                <a
                                    href="{{ route('admin.pacotes.edit', $pacote) }}"
                                    class="btn-editar"
                                >
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Editar
                                </a>


                                <form
                                    action="{{ route('admin.pacotes.destroy', $pacote) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-excluir"
                                        onclick="return confirm('Deseja realmente excluir este pacote?')"
                                    >
                                        <i class="fa-regular fa-trash-can"></i>
                                        Excluir
                                    </button>

                                </form>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @endif

    </div>

</section>

@endsection