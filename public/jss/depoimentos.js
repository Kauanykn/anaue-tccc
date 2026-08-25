    const modal = document.getElementById('modal-avaliacao');
    const abrirModal = document.getElementById('abrir-modal-avaliacao');
    const fecharModal = document.getElementById('fechar-modal-avaliacao');

    const estrelas = document.querySelectorAll('.estrela');
    const campoNota = document.getElementById('nota');


    // Abrir modal
    if (abrirModal) {
        abrirModal.addEventListener('click', function () {
            modal.classList.add('aberto');
        });
    }


    // Fechar modal
    if (fecharModal) {
        fecharModal.addEventListener('click', function () {
            modal.classList.remove('aberto');
        });
    }


    // Fechar clicando fora da janela
    if (modal) {
        modal.addEventListener('click', function (event) {

            if (event.target === modal) {
                modal.classList.remove('aberto');
            }

        });
    }


    // Selecionar estrelas
    estrelas.forEach(function (estrela) {

        estrela.addEventListener('click', function () {

            const notaSelecionada = Number(this.dataset.nota);

            campoNota.value = notaSelecionada;

            estrelas.forEach(function (outraEstrela) {

                const notaEstrela = Number(outraEstrela.dataset.nota);

                if (notaEstrela <= notaSelecionada) {
                    outraEstrela.textContent = '★';
                } else {
                    outraEstrela.textContent = '☆';
                }

            });

        });

    });