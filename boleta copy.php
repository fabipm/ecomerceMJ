<?php
require_once 'config/db.php'; // Incluye el archivo de conexión a la base de datos

// Conectar a la base de datos
$db = Database::conexion();

// Consulta para obtener los productos del último pedido, incluyendo el descuento
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
        prod.descuento AS descuento, -- Porcentaje de descuento
        (pp.unidades * prod.precio * (1 - (prod.descuento / 100))) AS subtotal -- Subtotal con descuento
    FROM pedido p
    JOIN usuario u ON p.usuario_id = u.id
    JOIN pedido_producto pp ON p.id = pp.pedido_id
    JOIN producto prod ON pp.producto_id = prod.id
    WHERE p.id = (SELECT MAX(id) FROM pedido) -- Último pedido
    ORDER BY pp.id;
";

$result = $db->query($query);

// Variables para la boleta
$productos = []; // Array para almacenar los productos
$total = 0;

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Captura los datos generales del pedido
        $pedido_id = $row['pedido_id'];
        $cliente_nombre = $row['cliente_nombre'];
        $cliente_direccion = $row['cliente_direccion'];
        $boleta_fecha = date("d/m/Y", strtotime($row['pedido_fecha']));
        $compra_fecha = date("d/m/Y H:i", strtotime($row['pedido_fecha'] . ' ' . $row['pedido_hora']));
        
        // Cálculo del precio con descuento
        $precio_unitario = $row['precio_unitario'];
        $descuento = $row['descuento']; // Porcentaje de descuento
        $precio_con_descuento = $precio_unitario * (1 - ($descuento / 100));
        $subtotal = $row['cantidad'] * $precio_con_descuento;

        // Agregar los productos al array
        $productos[] = [
            "descripcion" => $row['producto_nombre'],
            "cantidad" => $row['cantidad'],
            "precio_unitario" => $precio_con_descuento,
            "subtotal" => $subtotal,
            "descuento" => $descuento
        ];

        // Sumar el subtotal al total general
        $total += $subtotal;
    }
} else {
    die("No se encontró el último pedido.");
}

// Variables de la empresa
$empresa_razon_social = "MIJO STORE E.I.R.L.";
$empresa_direccion = "Cal. Zela Nro. 267 Int. 104, Tacna, Perú";
$boleta_numero = "DEB001-" . str_pad($pedido_id, 6, '0', STR_PAD_LEFT); // Generar un número de boleta basado en el pedido ID
$cliente_metodo_pago = "Tarjeta de Crédito"; // Cambiar según tu lógica
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Compra</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .boleta {
            width: 100%;
            padding: 10mm;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-top: 3px solid #f7af51;
            margin: 0 auto;
            max-width: 210mm;
        }

        .header {
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .logo {
            margin-bottom: 10px;
        }

        .logo img {
            max-width: 140px;
            height: auto;
        }

        .invoice-info {
            text-align: right;
            margin-right: 45px;
        }

        .section h4 {
            background-color: #f7af51;
            color: black;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 14px;
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .table th {
            background-color: #3faabd;
            color: #fff;
            font-size: 12px;
            text-transform: uppercase;
            padding: 8px;
        }

        .table td {
            padding: 8px;
            border-bottom: 1px solid #ccc;
            font-size: 12px;
        }

        .table .subtotal-row {
            background-color: #f7f7f7;
        }

        .total {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            color: #2ecc71;
            margin-top: 15px;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-top: 20px;
        }

        @media print {
            body {
                background-color: #fff;
            }
            .boleta {
                box-shadow: none;
                border: none;
                margin: 0;
            }
            .logo img {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="boleta">
        <!-- Logo de la Empresa -->
        <div class="header">
            <div class="logo">
                <img src="assets/img/logo.png" alt="Logo de Mijo Store E.I.R.L.">
            </div>
            <div class="invoice-info">
                <p><strong>Comprobantes de Pago:</strong> <?= $boleta_numero; ?></p>
                <p><strong>RUC:</strong> 20609683415</p>
            </div>
        </div>

        <!-- Información del Cliente -->
        <div class="section">
            <h4>Información del Cliente</h4>
            <p><strong>Cliente:</strong> <?= $cliente_nombre; ?></p>
            <p><strong>Dirección:</strong> <?= $cliente_direccion; ?></p>
            <p><strong>Método de Pago:</strong> <?= $cliente_metodo_pago; ?></p>
            <p><strong>Fecha y Hora:</strong> <?= $compra_fecha; ?></p>
        </div>

        <!-- Detalles de productos -->
        <div class="section">
            <h4>Detalles de Compra</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Descuento</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto['descripcion']; ?></td>
                        <td><?= $producto['cantidad']; ?></td>
                        <td>s/ <?= number_format($producto['precio_unitario'], 2); ?></td>
                        <td><?= $producto['descuento']; ?>%</td>
                        <td>s/ <?= number_format($producto['subtotal'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr class="subtotal-row">
                        <td colspan="4" class="text-end">Total:</td>
                        <td>s/ <?= number_format($total, 2); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="total">
            Total a Pagar: s/<?= number_format($total, 2); ?>
        </div>

        <!-- Pie de página -->
        <div class="footer">
            <p>Gracias por tu compra. ¡Vuelve pronto!</p>
            <p>Teléfono: 052632704, +51952909892 | Email: mijostore.online@gmail.com</p>
            <p>Dirección: Cal. Zela Nro. 267, Tacna, Perú</p>
        </div>
    </div>
</body>
</html>
