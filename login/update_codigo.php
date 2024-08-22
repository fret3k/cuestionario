<?php
session_start();
// Asegúrate de que el usuario esté autenticado y la sesión esté activa
if (!isset($_SESSION['codigo_acceso'])) {
    die('Acceso no autorizado.');
}

// Obtener los valores del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_code = trim($_POST['new_code']);
    $current_code = $_SESSION['codigo_acceso'];

    // Validación simple
    if (empty($new_code)) {
        die('El código no puede estar vacío.');
    }

    require_once 'conexion.php';

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
// Preparar la consulta para actualizar el código
$stmt = $conn->prepare("UPDATE user SET codigo_acceso = ? WHERE codigo_acceso = ?");
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("ss", $new_code, $current_code);

if ($stmt->execute()) {
    header("Location: administrador.php");
    // Actualizar el código en la sesión
    $_SESSION['codigo_acceso'] = $new_code;
} else {
    echo "Error al actualizar el código: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
} else {
die('Solicitud no válida.');
}
?>
