<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Destacados</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url ?>assets/css/nms.css">

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Sección Principal -->
    <section class="hero">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <!-- Slide 1: Xiaomi -->
                <div class="carousel-item active">
                    <video class="d-block w-100" autoplay muted loop>
                        <source src="<?= base_url ?>assets/videos/xiomi.mp4" type="video/mp4">
                    </video>
                    <div class="carousel-caption d-flex flex-column align-items-start">
                        <h3>Xiaomi: Innovación al alcance</h3>
                        <p>Descubre lo último en tecnología.</p>
                        <a href="<?= base_url ?>categoria/mostrar&id=1" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
                <!-- Slide 2: Samsung -->
                <div class="carousel-item">
                    <video class="d-block w-100" autoplay muted loop>
                        <source src="<?= base_url ?>assets/videos/samsumg.mp4" type="video/mp4">
                    </video>
                    <div class="carousel-caption d-flex flex-column align-items-start">
                        <h3>Samsung: Tecnología de vanguardia</h3>
                        <p>Explora nuestras ofertas exclusivas.</p>
                        <a href="<?= base_url ?>categoria/mostrar&id=2" class="btn btn-primary">Comprar ahora</a>
                    </div>
                </div>
                <!-- Slide 3: Honor -->
                <div class="carousel-item">
                    <video class="d-block w-100" autoplay muted loop>
                        <source src="<?= base_url ?>assets/videos/honor.mp4" type="video/mp4">
                    </video>
                    <div class="carousel-caption d-flex flex-column align-items-start">
                        <h3>Honor: Potencia y estilo</h3>
                        <p>La tecnología que mereces.</p>
                        <a href="<?= base_url ?>categoria/mostrar&id=3" class="btn btn-primary">Descubre más</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </section>

    <!-- Área de Productos -->
    <section class="productos">
        <div class="titulo-productos">
            <h2>Productos</h2>
        </div>
        <div class="vista-productos-random">
            <?php while ($producto = $productos->fetch_object()): ?>
                <div class="producto">
                    <div class="imagen-producto" style="background-image: url('<?= base_url ?>uploads/images/<?= $producto->imagen ?>');"></div>
                    <div class="titulo-producto">
                        <h4><?= $producto->nombre ?></h4>
                        <p>s/ <?= $producto->precio ?></p>
                    </div>
                    <div class="descripcion-producto">
                        <p><?= $producto->descripcion ?></p>
                    </div>
                    <button class="boton boton-ver-mas">
                        <a href="<?= base_url ?>producto/productoUnico&id=<?= $producto->id ?>">Ver más</a>
                    </button>
                </div>
            <?php endwhile; ?>
        </div>
        <?php include 'chatbot/index.php'; ?>
    </section>

    <!-- Sección de Marcas -->
    <section class="brands-section">
        <div class="container">
            <h2 class="text-white mb-4">Conoce más sobre <strong> tu smartphone favorito según tu marca </strong></h2>
            <div class="row">
                <div class="col-6 col-md-3 brand-logo">
                    <img src="<?= base_url ?>assets/img/logo/poco.png" alt="Poco">
                </div>
                <div class="col-6 col-md-3 brand-logo">
                    <img src="<?= base_url ?>assets/img/logo/samsumgs.png" alt="Samsung">
                </div>
                <div class="col-6 col-md-3 brand-logo">
                    <img src="<?= base_url ?>assets/img/logo/xiomi.png" alt="Xiaomi">
                </div>
                <div class="col-6 col-md-3 brand-logo">
                    <img src="<?= base_url ?>assets/img/logo/redmi.png" alt="Redmi">
                </div>
            </div>
        </div>
    </section>

    <!-- Custom JS -->
    <script src="<?= base_url ?>assets/js/nms.js"></script>
</body>

</html>

<style>
    .brand-logo {
        background: rgba(0, 0, 0, 0) !important;
    }
</style>