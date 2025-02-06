<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == "completado"): ?>
    <style>
        /* Estilo general de la notificación de éxito */
        .mensaje-exito {
            background-color: #4CAF50; /* Verde para éxito */
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .icono-exito {
            font-size: 40px; /* Tamaño grande para el ícono */
            margin-right: 20px;
        }

        .texto-exito h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .texto-exito h4 {
            font-size: 18px;
            margin-top: 10px;
        }

        /* Estilo de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Botón de descarga */
        .boton a {
            text-decoration: none;
            color: white;
        }

        .boton {
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .boton:hover {
            background-color: #45a049;
        }

        /* Fuente de Font Awesome para el ícono */
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    </style>

    <div class="contenedor-confirmado">
        <div class="mensaje-exito">
            <div class="icono-exito">
                <!-- Ícono de éxito (puedes usar Font Awesome o un SVG) -->
                <i class="fas fa-check-circle"></i> 
            </div>
            <div class="texto-exito">
                <h1>¡Pedido Confirmado!</h1>
                <h4>Tu pedido se ha realizado con éxito. Aquí está la información:</h4>
            </div>
        </div>

        <table>
            <tr>
                <th>ID del Pedido</th>
                <th>Dirección de Entrega</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Precio Total</th>
            </tr>
            <tr>
                <?php $ultimoPedido = $ultimoPedido->fetch_object(); ?>
                <td><?=$ultimoPedido->id;?></td>
                <td><?=$ultimoPedido->direccion;?></td>
                <td><?=$ultimoPedido->fecha;?></td>
                <td><?=$ultimoPedido->hora;?></td>
                <td><?=$ultimoPedido->precio_total;?></td>
            </tr>
        </table>
        
        <div class="alinear-tabla">
            <button class="boton">
                <a href="<?=base_url?>pedido/descargar">
                    Descargar Comprobantes de Pago
                </a>
            </button>
        </div>
    </div>
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != "completado"):?>
    <h3 class="alinear-tabla">Lo sentimos, tu pedido no pudo ser procesado.</h3>
<?php endif; ?>
