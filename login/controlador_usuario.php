<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: login.php");
    exit;
}
require_once 'conexion.php';
// Insertar nuevo usuario
if (isset($_POST['create'])) {
    $usuario = $_POST['user'];
    $contrasenia = password_hash($_POST['contrasenia'], PASSWORD_DEFAULT);
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $rol = $_POST['rol'];
    $codigo_acceso = $_POST['codigo_acceso'];

    // Preparar la consulta
    $sql = "INSERT INTO user (id_user user, contrasenia, nombre, apellidos, rol, codigo_acceso) 
            VALUES (?,?, ?, ?, ?, ?, ?)";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 'issssss',null,  $usuario, $contrasenia, $nombre, $apellidos, $rol, $codigo_acceso);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: mostrar_usuarios.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Actualizar usuario
if (isset($_POST['update'])) {
    $id_user = $_POST['id_user'];
    $usuario = $_POST['user'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $rol = $_POST['rol'];
    $codigo_acceso = $_POST['codigo_acceso'];

    // Preparar la consulta
    $sql = "UPDATE user SET user = ?, nombre = ?, apellidos = ?, rol = ?, codigo_acceso = ? 
            WHERE id = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 'isssss',$id_user, $usuario, $nombre, $apellidos, $rol, $codigo_acceso);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: mostrar_usuarios.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Eliminar usuario
if (isset($_POST['delete'])) {
    $id_user = $_POST['id_user'];

    // Preparar la consulta
    $sql = "DELETE FROM user WHERE id = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $id_user);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: mostrar_usuarios.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Cerrar conexión
mysqli_close($conn);
?>
