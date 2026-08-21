@extends('layouts.app')

@section('title', 'Galeria')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/galeria.css') }}">
@endpush

@section('content')

<section class="galeria">
    <div class="galeria__container">
        
        <div class="galeria__cabecalho">
            <span class="galeria__categoria">
                <span></span>
                Galeria
            </span>
            
            <h1>Festas que já realizamos</h1>
            
            <p>
                Uma amostra dos temas e cenários que já montamos.
                Explore por tipo de festa para se inspirar.
            </p>
        </div>
        
        <div class="galeria__grid">
            
            @foreach($fotos as $foto)
            
                <div class="polaroid">
                    <img 
                        src="{{ asset('storage/' . $foto->imagem) }}" 
                        alt="{{ $foto->titulo }}"
                        class="gallery-image"
                        onclick="abrirImagem(this)"
                    >
                    
                    <p>{{ $foto->titulo }}</p>
                </div>
            
            @endforeach
            
        </div>
        
    </div>
</section>


{{-- MODAL DA IMAGEM --}}
<div id="imageModal" class="image-modal">

    {{-- Fechar --}}
    <span class="close-modal" onclick="fecharImagem()">&times;</span>

    {{-- Imagem anterior --}}
    <button class="modal-arrow modal-prev" onclick="imagemAnterior(event)">
        &#10094;
    </button>

    {{-- Imagem --}}
    <img 
        id="modalImage" 
        class="modal-image" 
        alt="Imagem ampliada"
    >

    {{-- Próxima imagem --}}
    <button class="modal-arrow modal-next" onclick="proximaImagem(event)">
        &#10095;
    </button>

</div>


<script>
    let imagens = [];
    let imagemAtual = 0;

    // Pega todas as imagens da galeria
    document.addEventListener('DOMContentLoaded', function() {
        imagens = Array.from(document.querySelectorAll('.gallery-image'));
    });


    function abrirImagem(imagem) {

        // Descobre qual imagem foi clicada
        imagemAtual = imagens.indexOf(imagem);

        atualizarImagem();

        document.getElementById('imageModal').classList.add('ativo');
    }


    function atualizarImagem() {

        const modalImage = document.getElementById('modalImage');

        const imagem = imagens[imagemAtual];

        modalImage.src = imagem.src;
        modalImage.alt = imagem.alt;
    }


    function proximaImagem(event) {

        // Impede o clique de fechar o modal
        event.stopPropagation();

        imagemAtual++;

        // Se chegar na última, volta para a primeira
        if (imagemAtual >= imagens.length) {
            imagemAtual = 0;
        }

        atualizarImagem();
    }


    function imagemAnterior(event) {

        // Impede o clique de fechar o modal
        event.stopPropagation();

        imagemAtual--;

        // Se estiver na primeira, vai para a última
        if (imagemAtual < 0) {
            imagemAtual = imagens.length - 1;
        }

        atualizarImagem();
    }


    function fecharImagem() {

        document.getElementById('imageModal').classList.remove('ativo');
    }


    // Fechar clicando no fundo
    document.getElementById('imageModal').addEventListener('click', function(event) {

        if (event.target === this) {
            fecharImagem();
        }

    });


    // Teclado
    document.addEventListener('keydown', function(event) {

        const modal = document.getElementById('imageModal');

        // Só funciona se o modal estiver aberto
        if (!modal.classList.contains('ativo')) {
            return;
        }


        // Seta direita
        if (event.key === 'ArrowRight') {
            proximaImagem(event);
        }


        // Seta esquerda
        if (event.key === 'ArrowLeft') {
            imagemAnterior(event);
        }


        // ESC
        if (event.key === 'Escape') {
            fecharImagem();
        }

    });
</script>

@endsection