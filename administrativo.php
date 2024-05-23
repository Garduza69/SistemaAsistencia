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
  <meta charset="utf-8">
  <title>Universidad de Sotavento</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/logoUS.png" rel="icon">
  <link href="img/logoUS.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Custom Stylesheet for Logo -->
  <style>
#logo h1 a {
  display: inline-block;
  width: 150px; /* Nueva anchura */
  height: 70px; /* Nueva altura */
  background-image: url('img/sotavento.png');
  background-size: contain; /* O ajusta según tu preferencia */
  background-repeat: no-repeat;
  text-indent: -9999px;
}
  </style>

  <!-- =======================================================
    Theme Name: Avilon
    Theme URL: https://bootstrapmade.com/avilon-bootstrap-landing-page-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->

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

    <h1 id="welcome-message"></h1>
    <h2>Menú</h2>
    <ul>
        <a class="btn" href="reportes/peefilAdmin.html">Generar Reporte</a>
        <br>
        <br>
        <button class="btn" onclick="consulta()">Consulta</button>
        <br>
        <br>
        <button class="btn" onclick="notificaciones()">Notificaciones</button>
        <br>
    </ul>


  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

        <div id="logo" class="pull-left">
          <h1><a href="#intro" class="scrollto">Universidad de Sotavento</a></h1>
        </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Inicio</a></li>
          <li class="menu-has-children"><a href="">Asistencia</a>
            <ul>
              <li class="menu-has-children"><a>Consultar Listas</a>
                <ul>
                  <li><a href="reportes/MateriasAdmin.php">Listas por Materia</a></li>
                  <li><a href="reportes/Facultades.php">Listas por Facultad</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#contact">Contacto</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">

    <div class="intro-text">
      <h2 id="welcome-message"></h2>
      <a href="#about" class="btn-get-started scrollto">Acércate a la Universidad de Sotavento</a>
    </div>

    <div class="product-screens">

      <div class="product-screen-1 wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="0.6s">
        <img src="reportes/img/noticia1.png" alt="">
      </div>

      <div class="product-screen-2 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="0.6s">
        <img src="reportes/img/noticia2.png" alt="">
      </div>

      <div class="product-screen-3 wow fadeInUp" data-wow-duration="0.6s">
        <img src="reportes/img/noticia3.png" alt="">
      </div>

    </div>

  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about" class="section-bg">
      <div class="container-fluid">
        <div class="section-header">
          <h3 class="section-title">Dra Rosa Rodríguez Caamaño como nueva Rectora</h3>
          <span class="section-divider"></span>
          <p class="section-description">
            Coatzacoalcos, Ver. – El rector de la Universidad de Sotavento, Juan Manuel Rodríguez García, anunció hoy como su sucesora a la Dra. Rosa Aurora Rodríguez Caamaño, <br>al iniciar la celebración del 30 aniversario de fundación de la institución.
            </p>
        </div>

        <div class="row">
          <div class="col-lg-6 about-img wow fadeInLeft">
            <img src="img/rector.jpg" alt="">
          </div>

          <div class="col-lg-6 content wow fadeInRight">
            <h2>Inicia celebración de los 30 años de fundación de la US, con placa conmemorativa, cápsula del tiempo, medallas a fundadores, exposición pictórica y conferencia magistral</h2>
            <h3></h3>
            <p>
              Rodríguez García expresó que la directora de Posgrados e Investigación, Rodríguez Caamaño, asumirá oficialmente este cargo en los próximos días. La nueva Rectora tiene 25 años colaborando en la dirección de la US, y es Licenciada en Contaduría por el Tecnológico de Monterrey, Máster en Administración de Empresas por la UNAM y Doctora en Administración y Gestión Empresarial por la Universidad Istmo Americana.
            </p>

          </div>
        </div>

      </div>
    </section><!-- #about -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">

  </footer><!-- #footer -->


<!-- JavaScript Libraries -->
<script>
    window.onload = function() {
        // Hacer una solicitud AJAX para verificar la autenticación del usuario
        var xhttpAuth = new XMLHttpRequest();
        xhttpAuth.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var respuesta = JSON.parse(this.responseText);
                if (respuesta.autenticado) {
                    // Si el usuario está autenticado, hacer una solicitud AJAX para obtener el mensaje de bienvenida
                    var xhttpMensaje = new XMLHttpRequest();
                    xhttpMensaje.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("welcome-message").innerHTML = this.responseText;
                        }
                    };
                    xhttpMensaje.open("GET", "../ob_nombre.php", true);
                    xhttpMensaje.send();
                } else {
                    // Si el usuario no está autenticado, redirigirlo a la página de inicio de sesión u otra página apropiada
                    window.location.href = "pagina_de_inicio.php";
                }
            }
        };
        xhttpAuth.open("GET", "verificar_autenticacion.php", true);
        xhttpAuth.send();
    };
</script>
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/magnific-popup/magnific-popup.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>
</html>