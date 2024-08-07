<?php
require 'conexion.php';

if (isset($_POST['login'])) {
    $usuario = $_POST['nombre_user'];
    $contrasenia = $_POST['contrasenia'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE usuario = ? AND contrasenia = ?");
    $stmt->bind_param("ss", $usuario, $contrasenia);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $numero_registros = $resultado->num_rows;

    if ($numero_registros != 0) {
        header("location:administrador.html");
    } else {
        header("location:login.html");
    }

    $stmt->close();
    $conn->close();
}
?>
