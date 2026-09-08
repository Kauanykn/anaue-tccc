<section class="espaco">
    <div class="espaco__container">

        <div class="espaco__imagem">
            <div class="espaco__moldura espaco__foto-principal">
                <img
                    src="{{ asset('images/espaco/espaco-principal.jpg') }}"
                    alt="Espaço interno do buffet Anauê"
                >
            </div>

            <div class="espaco__foto-menor espaco__foto-menor--topo">
                <img
                    src="{{ asset('images/foto-1.jpg') }}"
                    alt="Decoração de festa no Anauê"
                >
            </div>

            <div class="espaco__foto-menor espaco__foto-menor--baixo">
                <img
                    src="{{ asset('images/galeria/festa1.jpg') }}"
                    alt="Festa realizada no Anauê"
                >
            </div>
        </div>

        <div class="espaco__conteudo">
            <span class="espaco__detalhe">✦</span>

            <h2>Conheça nosso espaço</h2>

            <h3>
                Onde cada comemoração vira uma memória especial.
            </h3>

            <p>
                Um espaço completo, acolhedor e preparado para deixar as crianças se divertirem enquanto os adultos aproveitam cada momento.
            </p>

            <a href="{{ route('galeria') }}" class="espaco__botao-galeria">
                Ver galeria completa
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

    </div>
</section>
