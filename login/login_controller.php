<?php
include('../conexion.php'); // Incluye la configuración de la base de datos
include('login.php'); // Incluye el archivo que inicia la sesión

function authenticate_user($username, $password) {
    global $conn;
    
    $sql = "SELECT * FROM `user` WHERE `user` = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['contrasenia'])) {
                return $user; // Autenticación exitosa
            }
        }
        return false; // Autenticación fallida
    }
    return false;
}

function handle_login($username, $password) {
    $user = authenticate_user($username, $password);
    
    if ($user) {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['user'] = $user['user'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['apellidos'] = $user['apellidos'];
        $_SESSION['rol'] = $user['rol'];
        
        header("Location: welcome.php");
        exit;
    } else {
        return "Nombre de usuario o contraseña incorrectos.";
    }
}

function check_role($required_role) {
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== $required_role) {
        header("Location: login.php");
        exit;
    }
}
?>
