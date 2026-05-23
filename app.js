document.addEventListener('DOMContentLoaded', () => {

    //temarios
    const botonesAbrir = document.querySelectorAll('.boton-abrir-modal');
    const botonesCerrar = document.querySelectorAll('.boton-cerrar-modal');
    const fondosModal = document.querySelectorAll('.fondo-modal');

    // funcion para abrir la ventana
    botonesAbrir.forEach(boton => {
        boton.addEventListener('click', () => {
            const idModal = boton.getAttribute('data-objetivo');
            const modal = document.getElementById(idModal);
            if (modal) {
                modal.classList.remove('oculto');
                document.body.style.overflow = 'hidden';
            }
        });
    });

    // funcion para cerrar la ventana
    window.cerrarTodasLasModales = function () {
        fondosModal.forEach(modal => {
            modal.classList.add('oculto');
        });
        document.body.style.overflow = 'auto';
    };

    // cerrar en la x
    botonesCerrar.forEach(boton => {
        boton.addEventListener('click', cerrarTodasLasModales);
    });

    //cerrar al hacer clic fuera del contenido de la modal
    fondosModal.forEach(modal => {
        modal.addEventListener('click', (evento) => {
            if (evento.target === modal) {
                cerrarTodasLasModales();
            }
        });
    });

    //validar el formulario de inscripción
    const formulario = document.getElementById('formulario-inscripcion');
    const mensajeError = document.getElementById('mensaje-error');

    if (formulario) {
        formulario.addEventListener('submit', function (evento) {
            const nombre = document.getElementById('nombre').value.trim();
            const correo = document.getElementById('correo').value.trim();
            const curso = document.getElementById('curso').value;

            mensajeError.classList.add('oculto');
            mensajeError.textContent = '';

            if (nombre === '' || correo === '' || curso === '') {
                evento.preventDefault();
                mensajeError.textContent = 'Por favor, completa todos los campos del formulario.';
                mensajeError.classList.remove('oculto');
                return;
            }

            const expresionCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!expresionCorreo.test(correo)) {
                evento.preventDefault();
                mensajeError.textContent = 'Por favor, ingresa un correo electrónico válido.';
                mensajeError.classList.remove('oculto');
                return;
            }
        });
    }

    //efecto dinamico para las fotos de los cursos
    const fotosDinamicas = document.querySelectorAll('.foto-dinamica');
    fotosDinamicas.forEach(foto => {
        foto.parentElement.addEventListener('mousemove', (e) => {
            const rect = foto.parentElement.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centroX = rect.width / 2;
            const centroY = rect.height / 2;

            const rotacionX = ((y - centroY) / centroY) * -10;
            const rotacionY = ((x - centroX) / centroX) * 10;

            foto.style.transform = `scale(1.05) rotateX(${rotacionX}deg) rotateY(${rotacionY}deg)`;
        });

        foto.parentElement.addEventListener('mouseleave', () => {
            foto.style.transform = `scale(1) rotateX(0deg) rotateY(0deg)`;
        });
    });
});