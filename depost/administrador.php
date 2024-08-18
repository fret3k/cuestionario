<?php
header('Content-Type: application/json');

// Mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = [];

$servidor = 'localhost'; // servidor de la base de datos
$usuario = 'root'; // usuario de la base de datos
$contrasenia ='' ; // contraseña de la base de datos
$base_de_datos = 'dbquestionario'; // nombre de la base de datos

// Crear conexión
$conn = new mysqli($servidor, $usuario, $contrasenia, $base_de_datos);


// Verificar conexión
if ($conn->connect_error) {
    $response['error'] = "Conexión fallida: " . $conn->connect_error;
    echo json_encode($response);
    exit();
}

// Consulta SQL
$sql = "SELECT idcliente,nombre, apellido, numero_telefono FROM tcliente";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode([]);
}
$conn->close();
?>
