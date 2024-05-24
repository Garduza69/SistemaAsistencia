<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit();
}

// Evitar almacenamiento en caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lector</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="assets/plugins/qrCode.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('check_session.php', { cache: 'no-store' })
                .then(response => response.json())
                .then(data => {
                    if (!data.authenticated) {
                        // Redirigir a la página de inicio de sesión si no está autenticado
                        window.location.href = 'index.php';
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        // Evitar que el navegador almacene en caché
        if (window.history && window.history.pushState) {
            window.history.pushState(null, null, window.location.href);
            window.onpopstate = function() {
                window.history.pushState(null, null, window.location.href);
            };
        }
    </script>

</head>
<body>
  <div class="row justify-content-center mt-5">
    <div class="col-sm-4 shadow p-3">
      <h5 class="text-center">Escanear codigo QR</h5>
      <div class="row text-center">
        <a id="btn-scan-qr" href="#">
          <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg" class="img-fluid text-center" width="175">
        </a>
        <canvas hidden="" id="qr-canvas" class="img-fluid"></canvas>
      </div>
      <div class="row mx-5 my-3">
        <button class="btn btn-success btn-sm rounded-3 mb-2" onclick="encenderCamara()">Encender camara</button>
        <button class="btn btn-danger btn-sm rounded-3" onclick="cerrarCamara()">Detener camara</button>
        
      </div>
      <div class="row mx-5 my-3">
        <button class="btn btn-danger btn-sm rounded-2 mb-2" onclick="ejecutarFaltasPHP()">Cerrar clase</button>
      </div>
    </div>
  </div>
  <audio id="audioScaner" src="assets/sonido.mp3"></audio>
  <script src="assets/js/index.js"></script>
</body>
</html>