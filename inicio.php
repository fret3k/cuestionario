<?php
//redireccion de administrador
//action="inicio.php" method="POST"
//header("location:login.html")

if (isset($_GET['destino'])) {
    $destino = $_GET['destino'];
    
    switch ($destino) {
        case 'login':
            header("Location: login/login.php");
            exit();
        case 'registro':
            header("Location: prueba.html");
            exit();
        default:
            // Manejo de caso no especificado
            break;
    }
}
?>