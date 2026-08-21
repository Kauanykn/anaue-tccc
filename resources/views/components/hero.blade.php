<section class="hero">
    <div class="hero__container">

        <div class="hero__principal">

            <div class="hero__texto">
                <span class="hero__categoria">
                    <span></span>
                    Buffet infantil desde 2012
                </span>

                <h1>Anauê Espaço Infantil</h1>

                <p>
                    Um universo de diversão repleto de momentos mágicos, onde cada detalhe encanta as crianças, 
                    surpreende as famílias e transforma qualquer celebração em uma experiência inesquecível.
                </p>

                <div class="hero__botoes">
                    <a href="{{ url('/orcamento') }}" class="botao botao--rosa">
                        Solicitar orçamento
                    </a>

                    <a href="{{ url('/pacotes') }}" class="botao botao--contorno">
                        Conheça os pacotes
                    </a>
                </div>
            </div>

            <div class="hero__fotos">

                <div class="foto-polaroid foto-polaroid--1">
                    <img
                        src="{{ asset('images/foto-1.jpg') }}"
                        alt="Festa infantil no Anauê"
                    >
                </div>

                <div class="foto-polaroid foto-polaroid--2">
                    <img
                        src="{{ asset('images/foto-2.jpg') }}"
                        alt="Criança brincando na piscina de bolinhas"
                    >
                </div>

                <div class="foto-polaroid foto-polaroid--3">
                    <img
                        src="{{ asset('images/foto-3.jpg') }}"
                        alt="Criança brincando no buffet"
                    >
                </div>

            </div>

        </div>

        <div class="hero__estatisticas">

            <div class="estatistica">
                <strong>12 anos</strong>
                <span>de festas</span>
            </div>

            <div class="estatistica">
                <strong>+800</strong>
                <span>eventos realizados</span>
            </div>

            <div class="estatistica">
                <strong>4.9/5</strong>
                <span>avaliação média</span>
            </div>

            <div class="estatistica">
                <strong>4</strong>
                <span>pacotes disponíveis</span>
            </div>

        </div>

    </div>
</section>
