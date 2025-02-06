<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos en Promoción</title>
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styless.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/categoria/mostrarPromocion.css">
</head>

<body>
    <div class="container">
        <?php if (isset($productos)): ?>
            <BR>
            </BR>
            <h1 class="titulo-principal">Productos en Promoción</h1>
            <div class="vista-productos">
                <?php while ($producto = $productos->fetch_object()): ?>
                    <div class="producto card h-100">
                        <!-- Etiqueta PROMO -->
                        <?php if ($producto->descuento_porcentaje > 0): ?>

                        <?php endif; ?>

                        <!-- Imagen del producto -->
                        <div class="imagen-producto" style="background-image: url('<?= base_url ?>uploads/images/<?= $producto->imagen ?>');"></div>

                        <div class="card-body">
                            <!-- Nombre del producto -->
                            <div class="titulo-producto">
                                <h4><?= $producto->nombre ?></h4>
                            </div>

                            <!-- Descripción del producto -->
                            <div class="descripcion-producto">
                                <p><?= $producto->descripcion ?></p>
                            </div>
                            

                            <!-- Precio y descuento -->
                            <div class="titulo-precio"> <?php if ($producto->descuento_porcentaje > 0): ?>
                                    <p> 

                                    <div class="producto-promocion">
                                        <span class="promocion-etiqueta"> <?= $producto->descuento_porcentaje ?>% dto.
                                       </span>
                                    </div>
                                    <br></br>
                                    Precio normal: S/ <span style="text-decoration: line-through; color: red;">
                                        <?= number_format($producto->precio, 2) ?>
                                    </span>

                                    </p>
                                    <p style="color: green; font-weight: bold;">
                                        S/<?= number_format($producto->precio - ($producto->precio * $producto->descuento_porcentaje / 100), 2) ?> </p> <?php else: ?> <p>Precio: $<?= number_format($producto->precio, 2) ?></p> <?php endif; ?>
                            </div>

                            <!-- Botón para redirigir a producto único -->
                            <a href="<?= base_url ?>producto/productoUnico&id=<?= $producto->id ?>" class="boton">Ver más</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <h1>No se encontraron productos en promoción...</h1>
        <?php endif; ?>
    </div>
</body>

</html>


<style>
.producto-promocion {
    display: inline-block;
    background: linear-gradient(145deg, #3faabd, #5fcfe9); /* Efecto metálico con tonos de azul */
    color: white; /* Texto blanco */
    padding: 5px 10px; /* Espaciado alrededor del texto */
    border-radius: 20px; /* Bordes redondeados en forma de cápsula */
    font-size: 14px; /* Tamaño de la fuente reducido */
    font-weight: bold; /* Texto en negrita */
    text-align: center; /* Centrar el texto */
    position: relative;
    overflow: hidden;
    animation: pulseGlow 1.5s infinite; /* Animación de pulso */
    box-shadow: 0 0 20px rgba(63, 170, 189, 0.5), /* Luz azul suave */
                0 0 40px rgba(63, 170, 189, 0.7), /* Luz azul más intensa */
                0 0 60px rgba(63, 170, 189, 1); /* Luz azul más fuerte */
}

.promocion-etiqueta {
    display: block;
    text-align: center; /* Centrar el texto */
}

/* Animación llamativa */
@keyframes pulseGlow {
    0% {
        box-shadow: 0 0 10px rgba(63, 170, 189, 0.3);
    }
    50% {
        box-shadow: 0 0 50px rgba(63, 170, 189, 1);
    }
    100% {
        box-shadow: 0 0 10px rgba(63, 170, 189, 0.3);
    }
}



</style>