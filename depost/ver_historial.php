<?php
header('Content-Type: application/json');

// Mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = [];

$servidor = 'localhost'; // servidor de la base de datos
$usuario = 'root'; // usuario de la base de datos
$contraseña ='' ; // contraseña de la base de datos
$base_de_datos = 'dbquestionario'; // nombre de la base de datos
// Crear conexión
$conn = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

// Verificar conexión
if ($conn->connect_error) {
    $response['error'] = "Conexión fallida: " . $conn->connect_error;
    echo json_encode($response);
    exit();
}

$idCliente = isset($_GET['idCliente']) ? $_GET['idCliente'] : null;

if ($idCliente) {
    // Consulta SQL para obtener los detalles del historial
    $sql = "SELECT * FROM trespuestascliente WHERE idcliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idCliente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $historial = [];
        while ($row = $result->fetch_assoc()) {
            $historial[] = $row;
        }
        echo json_encode($historial);
    } else {
        echo json_encode([]);
    }
    $stmt->close();
} else {
    $response['error'] = "ID Cliente no proporcionado";
    echo json_encode($response);
}

$conn->close();
?>
