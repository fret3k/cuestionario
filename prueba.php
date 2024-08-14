
<?php
// Asegúrate de tener los datos disponibles

require 'conexion.php';
function generarClaveUnica1() {
    $bytesAleatorios = bin2hex(random_bytes(16));
    $idUnica = uniqid();
    $claveUnica = $idUnica . $bytesAleatorios;
    
    return $claveUnica;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $idCliente = generarClaveUnica1();
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $nombre_grupo = 'C0001';
    $fechaRegistro = date("Y-m-d ");
    $localidad = 'cuzco';

  // Validar nombre
  // Validar nombre
    if (empty($nombre)) {
        die("El nombre es requerido.");
    }

    // Validar apellido
    if (empty($apellido)) {
        die("El apellido es requerido.");
    }

    // Validar teléfono (debe ser un número válido, opcionalmente puedes agregar más validaciones)
    if (!preg_match("/^[0-9]{9}$/", $telefono)) {
        die("El teléfono debe contener 9 dígitos numéricos.");
    }

}
    //clave unica
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
$q13 = $_POST['q13'];
$q14 = $_POST['q14'];
$puntuacion = $q1+$q2+$q3+$q4+$q5+$q6+$q7+$q8+$q9+$q10;
echo 'el id es :';

// Consulta SQL para insertar datos en la nueva tabla
$sql = "INSERT INTO tcliente  VALUES 
('$idCliente','$nombre', '$apellido', '$telefono','$nombre_grupo','$fechaRegistro','$localidad')";


$sql1 = "INSERT INTO trespuestascliente 
        VALUES ('$idCuestionario', '$q1', '$q2', '$q3'
        , '$q4', '$q5', '$q6', '$q7', '$q8', '$q9', '$q10',
        '$q11', '$q12', '$q13', '$q14', '$puntuacion', '$idCliente')";

if ($conn->query($sql) === TRUE) {
    echo "Datos registrados exitosamente en la nueva tabla.";
} else {
    echo "Error al insertar datos en la nueva tabla: " . $conn->error;
}
if ($conn->query($sql1) === TRUE) {
    echo "Datos registrados exitosamente en la nueva tabla.";
    echo "Registro exitoso";
    header("Location: index.html");
} else {
    echo "Error al insertar datos en la nueva tabla: " . $conn->error;
}

?>
