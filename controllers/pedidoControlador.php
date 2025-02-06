<?php
require_once 'models/pedido.php';
require_once 'vendor/autoload.php';
require_once 'models/Promocion.php';

use Spipu\Html2Pdf\Html2Pdf;

class pedidoControlador {
    public function index(){
        echo "Controlador de Pedidos, Acción index";
    }

    public function pedido() {
        // Verificar si el total fue enviado desde el carrito
        if (isset($_POST['total'])) {
            $total = $_POST['total'];  // Obtener el total del carrito
    
            require_once 'views/pedido/pedido.php';
        } else {
            // Si no se recibe el total, redirigimos al carrito
            header('Location: ' . base_url . 'carrito/index');
            exit();
        }
    }

    public function agregar() {
        if (isset($_SESSION['identity'])) {
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $usuarioId = $_SESSION['identity']->id;
    
            // Inicializamos el total con descuento
            $totalConDescuento = 0;
    
            // Calcular el precio total del carrito con los descuentos
            if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
                foreach ($_SESSION['carrito'] as $indice => $producto) {
                    $item = $producto['producto'];
                    $descuento = 0;
    
                    // Crear instancia del modelo Promocion
                    $promocion = new Promocion();
                    // Obtener promociones activas para el producto
                    $promociones = $promocion->obtenerPromocionesProducto($item->id);
    
                    // Verificar si el producto tiene promoción activa
                    if ($promociones && $promociones->num_rows > 0) {
                        $promo = $promociones->fetch_assoc();
                        $descuento = $promo['descuento_porcentaje'];
                    }
    
                    // Calcular el precio final con descuento solo si hay descuento
                    if ($descuento > 0) {
                        // Si hay descuento, aplicarlo al precio
                        $precioFinal = $item->precio * (1 - ($descuento / 100));
                    } else {
                        // Si no hay descuento, el precio final es el precio original
                        $precioFinal = $item->precio;
                    }
    
                    // Acumulamos el total con el precio final y las unidades
                    $totalConDescuento += $precioFinal * $_SESSION['carrito'][$indice]['unidades'];
                }
            }
    
            // Guardar pedido en la base de datos
            if ($departamento && $provincia && $direccion) {
                $pedido = new Pedido();
                $pedido->setDepartamento($departamento);
                $pedido->setProvincia($provincia);
                $pedido->setDireccion($direccion);
                $pedido->setUsuario_id($usuarioId);
                $pedido->setPrecio_total($totalConDescuento); // Usamos el total calculado con descuento
    
                $guardar = $pedido->guardar();
    
                // Guardar pedido en la tabla pedido_producto
                $guardarProductosPedido = $pedido->guardarProductosPedido();
    
                if ($guardar && $guardarProductosPedido) {
                    $_SESSION['pedido'] = "completado";
                } else {
                    $_SESSION['pedido'] = "fallido";
                }
            } else {
                $_SESSION['pedido'] = "fallido";
            }
        } else {
            header("Location: " . base_url);
        }
    
        header("Location: " . base_url . "pedido/confirmado");
    }
    
    public function confirmado(){
        $pedido = new Pedido();
        $ultimoPedido = $pedido->obtenerUltimoPedido();
        require_once 'views/pedido/confirmado.php';
    }

    public function descargar(){
        // Limpiar cualquier salida previa
        ob_clean();
        ob_start();
    
        // Crear la instancia de Html2Pdf
        $pedido = new Pedido();
        $pedidoDescarga = $pedido->obtenerUltimoPedido();
        $html2pdf = new Html2Pdf('P', 'A5', 'es');  // Configura el tamaño y el idioma
        
        // Obtener el contenido HTML
        require_once 'views/pedido/confirmarDescarga.php';
        $html = ob_get_clean();
        
        // Escribir el HTML en el PDF
        $html2pdf->writeHTML($html);
    
        // Forzar la descarga del archivo PDF
        $html2pdf->output('confirmacion_pago.pdf', 'D'); // 'D' para forzar la descarga
        
        // Limpiar la sesión después de la descarga
        unset($_SESSION['carrito']);
    }
    

    public function misPedidos(){
       Utilidades::estaLogueado();
       $todosPedidos = new Pedido();
       $usuarioId = $_SESSION['identity']->id;
       $todosPedidos->setUsuario_id($usuarioId);
       $res = $todosPedidos->obtenerTodosPorUsuario(); // Cambié `$resultado` a `$res`
       require_once 'views/pedido/misPedidos.php'; // Cambié a la ruta correcta
    }

    public function detallesPedido(){
        Utilidades::estaLogueado();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $usuarioId = $_SESSION['identity']->id;
            $pedido = new Pedido();
            $pedido->setId($id);
            $detallesPedido = $pedido->obtenerPedidoEspecifico();
            $productos = $pedido->obtenerProductosPorPedido();
            $pedido->setUsuario_id($usuarioId);
            $verificacion = $pedido->obtenerUltimoPorUsuario();
            require_once 'views/pedido/detallesPedido.php';
        } else {
            header("Location: ".base_url."pedido/misPedidos");
        }
    }

    public function gestionar(){
        Utilidades::esAdmin();
        $admin = true;
        $pedido = new Pedido();
        $res = $pedido->obtenerProductos(); // Cambié `$resultado` a `$res`
        require_once 'views/pedido/misPedidos.php'; // Cambié a la ruta correcta
    }

    public function actualizarEstado(){
        Utilidades::esAdmin();
        if(isset($_POST['pedidoId']) && isset($_POST['estatus'])){
            // Actualizar pedido
            $pedido = new Pedido();
            $pedido->setId($_POST['pedidoId']);
            $pedido->setEstatus($_POST['estatus']);
            $pedido->actualizar();
            header("Location: ".base_url."pedido/detallesPedido&id=".$_POST['pedidoId']);
        } else {
            header("Location: ".base_url);
        }
    }
}
