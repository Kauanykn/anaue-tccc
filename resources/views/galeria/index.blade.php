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

        <article class="polaroid">

            <img
                src="{{ asset('storage/' . $foto->imagem) }}"
                alt="{{ $foto->titulo }}"
            >

            <p>
                {{ $foto->titulo }}
            </p>

        </article>

    @endforeach

</div>

    </div>
</section>

@endsection
