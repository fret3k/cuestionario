<?php
$servidor = 'localhost'; // servidor de la base de datos
$usuario = 'root'; // usuario de la base de datos
$contraseña ='' ; // contraseña de la base de datos
$base_de_datos = 'dbquestionario'; // nombre de la base de datos


// Creamos la conexión a la base de datos utilizando la función mysqli_conexionect
$conn = mysqli_connect($servidor, $usuario, $contraseña, $base_de_datos);
if (!$conn) {
    die('Error de conexión: ' . mysqli_connect_error());
}

?>