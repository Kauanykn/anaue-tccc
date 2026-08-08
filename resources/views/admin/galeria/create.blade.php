@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-galeria.css') }}">
@endpush

@section('content')

<section class="admin-galeria">

    <div class="admin-galeria__container">

        <div class="admin-galeria__cabecalho">

            <div>
                <span>- Galeria</span>

                <h1>Adicionar nova foto</h1>

                <p>
                    Adicione uma nova imagem para aparecer
                    na galeria do site.
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
                action="{{ route('admin.galeria.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="campo">

                    <label for="titulo">
                        Título da foto
                    </label>

                    <input
                        type="text"
                        name="titulo"
                        id="titulo"
                        value="{{ old('titulo') }}"
                        placeholder="Ex: Aniversário do Théo — 7 anos"
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
                        Imagem
                    </label>

                    <label
                        for="imagem"
                        class="upload-box"
                        id="uploadBox"
                    >

                        <div id="textoUpload">

                            <div class="upload-box__icone">
                                +
                            </div>

                            <strong>
                                Clique para selecionar uma foto
                            </strong>

                            <span>
                                JPG, PNG ou WEBP
                            </span>

                        </div>


                        <img
                            id="preview"
                            class="preview-imagem"
                            alt="Prévia da imagem"
                        >

                    </label>


                    <input
                        type="file"
                        name="imagem"
                        id="imagem"
                        accept="image/*"
                        hidden
                        required
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
                        Adicionar à galeria
                    </button>

                </div>

            </form>

        </div>

    </div>

</section>


<script>
    const inputImagem = document.getElementById('imagem');
    const preview = document.getElementById('preview');
    const textoUpload = document.getElementById('textoUpload');
    const uploadBox = document.getElementById('uploadBox');

    inputImagem.addEventListener('change', function () {

        const arquivo = this.files[0];

        if (arquivo) {

            preview.src = URL.createObjectURL(arquivo);

            preview.style.display = 'block';

            textoUpload.style.display = 'none';

            uploadBox.classList.add('tem-imagem');
        }

    });
</script>

@endsection