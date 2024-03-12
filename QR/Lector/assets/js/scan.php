<?php
// Configuración de la base de datos
$servername = "localhost"; // Cambia localhost por el servidor de tu base de datos
$username = "root"; // Cambia tu_usuario por el nombre de usuario de tu base de datos
$password = ""; // Cambia tu_contraseña por la contraseña de tu base de datos
$dbname = "lector"; // Cambia login por el nombre de tu base de datos

// Obtener el token del parámetro GET
if(isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    // Si no se proporciona un token, se devuelve un error
    echo "error";
    exit;
}

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Preparar la consulta SQL para insertar el token en la tabla token
$sql = "INSERT INTO token (valor) VALUES ('$token')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    // Si la inserción se realizó con éxito, se devuelve 'success'
    echo "success";
} else {
    // Si ocurrió un error al insertar, se devuelve 'error'
    echo "error";
}

// Cerrar la conexión
$conn->close();
?>

