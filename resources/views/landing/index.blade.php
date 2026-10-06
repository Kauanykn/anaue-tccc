@extends('layouts.app')

@section('content')
    <div class="home-page">
    @include('components.hero')
    @include('components.espaco')
    @include('components.pacotes-preview')
    @include('components.cta-orcamento')
    </div>
    <script src="{{ asset('jss/home.js') }}" defer></script>
@endsection
