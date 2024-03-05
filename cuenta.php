<?php
session_start();

// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Verifica si hay un correo electrónico enviado desde verificar_usuario.php
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Llama a la función para verificar el tipo de usuario y redirige según el tipo
    redirigir_según_tipo($email, $pdo); // Pasamos la conexión como argumento
} else {
    echo "No se proporcionó un correo electrónico.";
}

// Función para verificar el tipo de usuario en la base de datos y redirigir
function redirigir_según_tipo($email, $conn) {
    // Query para consultar el tipo de usuario basado en el correo electrónico
    $query = "SELECT id_perfil FROM usuario WHERE email = :email";
    
    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Bind de parámetros
    $stmt->bindParam(':email', $email);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Si se encontró el correo en la tabla registros, obtenemos el tipo de usuario
        $tipo_usuario = $row['id_perfil'];

        // Redirigir según el tipo de usuario
        switch ($tipo_usuario) {
            case 1:
                header("Location: docente.html");
                exit();
                break;
            case 2:
                header("Location: alumno.html");
                exit();
                break;
            case 3:
                header("Location: administrativo.html");
                exit();
                break;
            case 4:
                header("Location: director_fac.html");
                exit();
                break;
            default:
                echo "Tipo de usuario desconocido";
                break;
        }
    } else {
        // Si no se encontró el correo en la tabla registros
        echo "Correo no registrado";
    }
}
?>

