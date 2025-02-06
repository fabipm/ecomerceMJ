<?php 
// Incluir el autoload generado por Composer
require_once $_SERVER['DOCUMENT_ROOT'] . '/proyecto/vendor/autoload.php';

// Configurar tu API Key y autenticación
$PUBLIC_KEY = "pk_test_76f77ee60467dbe0";
$SECRET_KEY = "sk_test_18215788c53bc626";

// Crear una instancia de Culqi
$culqi = new \Culqi\Culqi(array('api_key' => $SECRET_KEY));

try {
    // Crear el cargo (pago)
    $charge = $culqi->Charges->create(
        array(
            "amount" => $_POST["montoTotal"],  // Asegúrate de recibir "montoTotal"
            "currency_code" => "PEN",  // Moneda (PEN = Sol Peruano)
            "description" => "Venta de prueba",  // Descripción del cargo
            "email" => $_POST["email"],  // Correo del cliente
            "source_id" => $_POST["token"]  // Token generado por Culqi
        )
    );

    echo "Pago Exitoso";  // Mostrar mensaje de éxito

} catch (\Exception $e) {
    // Capturar cualquier error y mostrarlo
    echo 'Error: ' . $e->getMessage();
}
?>
