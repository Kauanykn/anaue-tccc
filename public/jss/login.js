
    const senha = document.getElementById('senha');
    const botaoSenha = document.getElementById('mostrarSenha');
    const iconeSenha = botaoSenha.querySelector('i');

    botaoSenha.addEventListener('click', function () {

        if (senha.type === 'password') {
            senha.type = 'text';

            iconeSenha.classList.remove('fa-eye');
            iconeSenha.classList.add('fa-eye-slash');

        } else {
            senha.type = 'password';

            iconeSenha.classList.remove('fa-eye-slash');
            iconeSenha.classList.add('fa-eye');
        }

    });
