<?php
require_once 'models/producto.php';
include_once 'models/Imagen.php';  // Si no usas autoload, incluye manualmente la clase
include_once 'models/Promocion.php';

class productoControlador {
    public function index(){
        // Renderizar índice
        $producto = new Producto();
        $productos = $producto->obtenerAleatorio(6);
        require_once 'views/producto/productos-destacados.php';
    }

    public function gestionar(){
        Utilidades::esAdmin();

        $producto = new Producto();
        $productos = $producto->obtenerProductos();
        require_once 'views/producto/gestionar.php';
    }
    
    public function crear(){
        Utilidades::esAdmin();
        require_once 'views/producto/crear.php';
    }

    public function guardar(){
        Utilidades::esAdmin();
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $color = isset($_POST['color']) ? $_POST['color'] : false;  // Recibir el color del formulario
            
            if($nombre && $descripcion && $precio && $stock && $categoria && $color){  // Verificar que color no esté vacío
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);
                $producto->setColor($color);  // Asignar el color al producto
    
                // Guardar imagen
                if(isset($_FILES['imagen'])){
                    $imagen = $_FILES['imagen'];
                    $nombreImagen = $imagen['name'];
                    $tipoMime = $imagen['type'];
    
                    if($tipoMime == "image/jpg" || $tipoMime == "image/jpeg" || $tipoMime == "image/png" || $tipoMime == "image/gif"){
                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true); // Crear la carpeta si no existe
                        }
    
                        move_uploaded_file($imagen['tmp_name'], 'uploads/images/'.$nombreImagen);
                        $producto->setImagen($nombreImagen);
                    }
                }
    
                // Verificar si es un nuevo producto o una actualización
                if(isset($_GET['id'])){
                    $producto->setId($_GET['id']);
                    $guardar = $producto->actualizar();                
                } else {
                    $guardar = $producto->guardar();
                }
                
                if($guardar){
                    $_SESSION['producto'] = "completado";
                } else {
                    $_SESSION['producto'] = "fallido";
                }
            } else {
                $_SESSION['producto'] = "fallido";
            }
        } else {
            $_SESSION['producto'] = "fallido";
        }
    
        header("Location:".base_url."producto/gestionar");
    }
    

    public function editar(){
        Utilidades::esAdmin();
        
        if(isset($_GET['id'])){
            $editar = true;
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $productoEditar = $producto->obtenerProductoActual(); // Obtener el producto actual
    
            // Verifica si el producto tiene el color
            $color = isset($productoEditar->color) ? $productoEditar->color : '';  // Asignar el color al producto
    
            require_once 'views/producto/crear.php';  // Aquí pasas el color al formulario de edición
        } else {
            header("Location:".base_url."producto/gestionar");
        }
    }
    

    public function eliminar(){
        Utilidades::esAdmin();

        if(isset($_GET['id'])){
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $eliminar = $producto->eliminar();

            if($eliminar){
                $_SESSION['eliminado'] = "completado";
            } else {
                $_SESSION['eliminado'] = "fallido";
            }
        } else {
            $_SESSION['eliminado'] = "fallido";
        }

        header("Location:".base_url."producto/gestionar");
    } // fin de eliminar

//cambios exrtaa----------------
    public function productoUnico() {
        if (isset($_GET['id'])) {
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $productoUnico = $producto->obtenerProductoActual();
    
            // Asegúrate de que estás recuperando las imágenes correctamente
            $imagenes_adicionales = $producto->obtenerImagenesAdicionales($producto->getId());
            $productoUnico->imagenes_adicionales = $imagenes_adicionales;
    
            require_once 'views/producto/producto-unico.php';
            
        } else {
            header("Location:".base_url."producto/gestionar");
        }
    }
    

    public function ver_imagenes() {
        // Verificar que el usuario sea administrador (si es necesario)
        Utilidades::esAdmin();
    
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
    
            // Crear instancia del modelo Producto
            $producto = new Producto();
    
            // Obtener el producto actual con el ID proporcionado
            $producto->setId($producto_id);
            $productoUnico = $producto->obtenerProductoActual(); // Obtener el producto seleccionado
    
            // Verificar si el producto existe
            if (!$productoUnico) {
                // Redirigir si no existe el producto
                header("Location:" . base_url . "producto/gestionar");
                exit;
            }
    
            // Obtener las imágenes adicionales
            $imagenes_adicionales = $producto->obtenerImagenesAdicionales($producto_id);
            // Asignar las imágenes adicionales al producto
            $productoUnico->imagenes_adicionales = $imagenes_adicionales;
    
            // Pasar el producto y las imágenes a la vista
            require_once 'views/producto/ver_imagenes.php';
        } else {
            // Redirigir a la página de gestión de productos si no se pasa un ID
            header("Location:" . base_url . "producto/gestionar");
        }
    }
