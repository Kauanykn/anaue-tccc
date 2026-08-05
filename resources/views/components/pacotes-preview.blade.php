<section class="pacotes-home">
    <div class="pacotes-home__container">

        <span class="pacotes-home__categoria">
            <span></span>
            O que oferecemos
        </span>

        <h2>Pacotes pensados pra cada tipo de festa</h2>

        <div class="pacotes-home__lista">

            <article class="pacote-card">
                <div class="pacote-card__imagem">
                    <img
                        src="{{ asset('images/pacotes/coquetel.jpg') }}"
                        alt="Pacote Coquetel"
                    >
                </div>

                <h3>Coquetel</h3>

                <p>
                    Até 50 convidados, cardápio completo e sofisticado
                </p>

                <strong>A partir de R$ 3.480</strong>
            </article>

            <article class="pacote-card">
                <div class="pacote-card__imagem">
                    <img
                        src="{{ asset('images/pacotes/festa-2.jpg') }}"
                        alt="Pacote Festa 2"
                    >
                </div>

                <h3>Festa 2</h3>

                <p>
                    Até 50 convidados, cardápio completo e sofisticado
                </p>

                <strong>A partir de R$ 3.480</strong>
            </article>

            <article class="pacote-card">
                <div class="pacote-card__imagem">
                    <img
                        src="{{ asset('images/pacotes/brinca-legal.jpg') }}"
                        alt="Pacote Brinca Legal"
                    >
                </div>

                <h3>Brinca legal</h3>

                <p>
                    Até 50 convidados, cardápio completo e sofisticado
                </p>

                <strong>A partir de R$ 2.890</strong>
            </article>

        </div>

        <div class="pacotes-home__rodape">
            <a href="{{ url('/pacotes') }}">
                Ver todos os pacotes
            </a>
        </div>

    </div>
</section>