<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mijo Store - Footer</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Iconos de FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Style para footer -->
  <link rel="stylesheet" href="<?=base_url?>assets/css/footer/footer.css">
</head>
<body>

<!-- Footer -->
<footer class="footer">
  <!-- Información de la tienda y redes sociales -->
  <div class="container">
    <div class="row">
      <!-- Logo de Mijo Store -->
      <div class="col-12 text-center">
        <img class="logo" src="<?=base_url?>assets/img/logo1.png" alt="Logo Mijo Store">
        <div class="logo-line"></div> <!-- Línea debajo del logo -->
      </div>

      <!-- Información de la tienda -->
      <div class="col-md-3 contact-us">
        <h5>Mijo Store</h5>
        <p>Tu tienda de confianza para celulares de última tecnología.</p>
        <ul class="list-unstyled">
          <li><a href="#">Sobre nosotros</a></li>
          <li><a href="#">Política de privacidad</a></li>
          <li><a href="#">Términos y condiciones</a></li>
          <li><a href="#">Contacto</a></li>
        </ul>
      </div>

      <!-- Redes Sociales -->
      <div class="col-md-3 contact-us">
        <h5>Redes Sociales</h5>
        <div class="social-icons">
          <a href="https://www.facebook.com/mijostore.tacna" class="fab fa-facebook-square" aria-label="Facebook"></a>
          <a href="https://www.tiktok.com/@mijo_store" class="fab fa-tiktok" aria-label="TikTok"></a>
          <a href="https://www.instagram.com/mijostoretacna/?hl=es-la" class="fab fa-instagram-square" aria-label="Instagram"></a>
          <a href="https://www.youtube.com/@comerciaspe7649" class="fab fa-youtube-square" aria-label="YouTube"></a>
          <a href="https://wa.me/51952909892" class="fab fa-whatsapp-square" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer"></a>
        </div>
      </div>

      <!-- Contáctanos (nueva sección) -->
      <div class="col-md-3 contact-us">
        <h5>Contáctanos</h5>
        <ul class="list-unstyled">
          <li><i class="fas fa-phone-alt"></i> 052632704, +51952909892</li>
          <li><i class="fas fa-envelope"></i> mijostore.online@gmail.com</li>
          <li><i class="fas fa-map-marker-alt"></i> Calle Zela Nro 267, Tacna, Perú</li>
        </ul>      
      </div>
    </div>

    <!-- Sección de Mapa y Contacto -->
    <div class="row mt-4">
      <div class="col-md-6 text-center">
        <h5>Ubicación</h5>
        <div class="map-container">
        <iframe 
          src="https://www.google.com/maps?q=Calle+Zela+Nro+267,+Tacna,+Peru&output=embed" 
          width="100%" 
          height="400" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy" 
          aria-label="Mapa de ubicación de Mijo Store">
        </iframe>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center mt-4 copyright">
      <p>&copy; 2024 Mijo Store. Todos los derechos reservados.</p>
    </div>
  </div>
</footer>

<!-- Bootstrap JS y dependencias -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
