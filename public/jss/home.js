const fotos = document.querySelectorAll('.foto-polaroid');

fotos.forEach(foto => {
    foto.addEventListener('click', () => {
        foto.classList.toggle('zoom');
    });
});

const home = document.querySelector('.home-page');
const prefereMovimentoReduzido = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (home && !prefereMovimentoReduzido && 'IntersectionObserver' in window) {
    const elementos = home.querySelectorAll(
        '.hero__texto, .foto-polaroid, .espaco__titulo, .espaco__img, ' +
        '.pacotes-home__conteudo, .pacotes-home__imagem, ' +
        '.cta-orcamento__texto, .cta-orcamento__imagem'
    );

    elementos.forEach((elemento, indice) => {
        elemento.setAttribute('data-reveal', '');
        elemento.style.setProperty('--reveal-delay', `${(indice % 3) * 80}ms`);
    });

    home.classList.add('home-reveal-ready');

    const observador = new IntersectionObserver((entradas, observer) => {
        entradas.forEach(entrada => {
            if (entrada.isIntersecting) {
                entrada.target.classList.add('is-visible');
                observer.unobserve(entrada.target);
            }
        });
    }, {
        threshold: 0.14,
        rootMargin: '0px 0px -35px 0px'
    });

    elementos.forEach(elemento => observador.observe(elemento));
}
