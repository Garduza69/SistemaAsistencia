<?php
require_once 'vendor/autoload.php';

$clientID = '836660401451-fjm2ab434pvjbbusp700udsd0srne8q1.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/25-Navegacion_Fija/autentificacion.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Configuración de la conexión PDO a la base de datos
$host = 'localhost';
$dbname = 'sotavento'; // Nombre de tu base de datos
$username = 'root'; // Nombre de usuario de la base de datos
$password = ''; // Contraseña de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configuración de PDO para manejar errores y excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>
