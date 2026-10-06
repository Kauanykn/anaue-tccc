// =====================================================
// ANIMAÇÃO AO ROLAR A PÁGINA
// =====================================================

const elementos = document.querySelectorAll('.reveal');


const observer = new IntersectionObserver(
    (entries) => {

        entries.forEach((entry) => {

            if (entry.isIntersecting) {

                entry.target.classList.add('active');

            }

        });

    },
    {
        threshold: 0.15
    }
);


elementos.forEach((elemento) => {

    observer.observe(elemento);

});



// =====================================================
// FAQ
// Fecha uma pergunta quando outra é aberta
// =====================================================

const perguntas = document.querySelectorAll(
    '.faq-item details'
);


perguntas.forEach((pergunta) => {

    pergunta.addEventListener('toggle', () => {

        if (pergunta.open) {

            perguntas.forEach((outraPergunta) => {

                if (outraPergunta !== pergunta) {

                    outraPergunta.removeAttribute('open');

                }

            });

        }

    });

});