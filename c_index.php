<?php
require_once 'conexion.php';
//require 'conexion.php';

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
$codigo_ingresado = isset($_POST['codigo']) ? $_POST['codigo'] : '';

$sql = "SELECT 1 FROM user WHERE codigo_acceso = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Error al preparar la consulta: ' . $conn->error);
}
$stmt->bind_param('s', $codigo_ingresado);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    header("Location: inicio.html");
} else {
    header("Location: index.php?error=1");
}
exit(); 
$stmt->close();
$conn->close();
?>