@extends('layouts.app')

@section('content')
    @include('components.hero')
    @include('components.espaco')
    @include('components.pacotes-preview')
    @include('components.cta-orcamento')
    {{-- Futuramente: @include('components.pacotes') --}}
@endsection
