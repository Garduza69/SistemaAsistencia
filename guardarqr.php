<?php
// Conectar a la base de datos (asegúrate de cambiar estos valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sotavento";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

// Obtener los datos del formulario
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$fecha_hora = isset($_POST["fecha_hora"]) ? $_POST["fecha_hora"] : '';
$materia = isset($_POST["materia"]) ? $_POST["materia"] : '';


// Generar el token para el código QR (puedes usar alguna biblioteca de PHP para generar el código QR)
$token = uniqid();

// Insertar la información en la tabla codigos_qr
$sql = "INSERT INTO codigos_qr (token, correo) VALUES ('$token', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Registro del código QR creado correctamente.<br>";
} else {
    echo "Error al crear el registro del código QR: " . $conn->error . "<br>";
}

// Obtener el ID del último registro insertado
$id_codigo = $conn->insert_id;

// Insertar la información de asistencia en la tabla asistencia
// Aquí deberías tener el ID del usuario desde algún lugar (por ejemplo, una variable de sesión)
$id_usuario = 1; // Cambiar esto según la lógica de tu aplicación

// Verificar si la materia es "Técnicas de calidad en software" y asignar el ID correspondiente
if ($materia == "arquitectura de computadoras") {
    $id_materia = 1001;
} else {
    // Si no es "Técnicas de calidad en software", obtener el ID de la tabla materias
    $sql_materia = "SELECT id_materia FROM materias WHERE nombre_materia = '$materia'";
    $result_materia = $conn->query($sql_materia);
    if ($result_materia->num_rows > 0) {
        $row = $result_materia->fetch_assoc();
        $id_materia = $row["id_materia"];
    } else {
        echo "Error: La materia seleccionada no existe.<br>";
        exit();
    }
}

$sql = "INSERT INTO asistencia (Id_materia, Id_usuario) VALUES ('$id_materia', '$id_usuario')";

if ($conn->query($sql) === TRUE) {
    echo "Registro de asistencia creado correctamente.<br>";
} else {
    echo "Error al crear el registro de asistencia: " . $conn->error . "<br>";
}

// Cerrar la conexión
$conn->close();
?>
