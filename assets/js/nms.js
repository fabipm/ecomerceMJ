document.addEventListener('DOMContentLoaded', () => {
    const videos = document.querySelectorAll('.carousel-item video');
    const carouselItems = document.querySelectorAll('.carousel-item');
    const carousel = document.querySelector('#carouselExample'); // Asegúrate de que el id sea correcto

    // Función para reproducir un video
    function playVideo(index) {
        if (videos[index]) {
            videos[index].play();
        }
    }

    // Función para detener el video al cambiar de diapositiva
    function stopVideo(index) {
        if (videos[index]) {
            videos[index].pause();
            videos[index].currentTime = 0; // Reinicia el video
        }
    }

    // Reproducir el video en la diapositiva activa cuando la página se carga
    carouselItems.forEach((item, index) => {
        if (item.classList.contains('active')) {
            playVideo(index);  // Reproducir automáticamente el video en la diapositiva activa
        }
    });

    // Pausar todos los videos cuando se cambia de diapositiva
    carousel.addEventListener('slide.bs.carousel', () => {
        // Detener el video de la diapositiva anterior
        carouselItems.forEach((item, index) => {
            if (!item.classList.contains('active')) {
                stopVideo(index);  // Detener el video si no está en la diapositiva activa
            }
        });
    });

    // Reproducir el video en la diapositiva activa después de que la transición termine
    carousel.addEventListener('slid.bs.carousel', () => {
        const activeItem = document.querySelector('.carousel-item.active');
        const activeVideo = activeItem.querySelector('video');
        if (activeVideo) {
            activeVideo.play();  // Reproducir el video de la diapositiva activa
        }
    });

    // Si se quiere habilitar el pase automático de videos después de cierto tiempo
    let autoNextTimeout;

    function autoNextSlide() {
        autoNextTimeout = setInterval(() => {
            // Cambiar a la siguiente diapositiva automáticamente
            const nextButton = document.querySelector('.carousel-control-next');
            if (nextButton) {
                nextButton.click();
            }
        }, 5000); // Cambia cada 5 segundos, ajustable según necesidad
    }

    // Iniciar pase automático de diapositivas
    carousel.addEventListener('slid.bs.carousel', () => {
        clearInterval(autoNextTimeout); // Detener cualquier pase automático anterior
        autoNextSlide();  // Reiniciar el pase automático
    });

    // Iniciar pase automático al cargar la página
    autoNextSlide();
});


document.querySelectorAll('.carousel-item').forEach((item) => {
    item.addEventListener('shown.bs.carousel', () => {
        const video = item.querySelector('video');
        if (video && !video.src) {
            const source = video.querySelector('source');
            video.src = source.getAttribute('src');
            video.load();
            video.play();
        }
    });
});
