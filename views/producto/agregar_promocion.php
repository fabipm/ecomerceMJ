<?php
// Asegúrate de que la variable $producto_id esté disponible
if (isset($producto_id)) {
    // Puedes cargar los detalles del producto si es necesario
    // $producto = new Producto();
    // $producto->setId($producto_id);
    // $productoDetalles = $producto->obtenerProductoActual();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Promoción</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/producto/agregar_promocion.css"> <!-- Asegúrate de agregar tu archivo CSS -->
</head>
<body>
    <div class="container">
        <h1>Agregar Nueva Promoción</h1>

        <?php if (isset($_SESSION['promocion']) && $_SESSION['promocion'] == 'completado'): ?>
            <p style="color: green;">La promoción se ha agregado correctamente.</p>
        <?php elseif (isset($_SESSION['promocion']) && $_SESSION['promocion'] == 'fallido'): ?>
            <p style="color: red;">Hubo un error al agregar la promoción. Por favor, intenta nuevamente.</p>
            <?php unset($_SESSION['promocion']); ?>
        <?php endif; ?>

        <form action="<?= base_url ?>producto/guardar_promocion" method="POST">
            <input type="hidden" name="producto_id" value="<?= $producto_id ?>">

            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" required>
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha de Fin:</label>
                <input type="date" name="fecha_fin" id="fecha_fin">
            </div>

            <div class="form-group">
                <label for="descuento_porcentaje">Descuento (%):</label>
                <input type="number" name="descuento_porcentaje" id="descuento_porcentaje" min="0" max="100" required>
            </div>

            <div class="form-group">
                <label for="tipo_promocion">Tipo de Promoción:</label>
                <select name="tipo_promocion_id">
                    <?php $tiposPromocion = Utilidades::mostrarTiposPromocion(); ?>
                    <?php if (!empty($tiposPromocion)): ?>
                        <?php foreach ($tiposPromocion as $tipo): ?>
                            <option value="<?= $tipo->id ?>">
                                <?= htmlspecialchars($tipo->nombre) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No hay tipos de promoción disponibles</option>
                    <?php endif; ?>
                </select>
            </div>


            <div class="form-group">
                <label for="activo">¿Está activa?</label>
                <input type="checkbox" name="activo" id="activo" checked>
            </div>

            <div class="form-group">
                <button type="submit">Guardar Promoción</button>
            </div>
        </form>

        <a href="<?= base_url ?>producto/ver_promocion&id=<?= $producto_id ?>">Volver al Producto</a>
    </div>

    <script src="path_to_your_js_file.js"></script> <!-- Si necesitas algún JS, como validación o interacción -->
</body>
</html>

<style>
/* Estilo para el botón de guardar promoción */
.form-group button[type="submit"] {
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 20px;
    border: none;
    background-color: #333; /* Color de fondo negro */
    color: #f7af51; /* Texto anaranjado */
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; /* Transiciones suaves */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Sombra */
}

.form-group button[type="submit"]:hover {
    background-color: #444; /* Fondo negro más claro al pasar el mouse */
    color: #d9903d; /* Texto anaranjado más oscuro al pasar el mouse */
    transform: scale(1.05); /* Aumentar el tamaño al pasar el mouse */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4); /* Sombra más grande */
}

.form-group button[type="submit"]:active {
    transform: scale(0.95); /* Reducir el tamaño al hacer clic */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Sombra más pequeña */
}
</style>