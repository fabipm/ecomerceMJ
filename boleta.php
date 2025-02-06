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
                <p><strong>Comprobante de Pago:</strong> <?= $boleta_numero; ?></p>
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