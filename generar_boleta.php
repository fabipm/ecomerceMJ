<?php
require_once 'config/db.php';

// Conectar a la base de datos y obtener los datos del pedido
$db = Database::conexion();

$query = "
    SELECT 
        p.id AS pedido_id,
        CONCAT(u.nombre, ' ', u.apellido) AS cliente_nombre,
        CONCAT(p.direccion, ', ', p.provincia, ', ', p.departamento) AS cliente_direccion,
        p.precio_total AS total,
        p.fecha AS pedido_fecha,
        p.hora AS pedido_hora,
        pp.unidades AS cantidad,
        prod.nombre AS producto_nombre,
        prod.precio AS precio_unitario,
        prod.descuento AS descuento,
        (pp.unidades * prod.precio * (1 - (prod.descuento / 100))) AS subtotal
    FROM pedido p
    JOIN usuario u ON p.usuario_id = u.id
    JOIN pedido_producto pp ON p.id = pp.pedido_id
    JOIN producto prod ON pp.producto_id = prod.id
    WHERE p.id = (SELECT MAX(id) FROM pedido)
    ORDER BY pp.id;
";

$result = $db->query($query);

$productos = [];
$total = 0;

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pedido_id = $row['pedido_id'];
        $cliente_nombre = $row['cliente_nombre'];
        $cliente_direccion = $row['cliente_direccion'];
        $boleta_fecha = date("d/m/Y", strtotime($row['pedido_fecha']));
        $compra_fecha = date("d/m/Y H:i", strtotime($row['pedido_fecha'] . ' ' . $row['pedido_hora']));

        $precio_unitario = $row['precio_unitario'];
        $descuento = $row['descuento'];
        $precio_con_descuento = $precio_unitario * (1 - ($descuento / 100));
        $subtotal = $row['cantidad'] * $precio_con_descuento;

        $productos[] = [
            "descripcion" => $row['producto_nombre'],
            "cantidad" => $row['cantidad'],
            "precio_unitario" => $precio_con_descuento,
            "subtotal" => $subtotal,
            "descuento" => $descuento,
        ];

        $total += $subtotal;
    }
} else {
    die("No se encontró el último pedido.");
}

// Variables de la empresa
$empresa_razon_social = "MIJO STORE E.I.R.L.";
$empresa_direccion = "Cal. Zela Nro. 267 Int. 104, Tacna, Perú";
$boleta_numero = "DEB001-" . str_pad($pedido_id, 6, '0', STR_PAD_LEFT);
$cliente_metodo_pago = "Tarjeta de Crédito";

// Incluir la plantilla
ob_start();
include 'boleta.php';
$contenido_boleta = ob_get_clean();

echo $contenido_boleta; // Mostrar o usar este contenido
