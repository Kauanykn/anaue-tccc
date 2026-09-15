@extends('layouts.app')

@section('content')


<link rel="stylesheet" href="{{ asset('css/depoimentos.css') }}">

<section class="depoimentos">

    {{-- CABEÇALHO --}}
    <div class="depoimentos-topo">

        <div>
            <span class="depoimentos-label">— DEPOIMENTOS</span>

            <h1>O que os pais dizem depois da festa</h1>

            <p>
                Avaliações reais de quem já contratou — porque a melhor propaganda
                é a festa que deu certo.
            </p>
        </div>
    </div>


    {{-- RESUMO DAS AVALIAÇÕES --}}
    <div class="avaliacoes-resumo">

        <div class="media-avaliacoes">

            <strong>{{ number_format($mediaAvaliacoes, 1, ',', '') }}</strong>

            <div class="estrelas">
                ★★★★★
            </div>

            <small>
                baseado em {{ $totalAvaliacoes }} avaliações
            </small>

        </div>


        <div class="distribuicao-notas">

            @for($nota = 5; $nota >= 1; $nota--)

                @php
                    $quantidade = $quantidadeNotas[$nota];
                    $porcentagem = $totalAvaliacoes > 0
                        ? ($quantidade / $totalAvaliacoes) * 100
                        : 0;
                @endphp

                <div class="linha-nota">

                    <span>{{ $nota }} ★</span>

                    <div class="barra-nota">
                        <div
                            class="barra-preenchida"
                            style="width: {{ $porcentagem }}%"
                        ></div>
                    </div>

                    <small>{{ round($porcentagem) }}%</small>

                </div>

            @endfor

        </div>

    </div>


    {{-- DEPOIMENTOS --}}
    <div class="depoimentos-grid">

        @foreach($depoimentos as $depoimento)

            <article class="card-depoimento">

                <div class="depoimento-usuario">

                    @if($depoimento->usuario->avatar)

                        <img
                            src="{{ asset('storage/' . $depoimento->usuario->avatar) }}"
                            alt="Foto de {{ $depoimento->usuario->name }}"
                            class="depoimento-avatar"
                        >

                    @else

                        <div class="depoimento-avatar-letra">
                            {{ strtoupper(substr($depoimento->usuario->name, 0, 1)) }}
                        </div>

                    @endif

                    <div>
                        <h2>{{ $depoimento->usuario->name }}</h2>

                        <small>
                            cliente Anauê
                        </small>
                    </div>

                </div>


                <div class="nota-depoimento">

                    @for($i = 1; $i <= 5; $i++)

                        @if($i <= $depoimento->nota)
                            ★
                        @else
                            ☆
                        @endif

                    @endfor

                </div>


                <p class="comentario-depoimento">
                    {{ $depoimento->comentario }}
                </p>


                <small class="data-depoimento">
                    {{ $depoimento->created_at->format('d \d\e F \d\e Y') }}
                </small>


                @if(Auth::check() && $depoimento->usuario_id === Auth::id())

    <div class="acoes-depoimento">

        <button
            type="button"
            class="btn-editar-depoimento"
            data-editar-depoimento
            data-id="{{ $depoimento->id }}"
            data-nota="{{ $depoimento->nota }}"
            data-comentario="{{ $depoimento->comentario }}">
            Editar avaliação
        </button>

        <form
            action="{{ route('depoimento.destroy', $depoimento) }}"
            method="POST"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn-excluir-depoimento"
                onclick="return confirm('Tem certeza que deseja excluir sua avaliação?')"
            >
                Excluir avaliação
            </button>
        </form>

    </div>

@endif

            </article>

        @endforeach

    </div>


    @if(Auth::check())

    @if(!$meuDepoimento)

        <button
            type="button"
            class="btn-avaliar"
            id="abrir-modal-avaliacao"
        >
            Avaliar minha festa
        </button>

    @endif

@else

    <a
    href="{{ route('login', ['redirect' => url()->current()]) }}"
    class="btn-avaliar"
>
    Entrar para avaliar
</a>

@endif

</section>


