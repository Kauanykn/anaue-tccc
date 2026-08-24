const fotos = document.querySelectorAll('.foto-polaroid');

fotos.forEach(foto => {
    foto.addEventListener('click', () => {
        foto.classList.toggle('zoom');
    });
});