//--------------



    // Método para guardar o editar la imagen
    public function guardar_o_editar_imagen() {
        // Verificar si se ha enviado una imagen
        if (isset($_FILES['imagen'])) {
            // Ruta donde se guardarán las imágenes
            $directorio_destino = 'uploads/images/';
    
            // Verificar si el directorio existe, si no lo crea
            if (!is_dir($directorio_destino)) {
                mkdir($directorio_destino, 0777, true);  // Crear directorio si no existe
            }
    
            // Obtener el archivo de la imagen
            $imagen = $_FILES['imagen'];
            $nombre_imagen = $imagen['name'];
    
            // Validar tipo de archivo (puedes agregar más validaciones aquí si lo deseas)
            $tipo_imagen = mime_content_type($imagen['tmp_name']);
            if (strpos($tipo_imagen, 'image') === false) {
                $_SESSION['error'] = "El archivo no es una imagen válida.";
                header("Location: " . base_url . "producto/ver_imagenes&id=" . $_POST['producto_id']);
                exit;
            }
    
            // Generar un nombre único para evitar sobrescribir archivos
            $nombre_imagen = uniqid() . '_' . basename($nombre_imagen);
    
            // Subir el archivo al directorio destino
            $ruta_completa = $directorio_destino . $nombre_imagen;
            move_uploaded_file($imagen['tmp_name'], $ruta_completa);
    
            // Obtener el ID del producto
            $producto_id = $_POST['producto_id'];
    
            // Si hay un imagen_id (se está editando una imagen existente)
            if (isset($_POST['imagen_id'])) {
                $imagen_id = $_POST['imagen_id'];
    
                // Eliminar la imagen antigua si se está reemplazando
                $imagen_actual = Imagen::obtener_imagen_por_id($imagen_id);
                if ($imagen_actual && file_exists($imagen_actual['ruta_completa'])) {
                    unlink($imagen_actual['ruta_completa']);  // Eliminar archivo de imagen
                }
    
                // Actualizar la imagen en la base de datos (reemplazar)
                $imagen_url = $nombre_imagen;  // Solo guardar el nombre del archivo
                Imagen::actualizar_imagen($imagen_id, $producto_id, $imagen_url);
    
                $_SESSION['success'] = "Imagen actualizada correctamente.";
            } else {
                // Si no hay imagen_id, estamos agregando una nueva imagen
                $imagen_url = $nombre_imagen;
                $imagen_guardada = new Imagen();
                $imagen_guardada->guardar_imagen($producto_id, $imagen_url);
    
                $_SESSION['success'] = "Imagen agregada correctamente.";
            }
    
            // Redirigir al usuario de vuelta a la página de imágenes del producto
            header("Location: " . base_url . "producto/ver_imagenes&id=" . $producto_id);
        } else {
            $_SESSION['error'] = "No se ha seleccionado ninguna imagen.";
            header("Location: " . base_url . "producto/ver_imagenes&id=" . $_POST['producto_id']);
        }
    }
    


    public function eliminar_imagen(){
        Utilidades::esAdmin();
    
        if(isset($_POST['imagen_id']) && isset($_POST['producto_id'])){
            $imagen_id = $_POST['imagen_id'];
            $producto_id = $_POST['producto_id'];
    
            // Llama al método para eliminar la imagen
            $eliminar = Imagen::eliminar_imagen($imagen_id);
    
            if($eliminar){
                $_SESSION['eliminado_imagen'] = "completado";
            } else {
                $_SESSION['eliminado_imagen'] = "fallido";
            }
        } else {
            $_SESSION['eliminado_imagen'] = "fallido";
        }
    
        // Redirige al gestionar el producto después de eliminar la imagen
        header("Location:".base_url."producto/ver_imagenes&id=".$producto_id);
    }
    
    /*----------------------------------------------------------------- */

    public function ver_promocion() {
        Utilidades::esAdmin();
    
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
    
            // Crear una instancia del modelo Promocion
            $promocion = new Promocion();
            $promociones = $promocion->obtenerPromocionesProducto($producto_id);
    
            // Pasar las promociones a la vista correspondiente
            require_once 'views/producto/ver_promocion.php'; // Asegúrate de tener esta vista creada
        } else {
            // Redirigir si no hay un ID de producto proporcionado
            header("Location: " . base_url . "producto/gestionar");
        }
    }

    // Método para mostrar el formulario de creación de promociones
    public function crear_promociones() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $producto_id = $_GET['id'];
            // Asegúrate de que el producto ID esté correctamente pasado
            require_once 'views/producto/agregar_promocion.php';
        } else {
            // Redirige al listado de productos si no se pasa un ID de producto válido
            header("Location: " . base_url . "producto/gestionar");
            exit;
        }
    }

    // Método para guardar la promoción
    public function guardar_promocion() {
        if (isset($_POST)) {
            // Obtener los datos del formulario
            $producto_id = isset($_POST['producto_id']) ? $_POST['producto_id'] : false;
            $fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : false;
            $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : null;
            $descuento_porcentaje = isset($_POST['descuento_porcentaje']) ? $_POST['descuento_porcentaje'] : false;
            $tipo_promocion_id = isset($_POST['tipo_promocion_id']) ? $_POST['tipo_promocion_id'] : false;
            $activo = isset($_POST['activo']) ? 1 : 0;  // Si está marcado el checkbox, lo guardamos como 1

            // Verificar que todos los campos necesarios están completos
            if ($producto_id && $fecha_inicio && $descuento_porcentaje && $tipo_promocion_id) {
                // Crear objeto de la clase Promocion
                $promocion = new Promocion();
                
                // Llamar a los métodos de la clase Promocion
                $promocion->setProducto_id($producto_id);              // Establecer producto_id
                $promocion->setFecha_inicio($fecha_inicio);            // Establecer fecha_inicio
                $promocion->setFecha_fin($fecha_fin);                  // Establecer fecha_fin
                $promocion->setDescuento_porcentaje($descuento_porcentaje); // Establecer descuento_porcentaje
                $promocion->setTipo_promocion_id($tipo_promocion_id);  // Establecer tipo_promocion_id
                $promocion->setActivo($activo);                        // Establecer si está activo o no

                // Guardar la promoción
                $guardar = $promocion->guardar();

                // Verificar si la promoción fue guardada correctamente
                if ($guardar) {
                    $_SESSION['promocion'] = "completado";  // Establecer sesión si el guardado fue exitoso
                } else {
                    $_SESSION['promocion'] = "fallido";  // Si algo falla
                }
            } else {
                $_SESSION['promocion'] = "fallido";  // Si faltan datos
            }
        }

        // Redirigir al producto después de intentar guardar la promoción
        header("Location: " . base_url . "producto/ver_promocion&id=" . $_POST['producto_id']);
    }

    public function eliminar_promocion() {
        Utilidades::esAdmin();  // Verificar si el usuario es administrador
    
        if (isset($_GET['id'])) {  // Verificar si el ID de la promoción está presente en la URL
            $promocion = new Promocion();
            $promocion->setId($_GET['id']);  // Establecer el ID de la promoción
    
            // Aquí utilizamos el método 'eliminar' del modelo para eliminar la promoción
            $eliminar = $promocion->eliminar();
    
            if ($eliminar) {
                $_SESSION['eliminado'] = "completado";  // Establecer la sesión para indicar éxito
            } else {
                $_SESSION['eliminado'] = "fallido";  // Indicar que hubo un error
            }
        } else {
            $_SESSION['eliminado'] = "fallido";  // Si no se pasa un ID, se marca como fallido
        }
    
        // Redirigir a la vista de promociones del producto después de la eliminación
        header("Location: " . base_url . 'producto/gestionar');
    }

    public function editar_promocion() {
        Utilidades::esAdmin();  // Verificamos que el usuario tenga permisos de administrador
    
        // Verificamos que el ID de la promoción esté presente y sea un valor numérico
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    
            // Creamos un objeto de la clase Promocion
            $promo = new Promocion();
    
            // Llamamos al método obtenerPorId pasándole el ID de la promoción
            $promocion = $promo->obtenerPorId($_GET['id']);  // Usamos el valor de $_GET['id']
    
            // Verificamos si se ha encontrado la promoción
            if ($promocion) {
                // Si encontramos la promoción, cargamos la vista de edición
                require_once 'views/producto/editar_promocion.php';
            } else {
                // Si no encontramos la promoción, redirigimos con un mensaje de error
                $_SESSION['error'] = 'La promoción no existe o ha sido eliminada.';
                header('Location: ' . base_url . 'producto/gestionar');  // Corregimos aquí
                exit();
            }
        } else {
            // Si el ID no está presente o es inválido, redirigimos a la lista de promociones
            $_SESSION['error'] = 'ID inválido.';
            header('Location: ' . base_url . 'producto/gestionar');
            exit();
        }
    }
    

    public function actualizar_promocion() {
        Utilidades::esAdmin();  // Verificar si el usuario es administrador
        
        // Verifica si los datos están llegando correctamente
        if (isset($_POST['id']) && is_numeric($_POST['id'])) {
            // Crear un objeto de la clase Promocion
            $promo = new Promocion();
            
            // Establecer los valores usando los métodos setter correspondientes
            $promo->setId($_POST['id']);
            $promo->setFecha_inicio($_POST['fecha_inicio']);
            $promo->setFecha_fin($_POST['fecha_fin']);
            
            // Verificar si las claves existen antes de usarlas
            $descuento = isset($_POST['descuento_porcentaje']) ? $_POST['descuento_porcentaje'] : 0;
            $tipo_promocion = isset($_POST['tipo_promocion_id']) ? $_POST['tipo_promocion_id'] : 0;
            
            // Asignar los valores
            $promo->setDescuento_porcentaje($descuento);
            $promo->setTipo_promocion_id($tipo_promocion);
            $promo->setActivo(isset($_POST['activo']) ? 1 : 0); // Si está activo
    
            // Intentar actualizar la promoción en la base de datos
            $actualizado = $promo->actualizar();
    
            // Verifica si la actualización fue exitosa
            if ($actualizado) {
                $_SESSION['promocion'] = 'completado';
            } else {
                $_SESSION['promocion'] = 'fallido';
            }
    
            // Redirigir a la página de promociones
            header('Location: ' . base_url . 'producto/gestionar');
        } else {
            $_SESSION['promocion'] = 'fallido';
            header('Location: ' . base_url . 'producto/gestionar');
        }
    }
    
    
    
    
    
}
