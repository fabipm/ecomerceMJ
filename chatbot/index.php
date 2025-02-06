<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventana Deslizante con Chatbot</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div id="sliderContainer" class="slider-container">
        <!-- Botón con imagen -->
        <button id="togglePanel" class="toggle-button">
            <img id="toggleImage" src="<?=base_url?>chatbot/img-bot/bot.png" alt="Abrir Ventana" />
        </button>

        <div id="sidePanel" class="side-panel">
            <div class="panel-content">
                <span id="closePanel" class="close-btn">&times;</span>

                <!-- Chat interactivo -->
                <div class="chat-container">
                  <div class="robor-h1" >
                    <img id="toggleImage" src="<?=base_url?>chatbot/img-bot/cabeza.webp"  width="60" height="auto" />
                    <h2>Mijito-Bot </h2>
                  </div>  
                  <div class="messages" id="chat-box">
                    <!-- Mensajes aparecerán aquí -->
                    <div id="faq-container" class="faq-container">
                        <h3>Hola, ¿en qué puedo </h3>
                        <h3>ayudarte? <br><strong>Preguntas frecuentes:</strong> </h3>
                        <ul>
                            <li><strong class="faq-question" data-answer="El horario de atención es de lunes a viernes, de 9:00 AM a 6:00 PM.">¿Cuál es el horario de atención?</strong></li>
                            <li><strong class="faq-question" data-answer="Puedes contactar con soporte enviando un mensaje en este chat o llamando al 123-456-7890.">¿Cómo puedo contactar con soporte?</strong></li>
                            <li><strong class="faq-question" data-answer="Nuestro chatbot está disponible 24/7 para ayudarte con tus dudas.">¿Está el chatbot disponible las 24 horas?</strong></li>
                            <!-- Agrega más preguntas aquí -->
                        </ul>
                    </div>
                </div>


                    <div class="input-area">
                        <button class="clear-button" onclick="clearChat()"><i class="fas fa-trash-alt"></i></button>
                        <input type="text" id="user-input" placeholder="Escribe tu mensaje..." />
                        <button class="send-button" onclick="sendMessage()">Enviar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
    const faqHTML = `
        <div id="faq-container" class="faq-container">
            <h3>Hola, ¿en qué puedo </h3>
            <h3>ayudarte? <br><strong>Preguntas frecuentes:</strong> </h3>
            <ul>
                <li><strong class="faq-question" data-answer="El horario de atención es de lunes a viernes, de 9:00 AM a 6:00 PM.">¿Cuál es el horario de atención?</strong></li>
                <li><strong class="faq-question" data-answer="Puedes contactar con soporte enviando un mensaje en este chat o llamando al 123-456-7890.">¿Cómo puedo contactar con soporte?</strong></li>
                <li><strong class="faq-question" data-answer="Nuestro chatbot está disponible 24/7 para ayudarte con tus dudas.">¿Está el chatbot disponible las 24 horas?</strong></li>
                <!-- Agrega más preguntas aquí -->
            </ul>
        </div>
    `;

    function clearChat() {
        const chatBox = document.getElementById('chat-box');
        chatBox.innerHTML = ''; // Borra todo el contenido dentro del chat
        chatBox.innerHTML += faqHTML; // Insertar las preguntas frecuentes
        addFAQClickEvents(); // Volver a agregar los eventos de clic
    }

    function showFAQs() {
        // Mensaje del chatbot con las preguntas frecuentes
        appendMessage("Hola, ¿en qué puedo ayudarte? Aquí tienes algunas preguntas frecuentes:", 'bot-message');
        appendMessage("1. ¿Cuál es el horario de atención?", 'bot-message');
        appendMessage("2. ¿Cómo puedo contactar con soporte?", 'bot-message');
        appendMessage("3. ¿Está el chatbot disponible las 24 horas?", 'bot-message');
        // Puedes agregar más preguntas de esta forma
    }

    function addFAQClickEvents() {
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        // Añadir evento de clic a cada pregunta
        faqQuestions.forEach(function (question) {
            question.addEventListener('click', function () {
                const answer = question.getAttribute('data-answer'); // Obtener la respuesta asociada a la pregunta
                appendMessage(answer, 'bot-message'); // Mostrar la respuesta en el chat
            });
        });
    }

    // Agregar funcionalidad de clic en preguntas al cargar la página
    document.addEventListener('DOMContentLoaded', function () {
        addFAQClickEvents();
    });

    // Seleccionar elementos
    const sliderContainer = document.getElementById('sliderContainer');
    const togglePanelButton = document.getElementById('togglePanel');
    const toggleImage = document.getElementById('toggleImage');
    const sidePanel = document.getElementById('sidePanel');
    const closePanelButton = document.getElementById('closePanel'); // Botón de cerrar (X)

    // Función para alternar la visibilidad del panel
    togglePanelButton.addEventListener('click', () => {
        const isVisible = sliderContainer.style.right === '20px';

        if (isVisible) {
            sliderContainer.style.right = '-420px';  // Ocultar la ventana y el botón
            toggleImage.src = '<?=base_url?>chatbot/img-bot/bot.png';  // Cambiar la imagen a la de "Abrir Ventana"
        } else {
            sliderContainer.style.right = '20px';  // Mostrar la ventana y el botón
            toggleImage.src = '<?=base_url?>chatbot/img-bot/bot.png';  // Cambiar la imagen a la de "Cerrar Ventana"
        }
    });

    // Función para cerrar el panel al hacer clic en la "X"
    closePanelButton.addEventListener('click', () => {
        sliderContainer.style.right = '-420px';  // Ocultar el panel
        toggleImage.src = '<?=base_url?>chatbot/img-bot/bot.png';  // Cambiar la imagen a la de "Abrir Ventana"
    });

    </script>

    <script>
      let conversationId = null; // Guardará el ID de la conversación actual

      // Función para mostrar los mensajes en el chat
      function appendMessage(message, type) {
        const chatBox = document.getElementById('chat-box');
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', type);
        messageDiv.innerHTML = formatBoldText(message);  // Procesar el texto antes de insertarlo
        chatBox.appendChild(messageDiv);
        chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll al último mensaje
      }

      // Función para enviar el mensaje
      async function sendMessage() {
        const userInput = document.getElementById('user-input').value;
        if (!userInput.trim()) return;  // Si el input está vacío, no se hace nada

        // Instrucción adicional que deseas incluir en el mensaje
        const specialInstruction = "Quiero que la respuesta a esta pregunta sea corta pero concisa con afan de dar una recomendacion,hago la aclaracion que el campo de precio en la base datos ya esta en soles.";

        // Concatenar la instrucción con el mensaje del usuario
        const fullMessage = `${userInput} ${specialInstruction}`;
        const MessageUser = `${userInput}`;
        // Mostrar mensaje del usuario (con la instrucción incluida)
        appendMessage(MessageUser,'user-message');

        // Limpiar campo de entrada
        document.getElementById('user-input').value = '';

        // Mostrar los puntos de "escribiendo..."
        const typingIndicator = document.createElement('div');
        typingIndicator.classList.add('message', 'bot-message', 'typing-indicator');
        typingIndicator.innerHTML = "<span>  . </span><span> . </span><span> . </span>";
        document.getElementById('chat-box').appendChild(typingIndicator);
        document.getElementById('chat-box').scrollTop = document.getElementById('chat-box').scrollHeight;

        // Llamada a la API con el mensaje concatenado
        const response = await fetch('https://api.vectorshift.ai/api/chatbots/run', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Api-Key': 'sk_xJBzyjfQ1YjiTp7a0XuhwxAcfCDtHT4f0kzatVusuJ6h5spi', // Aquí debes colocar tu clave sk_xJBzyjfQ1YjiTp7a0XuhwxAcfCDtHT4f0kzatVusuJ6h5spi
          },
          body: JSON.stringify({
            input: fullMessage,            // Mensaje completo con la instrucción incluida
            chatbot_name: 'chatac',       // Nombre del chatbot
            username: 'erickac',            // Nombre de usuario o identificador
            conversation_id: conversationId, // ID de la conversación si ya existe
          }),
        });

        const data = await response.json(); // Parsear la respuesta de la API

        // Eliminar los puntos de "escribiendo..."
        typingIndicator.remove();

        if (data && data.output) {
          // Mostrar la respuesta del bot en el chat
          appendMessage(data.output, 'bot-message');

          // Actualizar el ID de la conversación si es necesario
          if (data.conversation_id) {
            conversationId = data.conversation_id;
          }
        } else {
          appendMessage('Error al obtener respuesta del chatbot.', 'bot-message');
        }
      }

      // Función para convertir **texto** en negrita
      function formatBoldText(text) {
        // Usar una expresión regular para encontrar texto entre ** y convertirlo a <strong>
        return text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
      }
    </script>

</body>
</html>