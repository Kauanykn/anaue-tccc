document.addEventListener('DOMContentLoaded', () => {
    const senha = document.getElementById('senhaCadastro');
    const botaoSenha = document.getElementById('mostrarSenhaCadastro');

    if (!senha || !botaoSenha) {
        return;
    }

    const iconeSenha = botaoSenha.querySelector('i');

    botaoSenha.addEventListener('click', () => {
        const senhaVisivel = senha.type === 'password';

        senha.type = senhaVisivel ? 'text' : 'password';
        botaoSenha.setAttribute(
            'aria-label',
            senhaVisivel ? 'Ocultar senha' : 'Mostrar senha',
        );
        botaoSenha.setAttribute('aria-pressed', String(senhaVisivel));

        if (iconeSenha) {
            iconeSenha.classList.toggle('fa-eye', !senhaVisivel);
            iconeSenha.classList.toggle('fa-eye-slash', senhaVisivel);
        }
    });
});
