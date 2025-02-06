<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url ?>assets/css/producto/ver_imagenes.css">

<div class="container mt-5 contenedor-ver-imagenes">
    <h2 class="text-center text-f7af51 mb-4">Imágenes de <?= $productoUnico->nombre; ?></h2>

    <!-- Mostrar las imágenes existentes -->
    <?php if ($productoUnico->imagenes_adicionales && count($productoUnico->imagenes_adicionales) > 0): ?>
        <div class="row">
            <?php foreach ($productoUnico->imagenes_adicionales as $imagen): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <BR>
                    </BR>
                        <img src="<?= base_url ?>uploads/images/<?= $imagen->imagen_url; ?>" alt="Imagen del producto" class="card-img-top rounded" style="object-fit: cover; height: 200px;">
                        <div class="card-body text-center">
                            <!-- Formulario para cambiar la imagen -->
                            <form action="<?= base_url ?>producto/guardar_o_editar_imagen" method="POST" enctype="multipart/form-data" class="mb-2">
                                <input type="hidden" name="producto_id" value="<?= $productoUnico->id ?>">
                                <input type="hidden" name="imagen_id" value="<?= $imagen->id ?>">

                                <div class="form-group">
                                    <label for="imagen">Seleccionar nueva imagen:</label>
                                    <input type="file" name="imagen" class="form-control-file">
                                </div>

                                <button type="submit" class="btn btn-warning btn-block">Cambiar Imagen</button>
                            </form>

                            <!-- Formulario para eliminar la imagen -->
                            <form action="<?= base_url ?>producto/eliminar_imagen" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta imagen?');">
                                <input type="hidden" name="imagen_id" value="<?= $imagen->id ?>">
                                <input type="hidden" name="producto_id" value="<?= $productoUnico->id ?>">

                                <button type="submit" class="btn btn-danger btn-block">Eliminar Imagen</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-warning">No hay imágenes para este producto.</p>
    <?php endif; ?>

    <!-- Formulario para agregar una nueva imagen -->
    <h3 class="text-center text-f7af51 mt-5 mb-4">Agregar Nueva Imagen</h3>
    <form action="<?= base_url ?>producto/guardar_o_editar_imagen" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="producto_id" value="<?= $productoUnico->id; ?>">

        <div class="form-group">
            <label for="imagen">Seleccionar imagen:</label>
            <input type="file" name="imagen" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-success btn-block">Agregar Imagen</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<STYLE>
/* Estilo para los títulos */
.text-f7af51 {
    color: #f7af51;
}

/* Ajustes para los botones */
.btn-block {
    padding: 12px;
    font-weight: bold;
}

/* Personalización de las imágenes */
.card-img-top {
    border-radius: 8px !important;
    height: 200px !important;
    object-fit: contain !important;
    width: 100% !important;
    object-position: center center !important;
    max-height: 100% !important;
}

.card-img-top:hover {
    transform: scale(1.05);
}

/* Mensaje cuando no hay imágenes */
.text-warning {
    font-size: 18px;
    font-weight: bold;
}


    </STYLE>