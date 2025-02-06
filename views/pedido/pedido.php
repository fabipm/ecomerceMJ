
<script src="https://checkout.culqi.com/js/v4"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php if(!isset($_SESSION['identity'])): ?>
    <h3 class="alinear-tabla">¡Por favor, inicia sesión para completar tu compra!</h3>
<?php else: ?>
    <div class="alinear-tabla">
        <button class="boton"><a href="<?=base_url?>/carrito/index">Regresar al Carrito</a></button>
    </div>

    <h1 class="texto-centrado">Formulario de Pedido</h1>

    <!-- Mostrar el total calculado del pedido -->
    <div class="total-pedido alinear-tabla">
        <h3>Total de la Orden:</h3>
        <p><strong>s/ <?= number_format($total, 2, '.', '') ?></strong></p> <!-- Total del pedido -->
    </div>

    <div class="formulario-pedido alinear-tabla">
        <form id="form-pedido" action="<?=base_url?>/pedido/agregar" method="POST">
            <!-- Mapa de Google en un iframe -->
            <div class="grupo-formulario">
                <label for="direccion">Selecciona tu dirección:</label>
                <div style="margin-top: 10px;">
                    <input 
                        type="text" 
                        id="direccion" 
                        name="direccion" 
                        placeholder="Ingresa una dirección (ejemplo: Calle Zela 267, Tacna)" 
                        required 
                        style="width: 100%; padding: 10px;" 
                    />
                    <button 
                        type="button" 
                        onclick="actualizarMapa()" 
                        style="margin-top: 10px; padding: 10px; background-color: #3faabd; color: white; border: none; cursor: pointer;">
                        Mostrar en el mapa
                    </button>
                </div>
                <div style="margin-top: 20px;">
                    <iframe 
                        id="mapa" 
                        src="https://www.google.com/maps?q=Calle+Zela+Nro+267,+Tacna,+Peru&output=embed" 
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        aria-label="Mapa de ubicación">
                    </iframe>
                </div>
            </div>

            <!-- Campo para seleccionar el departamento -->
            <div class="grupo-formulario">
                <label for="departamento">Departamento:</label>
                <select name="departamento" id="departamento" required>
                    <option value="">Seleccione un departamento</option>
                    <!-- Aquí puedes poner todos los departamentos -->
                    <option value="Amazonas">Amazonas</option>
                    <option value="Áncash">Áncash</option>
                    <option value="Apurímac">Apurímac</option>
                    <option value="Arequipa">Arequipa</option>
                    <option value="Ayacucho">Ayacucho</option>
                    <option value="Cajamarca">Cajamarca</option>
                    <option value="Callao">Callao</option>
                    <option value="Cusco">Cusco</option>
                    <option value="Huancavelica">Huancavelica</option>
                    <option value="Huánuco">Huánuco</option>
                    <option value="Ica">Ica</option>
                    <option value="Junín">Junín</option>
                    <option value="La Libertad">La Libertad</option>
                    <option value="Lambayeque">Lambayeque</option>
                    <option value="Lima">Lima</option>
                    <option value="Loreto">Loreto</option>
                    <option value="Madre de Dios">Madre de Dios</option>
                    <option value="Moquegua">Moquegua</option>
                    <option value="Pasco">Pasco</option>
                    <option value="Piura">Piura</option>
                    <option value="Puno">Puno</option>
                    <option value="San Martín">San Martín</option>
                    <option value="Tacna">Tacna</option>
                    <option value="Tumbes">Tumbes</option>
                    <option value="Ucayali">Ucayali</option>

                </select>
            </div>

            <!-- Campo para seleccionar la provincia -->
            <div class="grupo-formulario">
                <label for="provincia">Provincia:</label>
                <select name="provincia" id="provincia" required>
                    <option value="">Seleccione una provincia</option>
                    <!-- Aquí se cargarán las provincias según el departamento seleccionado -->
                </select>
            </div>

            <!-- Campo oculto para el token de pago -->
            <input type="hidden" name="payment_token" id="payment_token">

            <!-- Campo oculto para el total de la compra -->
            <input type="hidden" name="total" value="<?= $total ?>">

            <!-- Botón de pago -->
            <button type="button" id="btn_pagar" class="boton">Comprar Ahora</button>
        </form>
    </div>
