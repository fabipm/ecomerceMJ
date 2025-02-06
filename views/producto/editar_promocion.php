<link rel="stylesheet" href="<?=base_url?>assets/css/producto/editar_promocion.css">
<div class="container">
    <h1>Editar Promoción</h1> <!-- Título copiado de agregar_promocion.php -->
    <form action="<?= base_url ?>producto/actualizar_promocion" method="POST">
        <input type="hidden" name="id" value="<?= $promocion->id ?>">
        
        <div>
            <label for="fecha_inicio">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" value="<?= $promocion->fecha_inicio ?>" required>
        </div>

        <div>
            <label for="fecha_fin">Fecha Fin</label>
            <input type="date" name="fecha_fin" value="<?= $promocion->fecha_fin ?>">
        </div>

        <div>
            <label for="descuento_porcentaje">Descuento (%)</label>
            <input type="number" step="0.01" name="descuento_porcentaje" value="<?= $promocion->descuento_porcentaje ?>" required>
        </div>

        <div>
            <label for="tipo_promocion_id">Tipo Promoción</label>
            <select name="tipo_promocion_id" required>
                <?php $tiposPromocion = Utilidades::mostrarTiposPromocion(); ?>
                <?php if (!empty($tiposPromocion)): ?>
                    <?php foreach ($tiposPromocion as $tipo): ?>
                        <option value="<?= $tipo->id ?>" <?= $promocion->tipo_promocion_id == $tipo->id ? 'selected' : '' ?>>
                            <?= htmlspecialchars($tipo->nombre) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">No hay tipos de promoción disponibles</option>
                <?php endif; ?>
            </select>
        </div>

        <div>
            <label for="activo">Activo</label>
            <input type="checkbox" name="activo" value="1" <?= $promocion->activo ? 'checked' : '' ?>>
        </div>
        <div class="form-group">
            <button type="submit">Guardar Cambios</button>
        </div>
    </form>    
</div>
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