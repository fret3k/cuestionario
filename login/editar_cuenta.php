<?php
session_start();
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $localidad = $_POST['localidad'];

    // Validar si el usuario tiene permiso
    if ($_SESSION['rol'] !== 'administrador') {
        header("Location: login.php");
        exit;
    }

    // Actualizar en la base de datos
    $sql = "UPDATE dbquestionario SET nombre=?, apellidos=?, telefono=?, localidad=? WHERE id_user=?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $nombre, $apellido, $telefono, $localidad, $userId);

        if (mysqli_stmt_execute($stmt)) {
            echo "Usuario actualizado correctamente.";
        } else {
            echo "Error al actualizar el usuario: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: crud_usuario.php"); // Redirigir después de la actualización
}
?>

