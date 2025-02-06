<?php if (isset($productoUnico)): ?>
    <br>
    </br>
    <h1 class="titulo-principal"><?= ucfirst($productoUnico->nombre); ?></h1>
    <div class="contenedor-producto-unico">
        <div class="row">
            <!-- Columna para las miniaturas (imágenes) -->
            <div class="contenedor">
                <div class="miniaturas">
                    <!-- Imagen principal -->
                    <img src="<?= base_url ?>uploads/images/<?= $productoUnico->imagen; ?>" class="img-thumbnail miniatura" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" alt="Imagen Principal">

                    <!-- Imágenes adicionales -->
                    <?php if (!empty($productoUnico->imagenes_adicionales)): ?>
                        <?php $index = 1; ?>
                        <?php foreach ($productoUnico->imagenes_adicionales as $imagen): ?>
                            <img src="<?= base_url ?>uploads/images/<?= htmlspecialchars($imagen->imagen_url); ?>" class="img-thumbnail miniatura" data-bs-target="#carouselExampleControls" data-bs-slide-to="<?= $index; ?>" alt="Imagen Adicional">
                            <?php $index++; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay imágenes adicionales para este producto.</p>
                    <?php endif; ?>
                </div>


                <!-- Columna para el carrusel (en el centro) -->
                <div class="carrusel-wrapper">
                    <div class="col-md-4">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <!-- Imagen principal -->
                                <div class="carousel-item active">
                                    <img src="<?= base_url ?>uploads/images/<?= $productoUnico->imagen; ?>" class="d-block w-100 img-carrusel" alt="Imagen Principal">
                                </div>

                                <!-- Imágenes adicionales -->
                                <?php if (!empty($productoUnico->imagenes_adicionales)): ?>
                                    <?php foreach ($productoUnico->imagenes_adicionales as $imagen): ?>
                                        <div class="carousel-item">
                                            <img src="<?= base_url ?>uploads/images/<?= htmlspecialchars($imagen->imagen_url); ?>" class="d-block w-100 img-carrusel" alt="Imagen Adicional">
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <!-- Botones de navegación -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">

                    <!-- Descripción del producto -->
                    <div class="descripcion">
                        <h3 class="subtitulo">Descripción:</h3>

                        <p><?= $productoUnico->descripcion; ?></p>
                    </div>


                    <!-- Características del producto -->
                    <div class="caracteristicas-visual row text-center">
                        <?php if (!empty($productoUnico->camara_posterior)): ?>
                            <div class="col-md-3 col-6">
                                <i class="bi bi-camera" style="font-size: 2rem;"></i>
                                <p><strong>Cámara Posterior</strong><br><?= $productoUnico->camara_posterior; ?> </p>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($productoUnico->camara_frontal)): ?>
                            <div class="col-md-3 col-6">
                                <i class="bi bi-camera-video" style="font-size: 2rem;"></i>
                                <p><strong>Cámara Frontal</strong><br><?= $productoUnico->camara_frontal; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($productoUnico->almacenamiento)): ?>
                            <div class="col-md-3 col-6">
                                <i class="bi bi-hdd" style="font-size: 2rem;"></i>
                                <p><strong>Almacenamiento</strong><br><?= $productoUnico->almacenamiento; ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Precio del producto -->
                    <div class="precio-unico">
                        <h4 class="precio-titulo">Precio:</h4>

                        <?php if ($productoUnico->descuento !== null && $productoUnico->descuento > 0): ?>
                            <!-- Calcular el precio con descuento -->
                            <?php
                            $precioConDescuento = $productoUnico->precio - ($productoUnico->precio * ($productoUnico->descuento / 100));
                            ?>

                            <!-- Precio original tachado -->
                            <p class="precio-original" style="text-decoration: line-through; color: #ccc;">s/ <?= number_format($productoUnico->precio, 2); ?></p>

                            <!-- Precio con descuento -->
                            <p class="precio-con-descuento" style="color: #f79f61; font-weight: bold;">s/ <?= number_format($precioConDescuento, 2); ?></p>

                            <!-- Mostrar detalles del descuento -->
                            <p>¡Ahorra <?= number_format($productoUnico->precio - $precioConDescuento, 2); ?> soles!</p>

                        <?php else: ?>
                            <!-- Si no hay descuento, mostrar el precio normal -->
                            <p>s/ <?= number_format($productoUnico->precio, 2); ?></p>
                        <?php endif; ?>
                    </div>


                    <!-- Botón para agregar al carrito -->
                    <div class="boton-agregar-carrito">

                        <a href="<?= base_url ?>carrito/agregar&id=<?= $productoUnico->id; ?>">Añadir al Carrito</a>

                    </div>

                </div>






            </div>
            <!-- Columna para la información del producto -->





            <br>
            </br>
            <!-- Características del producto -->
            <div class="caracteristicas-visual row text-center">
                <br>
                </br>
                <br>
                </br>
                <br>
                </br>
                <h3 class="subtitulo">Características</h3>

                <div class="detalles">

                    <?php if (!empty($productoUnico->pantalla)): ?>
                        <div class="col-md-3 col-6">
                            <i class="bi bi-phone" style="font-size: 2rem;"></i>
                            <p><strong>Pantalla</strong><br><?= $productoUnico->pantalla; ?>"</p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($productoUnico->procesador)): ?>
                        <div class="col-md-3 col-6">
                            <i class="bi bi-cpu" style="font-size: 2rem;"></i>
                            <p><strong>Procesador</strong><br><?= $productoUnico->procesador; ?> núcleos</p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($productoUnico->carga_rapida)): ?>
                        <div class="col-md-3 col-6">
                            <i class="bi bi-lightning-charge" style="font-size: 2rem;"></i>
                            <p><strong>Carga Rápida</strong><br><?= $productoUnico->carga_rapida; ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($productoUnico->bateria)): ?>
                        <div class="col-md-3 col-6">
                            <i class="bi bi-battery-full" style="font-size: 2rem;"></i>
                            <p><strong>Batería</strong><br><?= $productoUnico->bateria; ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($productoUnico->sistema_operativo)): ?>
                        <div class="col-md-3 col-6">
                            <i class="bi bi-phone" style="font-size: 2rem;"></i>
                            <p><strong>Sistema Operativo</strong><br><?= $productoUnico->sistema_operativo; ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($productoUnico->ram)): ?>
                        <div class="col-md-3 col-6">
                            <i class="bi bi-memory" style="font-size: 2rem;"></i>
                            <p><strong>RAM</strong><br><?= $productoUnico->ram; ?></p>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
            <div class="random">
                            
            </div>

        </div>



    </div>
