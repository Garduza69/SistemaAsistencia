<?php
// Initialize the session
session_start();
/*
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}*/

// Agregamos la librería para generar códigos QR
require 'phpqrcode/qrlib.php';

// Include config file
require_once "conexion.php";

// Get the user's username from the session
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}

// Consulta para obtener el ID de usuario
$stmt = $pdo->prepare("SELECT idUsuario FROM usuario WHERE Email = :email");
$stmt->bindParam(":email", $email);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $userId = $row['idUsuario'];
} else {
    // No se encontró ningún usuario con el correo electrónico proporcionado
    // Manejar el error apropiadamente
}

// Generate a unique token for this user's QR code
$token = bin2hex(random_bytes(16)); // Generate a hexadecimal token of 16 bytes

// Guardar el token en la base de datos junto con el nombre de usuario

// Definir la consulta SQL para insertar en la tabla codigos_qr
$sql = "INSERT INTO codigos_qr (token, correo, id_usuario) VALUES (?, ?, ?)";

// Preparar la consulta
$stmt_insert = $pdo->prepare($sql);

// Vincular los parámetros y ejecutar la consulta
$stmt_insert->bindParam(1, $token, PDO::PARAM_STR);
$stmt_insert->bindParam(2, $email, PDO::PARAM_STR);
$stmt_insert->bindParam(3, $userId, PDO::PARAM_INT); // Asumiendo que $userId contiene el ID de usuario obtenido anteriormente

// Ejecutar la consulta
$stmt_insert->execute();
// Cerrar el statement
$stmt_insert = null;

// Declaramos una carpeta temporal para guardar la imágenes generadas
$dir = 'temp/';

// Si no existe la carpeta la creamos
if (!file_exists($dir))
    mkdir($dir);

// Declaramos la ruta y nombre del archivo a generar
$filename = $dir . 'test' . $token . '.png';

// Parámetros de Configuración
$tamanio = 10; // Tamaño de Pixel
$level = 'L'; // Precisión Baja
$framSize = 3; // Tamaño en blanco

// Enviamos los parámetros a la Función para generar código QR 
QRcode::png($token, $filename, $level, $tamanio, $framSize);

// Retornar la ruta del archivo generado
echo $filename;
?>
