const botaoTema = document.getElementById('botao-tema');

    function atualizarIconeTema() {
        const icone = botaoTema.querySelector('i');

        if (document.body.classList.contains('tema-escuro')) {
            icone.className = 'fa-solid fa-sun';
        } else {
            icone.className = 'fa-solid fa-moon';
        }
    }

    // Carrega o tema salvo
    const temaSalvo = localStorage.getItem('tema');

    if (temaSalvo === 'escuro') {
        document.body.classList.add('tema-escuro');
    }

    atualizarIconeTema();

    // Alterna o tema
    botaoTema.addEventListener('click', function () {
        document.body.classList.toggle('tema-escuro');

        if (document.body.classList.contains('tema-escuro')) {
            localStorage.setItem('tema', 'escuro');
        } else {
            localStorage.setItem('tema', 'claro');
        }

        atualizarIconeTema();
    });