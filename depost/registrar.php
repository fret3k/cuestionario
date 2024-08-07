<?php
require 'conexion.php';

//clave unica
function generarClaveUnica() {
    $bytesAleatorios = bin2hex(random_bytes(16));
    $idUnica = uniqid();
    $claveUnica = $idUnica . $bytesAleatorios;
    
    return $claveUnica;
}
// Obtener datos del formulario
$idCliente=generarClaveUnica();
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$nombre_grupo = 'q00011';
$fechaRegistro =date('y-m-d');

$idCuestionario = generarClaveUnica();
$q1 = $_POST['q1'];
$q2 = $_POST['q2'];
$q3 = $_POST['q3'];
$q4 = $_POST['q4'];
$q5 = $_POST['q5'];
$q6 = $_POST['q6'];
$q7 = $_POST['q7'];
$q8 = $_POST['q8'];
$q9 = $_POST['q9'];
$q10 = $_POST['q10'];
$q11 = $_POST['q11'];
$q12 = $_POST['q12'];
$q13 = 'asasc';
$q14 = 'szdv';
$puntuacion = 1477;
/*
if (empty($nombre)) {
    die("El nombre es  requerido.");
}
if (empty($apellido)) {
    die("El apellido es  requerido.");
}
if (empty($telefono)) {
    die("El telefono es  requerido.");
}   */

// Consulta SQL para insertar datos
$sql = "INSERT INTO tcliente  VALUES 
('$idCliente','$nombre', '$apellido', '$telefono','$nombre_grupo','$fechaRegistro')";

$sql1 = "INSERT INTO trespuestascliente 
        VALUES ('$idCuestionario', '$q1', '$q2', '$q3'
        , '$q4', '$q5', '$q6', '$q7', '$q8', '$q9', '$q10',
         '$q11', '$q12', '$q13', '$q14', '$puntuacion', '$idCliente')";

if ($conn->query($sql) === TRUE and $conn->query($sql1) === TRUE) {
    //$idenviado=$idCliente;
    echo "Registro exitoso";
  header("Location: cuestionario.html");
  // header("Location: cuestionario.html?idClientes=$idCliente");
  
} else {
    echo "Error el la conexion a la base de datos: ";
}

$conn->close();





?>