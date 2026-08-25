    const inputAvatar = document.getElementById('avatar');
    const btnAlterarFoto = document.getElementById('btn-alterar-foto');

    inputAvatar.addEventListener('change', function () {
        if (inputAvatar.files.length > 0) {
            btnAlterarFoto.style.display = 'inline-flex';
        } else {
            btnAlterarFoto.style.display = 'none';
        }
    });
