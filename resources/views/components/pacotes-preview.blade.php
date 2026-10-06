<section class="pacotes-home" aria-labelledby="pacotes-home-titulo">
    <div class="pacotes-home__container">
        <div class="pacotes-home__conteudo">
            <span class="pacotes-home__categoria">
                O que oferecemos <span aria-hidden="true"></span>
            </span>

            <h2 id="pacotes-home-titulo">
                Mais que<br>
                comida, uma<br>
                <span>experiência.</span>
            </h2>

            <p>
                Da primeira mordida ao último brinde, cada sabor conta uma parte da celebração.
                Conheça cardápios pensados em cada detalhe para surpreender seus convidados e
                transformar momentos especiais em memórias ainda mais saborosas.
            </p>

            <a class="pacotes-home__link" href="{{ url('/pacotes') }}">
                Conheça os pacotes
            </a>
        </div>

        <div class="pacotes-home__imagem">
            <img
                src="{{ asset('images/pacotes/coquetel.jpeg') }}"
                alt="Mesa de coquetel com petiscos variados para uma celebração"
                loading="lazy"
            >
        </div>
    </div>
</section>
