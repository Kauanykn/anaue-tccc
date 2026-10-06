@extends('layouts.app')

@section('title', 'Sobre')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sobre.css') }}">
@endpush


@section('content')

   <section class="sobre">
    <div class="sobre-imagem">
        <img src="{{ asset('images/sobre.png') }}" alt="Quem somos">
    </div>
    <div class="sobre-content">


        
        <h2>Quem somos?</h2>
        <p>Nosso foco é a recreação e a interação das crianças, com brinquedos lúdicos que estimulam o movimento e brincadeira ativa. Todos os brinquedos são pensados para que as crianças e adultos possam brincar juntos.</p>
        <p>Além disso, contamos com um <strong>cardápio sofisticado e variado</strong>, pensado para agradar <strong>todos os gostos</strong> com uma <strong>experiência completa</strong>.</p>
        
    </div>
</section>


    {{-- =====================================================
         FAQ
    ====================================================== --}}

    <section class="faq reveal">

        <div class="faq__cabecalho">

            <span class="faq__label">
                DÚVIDAS FREQUENTES
            </span>

            <h2>
                Tem alguma dúvida?
            </h2>

            <p>
                Reunimos algumas das perguntas mais comuns para ajudar
                você a planejar sua festa com mais tranquilidade.
            </p>

        </div>


        <div class="faq__lista">

            {{-- PERGUNTA 1 --}}

            <div class="faq-item">

                <details>

                    <summary>
                        <span>
                            Como funciona o agendamento?
                        </span>

                        <span class="faq__icone">
                            +
                        </span>
                    </summary>

                    <div class="faq__resposta">

                        <p>
                            Você escolhe uma data disponível, preenche os
                            dados da festa e envia uma solicitação de orçamento.
                            Nossa equipe entrará em contato para continuar o atendimento.
                        </p>

                    </div>

                </details>

            </div>


            {{-- PERGUNTA 2 --}}

            <div class="faq-item">

                <details>

                    <summary>

                        <span>
                            O que está incluso nos pacotes?
                        </span>

                        <span class="faq__icone">
                            +
                        </span>

                    </summary>

                    <div class="faq__resposta">

                        <p>
                            Cada pacote possui uma combinação de serviços,
                            alimentação e atrações. Você pode consultar todos
                            os detalhes disponíveis na página de pacotes.
                        </p>

                    </div>

                </details>

            </div>


            {{-- PERGUNTA 3 --}}

            <div class="faq-item">

                <details>

                    <summary>

                        <span>
                            Posso contratar adicionais?
                        </span>

                        <span class="faq__icone">
                            +
                        </span>

                    </summary>

                    <div class="faq__resposta">

                        <p>
                            Sim. O buffet possui opções de adicionais que podem
                            ser contratadas de acordo com a necessidade da sua festa.
                        </p>

                    </div>

                </details>

            </div>


            {{-- PERGUNTA 4 --}}

            <div class="faq-item">

                <details>

                    <summary>

                        <span>
                            Quais formas de pagamento são aceitas?
                        </span>

                        <span class="faq__icone">
                            +
                        </span>

                    </summary>

                    <div class="faq__resposta">

                        <p>
                            As formas de pagamento disponíveis são informadas
                            durante o processo de contratação do serviço.
                        </p>

                    </div>

                </details>

            </div>


            {{-- PERGUNTA 5 --}}

            <div class="faq-item">

                <details>

                    <summary>

                        <span>
                            Como funciona o orçamento?
                        </span>

                        <span class="faq__icone">
                            +
                        </span>

                    </summary>

                    <div class="faq__resposta">

                        <p>
                            Basta acessar a página de orçamento, preencher as
                            informações da festa e enviar sua solicitação.
                            Nossa equipe analisará os dados e entrará em contato.
                        </p>

                    </div>

                </details>

            </div>


            {{-- PERGUNTA 6 --}}

            <div class="faq-item">

                <details>

                    <summary>

                        <span>
                            Posso personalizar minha festa?
                        </span>

                        <span class="faq__icone">
                            +
                        </span>

                    </summary>

                    <div class="faq__resposta">

                        <p>
                            Algumas opções de personalização podem ser
                            adicionadas de acordo com os serviços e adicionais
                            disponíveis para a festa.
                        </p>

                    </div>

                </details>

            </div>

        </div>

    </section>



    {{-- =====================================================
         CONTATO
    ====================================================== --}}

    <section class="contato reveal">

        <div class="contato__conteudo">

            <span class="contato__label">
                FALE COM A GENTE
            </span>

            <h2>
                Ainda ficou com alguma dúvida?
            </h2>

            <p>
                Nossa equipe está pronta para ajudar você a planejar
                uma festa especial.
            </p>

        </div>


        <div class="contato__botoes">

            <a
                href="#"
                class="contato__btn contato__btn--principal"
            >
                <i class="fa-brands fa-whatsapp"></i>

                Falar pelo WhatsApp
            </a>


            <a
                href="{{ route('orcamento') }}"
                class="contato__btn contato__btn--secundario"
            >
                Solicitar orçamento
            </a>

        </div>

    </section>


@endsection


@push('scripts')

    <script src="{{ asset('jss/sobre.js') }}"></script>

@endpush












