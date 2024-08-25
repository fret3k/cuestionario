<?php
// Incluye tu archivo de conexión a la base de datos
require_once 'conexion.php'; // Asegúrate de que este archivo contiene la conexión correcta

//$idCliente = $_GET['idCliente']; // Obtén el idCliente desde la URL

// Consulta para obtener todos los datos del cliente y sus respuestas
$sql = "
    SELECT 
        c.apellido, 
        c.nombre, 
        c.numero_telefono, 
        c.fechaRegistro, 
        c.localidad, 
        r.pregunta1, 
        r.pregunta2, 
        r.pregunta3, 
        r.pregunta4, 
        r.pregunta5, 
        r.pregunta6, 
        r.pregunta7, 
        r.pregunta8, 
        r.pregunta9, 
        r.pregunta10, 
        r.pregunta11, 
        r.pregunta12, 
        r.pregunta13, 
        r.observaciones, 
        r.puntuacion, 
        r.encuestador 
    FROM 
        tcliente c 
    LEFT JOIN 
        trespuestascliente r ON c.idCliente = r.idCliente 
";

$result = $conn->query($sql);

// Verifica si la consulta fue exitosa
if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

// Crea un archivo CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Encueta_phq9.csv"');

// Imprime los encabezados, separados por punto y coma
echo "Nombre;Apellido;Número de Teléfono;Fecha de Registro;Localidad;Pregunta 1;Pregunta 2;Pregunta 3;Pregunta 4;Pregunta 5;Pregunta 6;Pregunta 7;Pregunta 8;Pregunta 9;Pregunta 10;Pregunta 11;Pregunta 12;Pregunta 13;Observaciones;Puntuación;Encuestador\n";

// Imprime los datos, separados por punto y coma
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo  
             $row['nombre'] . "; " . 
             $row['apellido'] . "; " . 
             $row['numero_telefono'] . "; " . 
             $row['fechaRegistro'] . "; " . 
             $row['localidad'] . "; " . 
             (isset($row['pregunta1']) ? $row['pregunta1'] : '') . "; " . 
             (isset($row['pregunta2']) ? $row['pregunta2'] : '') . "; " . 
             (isset($row['pregunta3']) ? $row['pregunta3'] : '') . "; " . 
             (isset($row['pregunta4']) ? $row['pregunta4'] : '') . "; " . 
             (isset($row['pregunta5']) ? $row['pregunta5'] : '') . "; " . 
             (isset($row['pregunta6']) ? $row['pregunta6'] : '') . "; " . 
             (isset($row['pregunta7']) ? $row['pregunta7'] : '') . "; " . 
             (isset($row['pregunta8']) ? $row['pregunta8'] : '') . "; " . 
             (isset($row['pregunta9']) ? $row['pregunta9'] : '') . "; " . 
             (isset($row['pregunta10']) ? $row['pregunta10'] : '') . "; " . 
             (isset($row['pregunta11']) ? $row['pregunta11'] : '') . "; " . 
             (isset($row['pregunta12']) ? $row['pregunta12'] : '') . "; " . 
             (isset($row['pregunta13']) ? $row['pregunta13'] : '') . "; " . 
             (isset($row['observaciones']) ? $row['observaciones'] : '') . "; " . 
             (isset($row['puntuacion']) ? $row['puntuacion'] : '') . "; " . 
             (isset($row['encuestador']) ? $row['encuestador'] : '') . "\n"; // Maneja respuestas nulas
    }
} else {
    echo "No hay datos disponibles.\n";
}

$conn->close();
exit;
?>
