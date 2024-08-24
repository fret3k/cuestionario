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

// Crea un archivo Excel
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="exportar_cliente.xls"');

// Imprime los encabezados
echo "tApellido\tNombre\tNúmero de Teléfono\tFecha de Registro\tLocalidad\tPregunta 1\tPregunta 2\tPregunta 3\tPregunta 4\tPregunta 5\tPregunta 6\tPregunta 7\tPregunta 8\tPregunta 9\tPregunta 10\tPregunta 11\tPregunta 12\tPregunta 13\tObservaciones\tPuntuación\tEncuestador\n";

// Imprime los datos
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo  
             $row['apellido'] . "\t" . 
             $row['nombre'] . "\t" . 
             $row['numero_telefono'] . "\t" . 
             $row['fechaRegistro'] . "\t" . 
             $row['localidad'] . "\t" . 
             (isset($row['pregunta1']) ? $row['pregunta1'] : '') . "\t" . 
             (isset($row['pregunta2']) ? $row['pregunta2'] : '') . "\t" . 
             (isset($row['pregunta3']) ? $row['pregunta3'] : '') . "\t" . 
             (isset($row['pregunta4']) ? $row['pregunta4'] : '') . "\t" . 
             (isset($row['pregunta5']) ? $row['pregunta5'] : '') . "\t" . 
             (isset($row['pregunta6']) ? $row['pregunta6'] : '') . "\t" . 
             (isset($row['pregunta7']) ? $row['pregunta7'] : '') . "\t" . 
             (isset($row['pregunta8']) ? $row['pregunta8'] : '') . "\t" . 
             (isset($row['pregunta9']) ? $row['pregunta9'] : '') . "\t" . 
             (isset($row['pregunta10']) ? $row['pregunta10'] : '') . "\t" . 
             (isset($row['pregunta11']) ? $row['pregunta11'] : '') . "\t" . 
             (isset($row['pregunta12']) ? $row['pregunta12'] : '') . "\t" . 
             (isset($row['pregunta13']) ? $row['pregunta13'] : '') . "\t" . 
             (isset($row['observaciones']) ? $row['observaciones'] : '') . "\t" . 
             (isset($row['puntuacion']) ? $row['puntuacion'] : '') . "\t" . 
             (isset($row['encuestador']) ? $row['encuestador'] : '') . "\n"; // Maneja respuestas nulas
    }
} else {
    echo "No hay datos disponibles.\n";
}

$conn->close();
exit;
?>


