<?php
session_start();
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Conexión a la base de datos
    require_once 'conexion.php';

    // Obtener datos del formulario
    $nombre_user = $conn->real_escape_string($_POST['nombre_user']);
    $contrasenia = $conn->real_escape_string($_POST['contrasenia']);

    // Consulta para verificar usuario y rol
    $sql = "SELECT * FROM user WHERE user='$nombre_user' AND contrasenia='$contrasenia'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Datos de la fila
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['user'];
        $_SESSION['rol'] = $row['rol'];
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['codigo_acceso'] = $row['codigo_acceso'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['apellidos'] = $row['apellidos'];
        // Redirección según el rol
        if ($row['rol'] == 'administrador') {
            header("Location: administrador.php");
        } else {
            header("Location: usuario.php");
        }
        exit;
    } else {
        $error = true;
        header("Location: login.php?error=true");
        //header("Location: login");
    }

    $conn->close();
}
?>