<?php endif; ?>


<script>
    // Configura tu clave pública de Culqi
    Culqi.publicKey = 'pk_test_76f77ee60467dbe0'; // Asegúrate de usar tu clave pública real
    
    // Botón de pago
    const btn_pagar = document.getElementById('btn_pagar');
    btn_pagar.addEventListener('click', function (e) {
        // Evitar el envío inmediato del formulario
        e.preventDefault();

        // Obtener el monto total (en céntimos)
        const total = <?= $total ?> * 100; // Convertir a céntimos

        // Configuración de Culqi
        Culqi.settings({
            title: 'Culqi Store',
            currency: 'PEN',
            amount: total, // Monto en céntimos (S/. <?= number_format($total, 2, '.', '') ?>)
        });

        // Opciones adicionales (opcional)
        Culqi.options({
            lang: "es",
            paymentMethods: {
                tarjeta: true,
                yape: true,
                bancaMovil: true,
                agente: true,
                billetera: true,
                cuotealo: true,
            },
            style: {
                logo: "https://static.culqi.com/v2/v2/static/img/logo.png",
            }
        });

        // Abre el formulario de Culqi para realizar el pago
        Culqi.open();
    });


    // Función que procesa el token generado por Culqi
    function culqi() {
        if (Culqi.token) {
            const token = Culqi.token.id;
            const email = Culqi.token.email;
            const montoTotal = <?= $total ?> * 100; // Convertir a céntimos
            console.log('Token generado: ', token);

            // Enviar datos al servidor
            $.ajax({
                url: "<?php echo base_url . 'views/pedido/procesarPago.php'; ?>",
                type: "POST",
                data: {
                    token: token,
                    email: email, 
                    montoTotal: montoTotal  // Aquí cambié 'monto' por 'montoTotal'
                },
                success: function (resp) {
                    alert("Pago procesado exitosamente: " + resp);
                },
                error: function (error) {
                    console.error("Error al procesar el pago:", error);
                    alert("Ocurrió un error al procesar el pago.");
                }
            });

            // Asigna el token al campo oculto del formulario
            document.getElementById('payment_token').value = token;

            // Ahora, envía el formulario con el token al servidor
            document.getElementById('form-pedido').submit(); // Envía el formulario con el token
        } else {
            console.error("Error en Culqi: ", Culqi.error);
            alert("Ocurrió un error al generar el token: " + Culqi.error.merchant_message);
        }
    }


    // Función para actualizar el mapa
    function actualizarMapa() {
        const direccion = document.getElementById('direccion').value.trim();
        if (!direccion) {
            alert("Por favor, ingresa una dirección válida.");
            return;
        }
        const direccionFormateada = direccion.replace(/ /g, "+");
        document.getElementById('mapa').src = `https://www.google.com/maps?q=${direccionFormateada}&output=embed`;
    }



    // Llenar el campo "provincia" según el departamento seleccionado
    $('#departamento').change(function() {
        var departamento = $(this).val(); // Ahora usamos la variable correcta para departamento
        var provincias = [];

        // Dependiendo del departamento seleccionado, cargamos las provincias correspondientes
        if (departamento === "Amazonas") {
            provincias = ["Chachapoyas", "Bagua", "Bongará", "Condorcanqui", "Luya", "Rodríguez de Mendoza", "Utcubamba"];
        } else if (departamento === "Áncash") {
            provincias = ["Huaraz", "Aija", "Bolognesi", "Carhuaz", "Carlos Fermín Fitzcarrald", "Casma", "Corongo", "Huari", "Huarmey", "Mariscal Luzuriaga", "Ocros", "Pallasca", "Pomabamba", "Recuay", "Santa", "Sihuas", "Yungay"];
        } else if (departamento === "Apurímac") {
            provincias = ["Abancay", "Andahuaylas", "Antabamba", "Aymaraes", "Cotabambas", "Chincheros", "Grau"];
        } else if (departamento === "Arequipa") {
            provincias = ["Arequipa", "Camaná", "Caravelí", "Caylloma", "Condesuyos", "Islay", "La Unión"];
        } else if (departamento === "Ayacucho") {
            provincias = ["Ayacucho", "Cangallo", "Huamanga", "Huanca Sancos", "Lucanas", "Parinacochas", "Pacocha", "Sucre", "Victor Fajardo", "Vilcashuamán"];
        } else if (departamento === "Cajamarca") {
            provincias = ["Cajamarca", "Celendín", "Chota", "Contumazá", "Cutervo", "Hualgayoc", "Jaén", "San Ignacio", "San Marcos", "San Miguel", "San Pablo", "Santa Cruz"];
        } else if (departamento === "Callao") {
            provincias = ["Callao"];
        } else if (departamento === "Cusco") {
            provincias = ["Cusco", "Acomayo", "Anta", "Calca", "Canas", "Chumbivilcas", "Espinar", "La Convención", "Paruro", "Paucartambo", "Quispicanchi", "Urubamba"];
        } else if (departamento === "Huancavelica") {
            provincias = ["Huancavelica", "Acobamba", "Angaraes", "Castrovirreyna", "Churcampa", "Huaytará", "Tayacaja"];
        } else if (departamento === "Huánuco") {
            provincias = ["Huánuco", "Ambo", "Dos de Mayo", "Huacaybamba", "Leoncio Prado", "Marañón", "Pachitea", "Puerto Inca", "Yarowilca"];
        } else if (departamento === "Ica") {
            provincias = ["Ica", "Chincha", "Nazca", "Palpa", "Pisco"];
        } else if (departamento === "Junín") {
            provincias = ["Junín", "Chanchamayo", "Chupaca", "Concepción", "Huancayo", "Jauja", "Junín", "Satipo", "Tarma", "Yauli"];
        } else if (departamento === "La Libertad") {
            provincias = ["Trujillo", "Ascope", "Bolívar", "Chepén", "Gran Chimu", "Julcán", "Otuzco", "Pacasmayo", "Pataz", "Sánchez Carrión", "Santiago de Chuco", "Virú"];
        } else if (departamento === "Lambayeque") {
            provincias = ["Chiclayo", "Ferreñafe", "Lambayeque"];
        } else if (departamento === "Lima") {
            provincias = ["Lima", "Barranca", "Cajatambo", "Canta", "Cañete", "Huaral", "Huarochirí", "Lima Provincias", "Oyon", "Yauyos"];
        } else if (departamento === "Loreto") {
            provincias = ["Iquitos", "Alto Nanay", "Loreto", "Mariscal Ramón Castilla", "Maynas", "Requena", "Ucayali", "Putumayo"];
        } else if (departamento === "Madre de Dios") {
            provincias = ["Puerto Maldonado", "Manu", "Tambopata"];
        } else if (departamento === "Moquegua") {
            provincias = ["Moquegua", "Ilo", "Mariscal Nieto"];
        } else if (departamento === "Pasco") {
            provincias = ["Pasco", "Daniel Alcides Carrión", "Oxapampa", "Chaupimarca", "Yanahuanca"];
        } else if (departamento === "Piura") {
            provincias = ["Piura", "Ayabaca", "Huancabamba", "Paita", "Sullana", "Talara", "Sechura"];
        } else if (departamento === "Puno") {
            provincias = ["Puno", "Azángaro", "Carabaya", "Chucuito", "El Collao", "Huancané", "Lampa", "Melgar", "San Antonio de Putina", "San Román", "Sandia", "Yunguyo"];
        } else if (departamento === "San Martín") {
            provincias = ["Moyobamba", "Bellavista", "El Dorado", "Huallaga", "Lamas", "Mariscal Cáceres", "Picota", "San Martín"];
        } else if (departamento === "Tacna") {
            provincias = ["Tacna", "Candarave", "Jorge Basadre", "Tarata"];
        } else if (departamento === "Tumbes") {
            provincias = ["Tumbes", "Contralmirante Villar", "Zarumilla"];
        } else if (departamento === "Ucayali") {
            provincias = ["Pucallpa", "Atalaya", "Coronel Portillo", "Purús"];
        }
        // Limpiar el campo de provincias y agregar las opciones correspondientes
        $('#provincia').empty();
        $('#provincia').append('<option value="">Seleccione una provincia</option>');
        $.each(provincias, function(index, provincia) {
            $('#provincia').append('<option value="'+provincia+'">'+provincia+'</option>');
        });
    });
</script>