<?php else: ?>
    <h1>No se encontró el producto...</h1>
<?php endif; ?>



<!-- CSS de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<!-- JS de Bootstrap (Incluye Popper.js automáticamente) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



<!-- Agrega un CSS personalizado -->
<style>

    /* Asegura que el contenido esté bien distribuido en una sola fila */
    .contenedor-producto-unico .row {
        display: flex;
        justify-content: flex-start;
        /* Alinea los elementos hacia la izquierda */
        gap: 15px;
        /* Espacio entre columnas */
        margin-left: -10px;
        /* Mueve el contenido hacia la izquierda */
        align-items: stretch;
    }

    /* Ajustar el tamaño de las columnas */
    .contenedor-producto-unico .col-md-4 {
        flex: 1;
        padding: 0 15px;
        /* Espaciado dentro de cada columna */
    }

    /* Estilo para las miniaturas */
    .miniaturas {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        /* Alinea las miniaturas hacia la izquierda */
        gap: 20px;
        /* Espacio entre miniaturas */
        /* Mueve las miniaturas hacia la izquierda */
        width: 30%;
    }

    .contenedor {
        display: flex;
        align-items: center;
        /* Alinea verticalmente al centro, ajusta si es necesario */
    }

    /* Ajuste del tamaño de las miniaturas */
    .miniatura {
        width: 40%;
        /* Tamaño aumentado */
        cursor: pointer;
        border: 2px solid #ddd;
        object-fit: cover;
        margin-bottom: 15px;
        /* Espaciado entre las miniaturas */
    }

    /* Efecto hover para las miniaturas */
    .miniatura:hover {
        border-color: #007bff;
    }


    /* Asegura que la descripción del producto y las características se alineen bien */
    .caracteristicas {
        margin-top: 20px;
    }


    .caracteristicas-visual {
        margin-top: 20px;
    }

    .caracteristicas-visual .col-md-3 {
        margin-bottom: 20px;
        text-align: center;
        /* Centra el contenido dentro de la columna */
        transition: transform 0.3s ease;
        /* Transición suave para la transformación */
    }

    .caracteristicas-visual i {
        color: #f7af51;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
        /* Transición suave para el agrandado del icono */
    }

    .caracteristicas-visual p {
        font-size: 1rem;
        margin: 0;
    }

    /* Agrandar el icono cuando el mouse pasa por encima */
    .caracteristicas-visual .col-md-3:hover i {
        transform: scale(1.5);
        /* Aumenta el tamaño del icono */
    }


    /* Estilo general para encabezados */
    h1,
    h3,
    h4 {
        font-family: 'Roboto', sans-serif;
        /* Fuente moderna */
        margin: 20px 0;
        text-align: center;
        /* Centrado para consistencia */
    }

    /* Encabezado principal (h1) */
    /* Estilo general para encabezados */
    h1,
    h3,
    h4 {
        font-family: 'Roboto', sans-serif;
        /* Fuente moderna y ligera */
        margin: 20px 0;

        /* Centrado para uniformidad */
    }

    /* Encabezado principal (h1) */

    .titulo-principal {
        font-size: 2.5rem;
        font-weight: 700;
        color: #000;
        letter-spacing: 0.05em;
        text-align: center;
        margin-bottom: 20px;
        line-height: 1.2;

    }

    /* Subtítulo (h3) */
    .subtitulo {
        font-size: 2rem;
        font-weight: 700;
        color: #f7af51;
        text-transform: uppercase;
        border-bottom: 3px solid #ffcea1;
        padding-bottom: 5px;
    }

    /* Título de precio (h4) */
    .precio-titulo {
        font-size: 1.8rem;
        font-weight: 600;
        color: #f79f61;
        border-left: 4px solid #f7af51;
        /* Línea decorativa */
        padding-left: 10px;
        text-transform: capitalize;
        letter-spacing: 0.02em;
        text-align: left;
        /* Alinea el texto a la izquierda */
        display: inline-block;
        /* Hace que el borde izquierdo se aplique solo al contenido */
    }


    .carrusel-wrapper {
        width: 70%;
        /* Ajusta el tamaño según necesites */
        margin-left: auto;
    }

    .carrusel-wrapper .carousel {
        transform: scale(4) translateX(30px);
        ;
        /* Escala inicial */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: transparent;
        /* Fondo transparente */
        filter: invert(49%) sepia(91%) saturate(1505%) hue-rotate(10deg) brightness(97%) contrast(98%);
        /* Este filtro ajusta el color de las flechas predeterminadas a #f7af51 */
        background-size: 100%;
        /* Asegura que el ícono se escale correctamente */
        width: 15px;
        /* Tamaño de la flecha */
        height: 15px;
    }

    .detalles {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        /* 3 columnas en el grid */
        gap: 15px;
        justify-items: center;
        margin: 0 auto;
        opacity: 0;
        /* Inicialmente el contenido está invisible */
        filter: blur(5px);
        /* Aplica un difuminado inicial */
        visibility: hidden;
        /* Hace que no ocupe espacio al principio */
        transition: opacity 1s ease, filter 1s ease, visibility 0.5s ease;
        /* Transiciones suaves */
    }

    .detalles.visible {
        opacity: 1;
        /* Hace visible el contenedor */
        filter: blur(0);
        /* Elimina el difuminado */
        visibility: visible;
        /* Hace visible el contenedor */
    }

    .detalles .col-md-3 {
        display: flex;
        flex-direction: column;
        align-items: center;
        /* Centra el contenido dentro de cada columna */
    }
</style>

<script>
    // Función para verificar si el contenedor está visible en la ventana
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return rect.top >= 0 && rect.left >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && rect.right <= (window.innerWidth || document.documentElement.clientWidth);
    }

    // Obtener el contenedor
    const detalles = document.querySelector('.detalles');

    // Comprobar si el contenedor está visible
    function checkVisibility() {
        if (isElementInViewport(detalles)) {
            detalles.classList.add('visible');
        }
    }

    // Escuchar el evento de scroll
    window.addEventListener('scroll', checkVisibility);

    // Llamar a la función cuando la página cargue por primera vez
    checkVisibility();
</script>

