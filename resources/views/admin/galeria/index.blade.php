@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-galeria.css') }}">
@endpush

@section('content')

<section class="gerenciar-galeria">

    <div class="gerenciar-galeria__container">

        <div class="gerenciar-galeria__cabecalho">

            <div>
                <span>Administração</span>

                <h1>Gerenciar galeria</h1>

                <p>
                    Adicione, edite ou remova as fotos exibidas
                    na galeria do site.
                </p>
            </div>

            <a
                href="{{ route('admin.galeria.create') }}"
                class="btn-adicionar"
            >
                <span>+</span>
                Adicionar foto
            </a>

        </div>


        @if(session('success'))

            <div class="mensagem-sucesso">
                {{ session('success') }}
            </div>

        @endif


        @if($fotos->isEmpty())

            <div class="galeria-vazia">

                <div class="galeria-vazia__icone">
                    <i class="fa-regular fa-image"></i>
                </div>

                <h2>Nenhuma foto cadastrada</h2>

                <p>
                    Adicione a primeira foto da galeria.
                </p>

                <a
                    href="{{ route('admin.galeria.create') }}"
                    class="btn-adicionar"
                >
                    + Adicionar foto
                </a>

            </div>

        @else

            <div class="galeria-admin__grid">

                @foreach($fotos as $foto)

                    <article class="galeria-admin__card">

                        <div class="galeria-admin__imagem">

                            <img
                                src="{{ asset('storage/' . $foto->imagem) }}"
                                alt="{{ $foto->titulo }}"
                            >

                        </div>


                        <div class="galeria-admin__conteudo">

                            <h3>
                                {{ $foto->titulo }}
                            </h3>

                            <span class="galeria-admin__data">
                                Adicionada em
                                {{ $foto->created_at->format('d/m/Y') }}
                            </span>


                            <div class="galeria-admin__acoes">

                                <a
                                    href="{{ route('admin.galeria.edit', $foto->id) }}"
                                    class="btn-editar"
                                >
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Editar
                                </a>


                                <form
                                    action="{{ route('admin.galeria.destroy', $foto->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Deseja realmente excluir esta foto?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-excluir"
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