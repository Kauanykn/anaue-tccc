document.addEventListener('DOMContentLoaded', () => {
    const botao = document.querySelector('.nav-toggle');
    const menu = document.querySelector('.nav-menu');

    if (!botao || !menu) return;

    botao.addEventListener('click', () => {
        const aberto = menu.classList.toggle('aberto');
        const icone = botao.querySelector('i');

        botao.setAttribute('aria-expanded', String(aberto));
        botao.setAttribute('aria-label', aberto ? 'Fechar menu de navegação' : 'Abrir menu de navegação');
        icone?.classList.toggle('fa-bars', !aberto);
        icone?.classList.toggle('fa-xmark', aberto);
    });

    menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
        menu.classList.remove('aberto');
        botao.setAttribute('aria-expanded', 'false');
        botao.setAttribute('aria-label', 'Abrir menu de navegação');
        botao.querySelector('i')?.classList.replace('fa-xmark', 'fa-bars');
    }));
});
