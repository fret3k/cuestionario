<?php


// Llamar a la conexión
require 'conexion.php';
require 'registrar.php';

//clave unica
function generarClaveUnica1() {
    $bytesAleatorios = bin2hex(random_bytes(16));
    $idUnica = uniqid();
    $claveUnica = $idUnica . $bytesAleatorios;
    
    return $claveUnica;
}
// Capturar el idCliente desde la URL
//$idCliente = $_GET['idClientes'];

// Obtener datos del formulario
//$idCliente = '66a32dc84a9e67b3087f0cf66f3956dc';
$idCuestionario = generarClaveUnica1();
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
echo 'el id es :';
echo $idenviado;
// Consulta SQL para insertar datos en la nueva tabla
$sql = "INSERT INTO trespuestascliente 
        VALUES ('$idCuestionario', '$q1', '$q2', '$q3'
        , '$q4', '$q5', '$q6', '$q7', '$q8', '$q9', '$q10',
         '$q11', '$q12', '$q13', '$q14', '$puntuacion', '$idenviado')";

if ($conn->query($sql) === TRUE) {
    echo "Datos registrados exitosamente en la nueva tabla.";
} else {
    echo "Error al insertar datos en la nueva tabla: " . $conn->error;
}

$conn->close();
?>
