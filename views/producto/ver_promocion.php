<link rel="stylesheet" href="<?=base_url?>assets/css/producto/ver_promocion.css">
<div class="contenedor-promociones">
    <h2 style="text-align: center">Promociones para el Producto</h2>

    <!-- Botón para agregar nueva promoción -->
    <div class="agregar-promocion" style="text-align: center;">
        <button class="boton agregar-producto">
            <a href="<?=base_url?>producto/crear_promociones&id=<?= $_GET['id']; ?>" style="text-decoration: none; color: white;">
                Agregar Promoción
            </a>
        </button>
    </div>

    <!-- Mostrar mensajes de retroalimentación -->
    <?php if (isset($_SESSION['promocion']) && $_SESSION['promocion'] == "completado"): ?>
        <p>¡Promoción agregada exitosamente!</p>
    <?php elseif (isset($_SESSION['promocion']) && $_SESSION['promocion'] !== "completado"): ?>
        <p style="color: red;">¡No se pudo agregar la promoción!</p>
    <?php endif; ?>
    <?php Utilidades::eliminarSesion('promocion'); ?>

    <?php if (isset($_SESSION['eliminado']) && $_SESSION['eliminado'] == "completado"): ?>
        <p>¡Promoción eliminada exitosamente!</p>
    <?php elseif (isset($_SESSION['eliminado']) && $_SESSION['eliminado'] !== "completado"): ?>
        <p style="color: red;">¡Error al eliminar la promoción!</p>
    <?php endif; ?>
    <?php Utilidades::eliminarSesion('eliminado'); ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Descuento (%)</th>
                <th>Tipo de Promoción</th>
                <th>Activo</th>
                <th>Acciones</th> <!-- Nueva columna para las acciones -->
            </tr>
        </thead>
        <tbody>
            <?php if ($promociones && $promociones->num_rows > 0): ?>
                <?php while ($promo = $promociones->fetch_object()): ?>
                    <tr>
                        <td><?= $promo->id; ?></td>
                        <td><?= $promo->fecha_inicio; ?></td>
                        <td><?= $promo->fecha_fin; ?></td>
                        <td><?= $promo->descuento_porcentaje; ?>%</td>
                        <td><?= $promo->tipo_promocion_id; ?></td> <!-- Puedes reemplazar con el nombre de tipo si es necesario -->
                        <td><?= $promo->activo ? 'Sí' : 'No'; ?></td>
                        <td>
                            <!-- Botón para editar la promoción --> 
                            <a href="<?=base_url?>producto/editar_promocion&id=<?= $promo->id; ?>"><i class="icono-editar fas fa-edit"></i></a>

                            <!-- Botón para eliminar la promoción -->
                            <a href="<?=base_url?>producto/eliminar_promocion&id=<?= $promo->id; ?>"><i class="icono-borrar fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No hay promociones activas para este producto.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
