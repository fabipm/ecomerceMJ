<?php
require_once 'config/db.php'; // Incluir la clase Database

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    // Conectar a la base de datos
    $db = Database::conexion();
    // Realizar la búsqueda en la base de datos
    $sql = "SELECT * FROM producto WHERE nombre LIKE '%$query%' LIMIT 1";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $producto = $result->fetch_object();
        // Redirigir al producto encontrado
        header("Location: " . base_url . "producto/productoUnico&id=" . $producto->id);
        exit();
    } else {
        // Redirigir a una página de resultados de búsqueda o mostrar un mensaje de error
        header("Location: " . base_url . "producto/noEncontrado");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" defer></script>
    <script type="text/javascript" src="<?= base_url ?>cliente/js/index.js" defer></script>
    <title>Mijo Store</title>
    <link rel="icon" href="<?= base_url ?>assets/img/icon.png" type="image/png">
    <link rel="stylesheet" href="<?= base_url ?>chatbot/styles.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/header/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="contenedor-pagina">
        <header class="encabezado">
            <div class="encabezado-principal container">
                <!-- Logo -->
                <div class="logo-container">
                    <a href="<?= base_url ?>">
                        <img src="<?= base_url ?>assets/img/logo1.png" alt="Logo de la Empresa" width="250" height="60" />
                    </a>
                </div>

                <!-- Menú de Categorías -->
                <nav class="categorias-container">
                    <div class="items-menu">
                        <p><a href="<?= base_url ?>categoria/mostrarproductosxpromocion">Promociones</a></p>
                        <?php 
                        $categorias = Utilidades::mostrarCategorias(); 
                        while($categoria = $categorias->fetch_object()): ?>
                            <p><a href="<?= base_url ?>categoria/mostrar&id=<?= $categoria->id; ?>"><?= $categoria->nombre ?></a></p>
                        <?php endwhile; ?>
                    </div>
                </nav>

                <!-- Menú de Usuario y Carrito -->
                <div class="menu-usuario d-flex justify-content-end align-items-center">
                    <!-- Perfil de Usuario -->
                    <div class="perfil-usuario position-relative" id="perfil-usuario">
                        <?php if (isset($_SESSION['identity'])): ?>
                            <i class="usuario far fa-user"></i>
                            <div class="menu-hover-perfil">
                                <ul>
                                    <?php if (isset($_SESSION['admin'])): ?>
                                        <li><a href="<?= base_url ?>categoria/index">Gestionar Categorías</a></li>
                                        <li><a href="<?= base_url ?>producto/gestionar">Gestionar Productos</a></li>
                                        <li><a href="<?= base_url ?>pedido/gestionar">Gestionar Pedidos</a></li>
                                        <li><a href="<?= base_url ?>reportes/index.php">Ver Reportes</a></li>
                                    <?php endif; ?>
                                    <li><a href="<?= base_url ?>usuario/perfil">Mi perfil</a></li>
                                    <li><a href="<?= base_url ?>pedido/misPedidos">Mis pedidos</a></li>
                                    <li><a href="<?= base_url ?>usuario/cerrarSesion">Cerrar sesión</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <i class="usuario far fa-user oculto"></i>
                        <?php endif; ?>
                    </div>

                    <!-- Login/Saludo -->
                    <div class="login">
                        <?php if (isset($_SESSION['identity'])): ?>
                            <p>Bienvenido, <?= $_SESSION['identity']->nombre ?>!</p>
                        <?php else: ?>
                            <p>Login</p>
                        <?php endif; ?>
                    </div>

                    <!-- Búsqueda-->
                    <div class="buscar">
                        <i class="fas fa-search" id="search-icon"></i>
                        <form id="search-form" action="<?= base_url ?>" method="GET" style="display: none;">
                            <input type="text" name="query" id="search-input" placeholder="Buscar...">
                        </form>
                    </div>
                    <!--Carrito -->

                    <div class="carrito">
                        <a href="<?= base_url ?>carrito/index"><i class="fas fa-shopping-cart"></i></a>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<script>
        document.addEventListener('DOMContentLoaded', function () {
    const searchIcon = document.getElementById('search-icon');
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');

    // Muestra u oculta el formulario de búsqueda
    searchIcon.addEventListener('click', function () {
        if (searchForm.style.display === 'none' || searchForm.style.display === '') {
            searchForm.style.display = 'block';
            searchInput.focus();
        } else {
            searchForm.style.display = 'none';
        }
    });

    // Oculta el formulario si haces clic fuera
    document.addEventListener('click', function (event) {
        if (!searchForm.contains(event.target) && !searchIcon.contains(event.target)) {
            searchForm.style.display = 'none';
        }
    });
});

    </script>
