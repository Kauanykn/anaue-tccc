@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-galeria.css') }}">
@endpush

@section('content')

<section class="admin-galeria">

    <div class="admin-galeria__container">

        <div class="admin-galeria__cabecalho">

            <div>
                <span>Galeria</span>

                <h1>Editar foto</h1>

                <p>
                    Altere o título ou substitua a imagem cadastrada.
                </p>
            </div>

            <a
                href="{{ route('admin.galeria.index') }}"
                class="btn-voltar"
            >
                ← Voltar
            </a>

        </div>


        <div class="admin-galeria__card">

            <form
                action="{{ route('admin.galeria.update', $galeria->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                <div class="campo">

                    <label for="titulo">
                        Título da foto
                    </label>

                    <input
                        type="text"
                        name="titulo"
                        id="titulo"
                        value="{{ old('titulo', $galeria->titulo) }}"
                        required
                    >

                    @error('titulo')
                        <span class="erro">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="campo">

                    <label>
                        Foto atual
                    </label>

                    <div class="imagem-atual">

                        <img
                            src="{{ asset('storage/' . $galeria->imagem) }}"
                            alt="{{ $galeria->titulo }}"
                        >

                    </div>

                </div>


                <div class="campo">

                    <label for="imagem">
                        Trocar imagem
                    </label>

                    <label
                        for="imagem"
                        class="upload-box"
                    >

                        <div class="upload-box__icone">
                            <i class="fa-regular fa-image"></i>
                        </div>

                        <strong>
                            Clique para escolher uma nova imagem
                        </strong>

                        <span>
                            Se não escolher nenhuma, a foto atual será mantida.
                        </span>

                    </label>

                    <input
                        type="file"
                        name="imagem"
                        id="imagem"
                        accept="image/*"
                        hidden
                    >

                    @error('imagem')
                        <span class="erro">
                            {{ $message }}
                        </span>
                    @enderror

                </div>


                <div class="admin-galeria__acoes">

                    <a
                        href="{{ route('admin.galeria.index') }}"
                        class="btn-cancelar"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn-salvar"
                    >
                        Salvar alterações
                    </button>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection