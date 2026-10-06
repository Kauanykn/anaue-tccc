@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet"
    >
@endpush

<section class="espaco">
    <div class="espaco__container">

        <figure class="espaco__img espaco__img--principal">
            <img
                src="{{ asset('images/espaco/espaco-principal.jpg') }}"
                alt="Ambiente interno do Anauê Espaço Infantil durante uma festa"
            >
        </figure>

        <header class="espaco__titulo">
            <p class="espaco__eyebrow">— Um cenário para a imaginação ganhar vida.</p>

            <h2>
                <span>Brincar,</span>
                <span>Imaginar</span>
                <span class="espaco__destaque">e celebrar.</span>
            </h2>

            <p class="espaco__texto">
                Um espaço cheio de cores e encanto, onde as crianças podem explorar
                a criatividade e viver momentos inesquecíveis, enquanto os adultos
                encontram um ambiente confortável para relaxar e aproveitar. Aqui,
                alegria e cuidado estão presentes em todos os momentos.
            </p>
        </header>

        <figure class="espaco__img espaco__img--piscina">
            <img
                src="{{ asset('images/foto-2.jpg') }}"
                alt="Criança brincando durante uma festa no Anauê"
            >
        </figure>

        <figure class="espaco__img espaco__img--trator">
            <img
                src="{{ asset('images/foto-3.jpg') }}"
                alt="Crianças aproveitando o espaço de festas do Anauê"
            >
        </figure>

    </div>
</section>
