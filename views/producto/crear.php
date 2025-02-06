<link rel="stylesheet" href="<?=base_url?>assets/css/producto/crear.css">
<div class="contenedor-agregar-producto">
<?php if(isset($editar) && isset($productoEditar) && is_object($productoEditar)): ?>
    <h2>Editar Producto - <?= $productoEditar->nombre; ?></h2>
    <?php $accion_url = base_url."producto/guardar&id=".$productoEditar->id; ?>
<?php else : ?>
    <h2>Agregar Producto</h2>
    <?php $accion_url = base_url."producto/guardar"; ?>
<?php endif; ?>

    <form action="<?=$accion_url?>" method="POST" enctype="multipart/form-data">
        <div class="grupo-formulario">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?=isset($productoEditar) && is_object($productoEditar) ? $productoEditar->nombre : ''; ?>">
        </div>
        
        <div class="grupo-formulario">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion"><?=isset($productoEditar) && is_object($productoEditar) ? $productoEditar->descripcion : ''; ?></textarea>
        </div>
        
        <div class="grupo-formulario">
            <label for="precio">Precio:</label>
            <input type="text" name="precio" value="<?=isset($productoEditar) && is_object($productoEditar) ? $productoEditar->precio : ''; ?>">
        </div>
        
        <div class="grupo-formulario">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" value="<?=isset($productoEditar) && is_object($productoEditar) ? $productoEditar->stock : ''; ?>">
        </div>
        
        <div class="grupo-formulario">
            <label for="categoria">Categoría:</label>
            <select name="categoria">
            <?php $categorias = Utilidades::mostrarCategorias(); ?>
            <?php while($categoria = $categorias->fetch_object()): ?>
                <option value="<?=$categoria->id?>" <?=isset($productoEditar) && is_object($productoEditar) && $categoria->id == $productoEditar->categoria_id ? 'selected' : ''; ?>>
                    <?=$categoria->nombre?>
                </option>
            <?php endwhile; ?>
            </select>
        </div>

        <!-- Campo de color agregado -->
        <div class="grupo-formulario">
            <label for="color">Color:</label>
            <select name="color" required>
                <option value="Rojo" <?=isset($productoEditar) && is_object($productoEditar) && $productoEditar->color == 'Rojo' ? 'selected' : ''; ?>>Rojo</option>
                <option value="Azul" <?=isset($productoEditar) && is_object($productoEditar) && $productoEditar->color == 'Azul' ? 'selected' : ''; ?>>Azul</option>
                <option value="Verde" <?=isset($productoEditar) && is_object($productoEditar) && $productoEditar->color == 'Verde' ? 'selected' : ''; ?>>Verde</option>
                <option value="Negro" <?=isset($productoEditar) && is_object($productoEditar) && $productoEditar->color == 'Negro' ? 'selected' : ''; ?>>Negro</option>
                <option value="Blanco" <?=isset($productoEditar) && is_object($productoEditar) && $productoEditar->color == 'Blanco' ? 'selected' : ''; ?>>Blanco</option>
              
            </select>
        </div>
        
        <div class="grupo-formulario">
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen">
        </div>
        
        <input type="submit" value="Guardar Producto" class="boton boton-agregar-producto"></input>
    </form>
</div>