<div class="modal-avaliacao" id="modal-avaliacao">

    <div class="modal-conteudo">

        <button
            type="button"
            class="modal-fechar"
            id="fechar-modal-avaliacao"
        >
            ×
        </button>

        <h2 id="titulo-modal">
            Avalie sua experiência
        </h2>

        <p>
            Conte pra gente como foi sua experiência no Anauê.
        </p>


            <form
                id="form-avaliacao"
                action="{{ route('depoimentos.store') }}"
                method="POST"
            >
                @csrf

                <input
                    type="hidden"
                    name="_method"
                    id="metodo-avaliacao"
                    value=""
                >

            @csrf

            <div class="campo-nota">

                <label>
                    Sua avaliação
                </label>

                <div class="estrelas-input">

                    @for($i = 1; $i <= 5; $i++)

                        <button
                            type="button"
                            class="estrela-avaliacao"
                            data-nota="{{ $i }}"
                        >
                            ☆
                        </button>

                    @endfor

                </div>

                <input
                    type="hidden"
                    name="nota"
                    id="nota"
                    required
                >

            </div>


            <div class="campo-comentario">

                <label for="comentario">
                    Seu comentário
                </label>

                <textarea
                    name="comentario"
                    id="comentario"
                    placeholder="Conte como foi sua experiência..."
                    required
                ></textarea>

            </div>


            <button
                type="submit"
                class="btn-enviar-avaliacao"
                id="btn-enviar-avaliacao"
            >
                Enviar avaliação
            </button>

        </form>

    </div>

</div>
<script>
    const modal = document.getElementById('modal-avaliacao');
    const abrirModal = document.getElementById('abrir-modal-avaliacao');
    const fecharModal = document.getElementById('fechar-modal-avaliacao');

    const estrelas = document.querySelectorAll('.estrela-avaliacao');
    const campoNota = document.getElementById('nota');

    const formulario = document.getElementById('form-avaliacao');
    const metodo = document.getElementById('metodo-avaliacao');

    const tituloModal = document.getElementById('titulo-modal');
    const botaoEnviar = document.getElementById('btn-enviar-avaliacao');

    const campoComentario = document.getElementById('comentario');


    // =========================
    // ABRIR NOVA AVALIAÇÃO
    // =========================

    if (abrirModal) {

        abrirModal.addEventListener('click', function () {

            formulario.action = "{{ route('depoimentos.store') }}";

            metodo.value = '';

            campoNota.value = '';
            campoComentario.value = '';

            tituloModal.textContent = 'Avalie sua experiência';
            botaoEnviar.textContent = 'Enviar avaliação';

            limparEstrelas();

            modal.classList.add('aberto');

        });

    }


    // =========================
    // EDITAR AVALIAÇÃO
    // =========================

    const botoesEditar = document.querySelectorAll(
        '[data-editar-depoimento]'
    );

    botoesEditar.forEach(function (botao) {

        botao.addEventListener('click', function () {

            const id = this.dataset.id;
            const nota = Number(this.dataset.nota);
            const comentario = this.dataset.comentario;


            formulario.action = `/depoimentos/${id}`;

            metodo.value = 'PUT';

            campoNota.value = nota;
            campoComentario.value = comentario;

            tituloModal.textContent = 'Editar avaliação';
            botaoEnviar.textContent = 'Salvar alterações';

            preencherEstrelas(nota);

            modal.classList.add('aberto');

        });

    });


    // =========================
    // FECHAR MODAL
    // =========================

    if (fecharModal) {

        fecharModal.addEventListener('click', function () {

            modal.classList.remove('aberto');

        });

    }


    // Fechar clicando fora

    if (modal) {

        modal.addEventListener('click', function (event) {

            if (event.target === modal) {

                modal.classList.remove('aberto');

            }

        });

    }


    // =========================
    // ESTRELAS
    // =========================

    estrelas.forEach(function (estrela) {

        estrela.addEventListener('click', function () {

            const notaSelecionada = Number(
                this.dataset.nota
            );

            campoNota.value = notaSelecionada;

            preencherEstrelas(notaSelecionada);

        });

    });


    function preencherEstrelas(nota) {

        estrelas.forEach(function (estrela) {

            const valor = Number(
                estrela.dataset.nota
            );

            if (valor <= nota) {

                estrela.textContent = '★';

            } else {

                estrela.textContent = '☆';

            }

        });

    }


    function limparEstrelas() {

        estrelas.forEach(function (estrela) {

            estrela.textContent = '☆';

        });

    }
</script>
@endsection