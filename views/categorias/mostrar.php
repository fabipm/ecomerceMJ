<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="container">
        <?php if(isset($categoria)): ?>
            <BR>
        </BR>
            <h1><?= ucfirst($categoria->nombre); ?></h1>
            <div class="vista-productos">
                <?php while ($producto = $productos->fetch_object()): ?>
                    <div class="producto card h-100">
                        <div class="imagen-producto" style="background-image: url('<?= base_url ?>uploads/images/<?= $producto->imagen ?>');"></div>
                        <div class="card-body">
                            <div class="titulo-producto">
                                <h4><?= $producto->nombre ?></h4>
                            </div>
                            <div class="titulo-precio">
                                <p>s/ <?= $producto->precio ?></p>
                            </div>
                            <div class="descripcion-producto">
                                <p><?= $producto->descripcion ?></p>
                            </div>
                            <a href="<?= base_url ?>producto/productoUnico&id=<?= $producto->id ?>" class="boton">Ver más</a>
                        </div>
                    </div>
                <?php endwhile; ?>  
            </div>       
        <?php else: ?>
            <h1>No se encontraron categorías...</h1>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
