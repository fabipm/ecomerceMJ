// Seleccionar elementos
const sliderContainer = document.getElementById('sliderContainer');
const togglePanelButton = document.getElementById('togglePanel');
const toggleImage = document.getElementById('toggleImage');
const sidePanel = document.getElementById('sidePanel');
const closePanelButton = document.getElementById('closePanel'); // Botón de cerrar (X)

// Función para alternar la visibilidad del panel
togglePanelButton.addEventListener('click', () => {
    const isVisible = sliderContainer.style.right === '0px';

    if (isVisible) {
        sliderContainer.style.right = '-420px';  // Ocultar la ventana y el botón
        toggleImage.src = 'img-bot/bot.png';  // Cambiar la imagen a la de "Abrir Ventana"
    } else {
        sliderContainer.style.right = '0';  // Mostrar la ventana y el botón
        toggleImage.src = 'img-bot/bot.png';  // Cambiar la imagen a la de "Cerrar Ventana"
    }
});

// Función para cerrar el panel al hacer clic en la "X"
closePanelButton.addEventListener('click', () => {
    sliderContainer.style.right = '-420px';  // Ocultar el panel
    toggleImage.src = 'img-bot/bot.png';  // Cambiar la imagen a la de "Abrir Ventana"
});
