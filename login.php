



<?php
session_start();


$servidor = 'localhost'; // servidor de la base de datos
$usuarios = 'root'; // usuario de la base de datos
$contrasenias ='' ; // contraseña de la base de datos
$base_de_datos = 'dbquestionario'; // nombre de la base de da

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['nombre_user'];
    $contrasenia = $_POST['contrasenia'];

    // Preparar la consulta
    $sql = "SELECT contrasenia FROM user WHERE nombre_user = ?";
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación falló
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hash);
        $stmt->fetch();

        // Verificar la contraseña (descomentado cuando uses hash en lugar de texto plano)
        // if (password_verify($contrasenia, $hash)) {
        if ($contrasenia === $hash) { // Cambia esto por `password_verify($contrasenia, $hash)` para usar hashing
            // Iniciar sesión y redirigir a welcome.php
            $_SESSION['usuario'] = $usuario;
            header('Location: administrador.html');
            exit();
        } else {
            // Credenciales inválidas, redirigir con mensaje de error
            header('Location: prueba.html');
            exit();
        }
    } else {
        // Usuario no encontrado, redirigir con mensaje de error
        header('Location: prueba.html');
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
<!--  
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
        //header("location:login.html");
        echo "<div class ='alert alert-danger'>El usuario no existe</div>";
    }

    $stmt->close();
    $conn->close();
}
  -->
