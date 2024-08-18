<?php
session_start(); 
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_user = $_POST['nombre_user'];
    $contrasenia = $_POST['contrasenia'];

    // Proteger contra inyección SQL
    $nombre_user = $conn->real_escape_string($nombre_user);
    $contrasenia = $conn->real_escape_string($contrasenia);

    // Consulta para verificar el usuario y obtener el rol
    $sql = "SELECT id_user, user, contrasenia, rol FROM user WHERE user = '$nombre_user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contrasenia, $row['contrasenia'])) {
            // Almacenar datos en la sesión
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['user'] = $row['user'];
            $_SESSION['rol'] = $row['rol'];

            // Redirigir según el rol
            if ($row['rol'] == 'administrador') {
                header("Location: administrador.html");
            } else {
                header("Location: prueba.html");
            }
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: login.php?error=true");
            exit();
        }
    } else {
        // Usuario no encontrado
        header("Location: login.php?error=false");
        exit();
    }
}

$conn->close();
?>
