<?php
// Conexión a la base de datos
require_once 'conexion.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el idCliente desde la solicitud GET
$idCliente = $_GET['idCliente'];

// Consulta SQL para obtener los detalles del cliente y sus respuestas
$sql_cliente = "SELECT apellido, nombre FROM tcliente WHERE idCliente = '$idCliente'";
$result_cliente = $conn->query($sql_cliente);

$sql_respuestas = "SELECT * FROM trespuestascliente WHERE idCliente = '$idCliente'";
$result_respuestas = $conn->query($sql_respuestas);

// Generar la tabla HTML para mostrar los detalles y respuestas
if ($result_cliente->num_rows > 0 && $result_respuestas->num_rows > 0) {
    $cliente = $result_cliente->fetch_assoc();
    $respuestas = $result_respuestas->fetch_assoc();

    echo "<table class='table table-bordered'>";
    
    // Primera fila: Nombre y Apellido
    echo "<tr><th>Nombre y Apellido</th><td>" . $cliente['nombre'] . " " . $cliente['apellido'] . "</td></tr>";
    
    // Segunda fila: Puntuación
    echo "<tr><th>Puntuación</th><td>" . $respuestas['puntuacion'] . "</td></tr>";
    
    // Filas siguientes: Preguntas y Respuestas
    echo "<tr><th>Pregunta 1</th><td>" . $respuestas['pregunta1'] . "</td></tr>";
    echo "<tr><th>Pregunta 2</th><td>" . $respuestas['pregunta2'] . "</td></tr>";
    echo "<tr><th>Pregunta 3</th><td>" . $respuestas['pregunta3'] . "</td></tr>";
    echo "<tr><th>Pregunta 4</th><td>" . $respuestas['pregunta4'] . "</td></tr>";
    echo "<tr><th>Pregunta 5</th><td>" . $respuestas['pregunta5'] . "</td></tr>";
    echo "<tr><th>Pregunta 6</th><td>" . $respuestas['pregunta6'] . "</td></tr>";
    echo "<tr><th>Pregunta 7</th><td>" . $respuestas['pregunta7'] . "</td></tr>";
    echo "<tr><th>Pregunta 8</th><td>" . $respuestas['pregunta8'] . "</td></tr>";
    echo "<tr><th>Pregunta 9</th><td>" . $respuestas['pregunta9'] . "</td></tr>";
    echo "<tr><th>Pregunta 10</th><td>" . $respuestas['pregunta10'] . "</td></tr>";
    echo "<tr><th>Pregunta 11</th><td>" . $respuestas['pregunta11'] . "</td></tr>";
    echo "<tr><th>Pregunta 12</th><td>" . $respuestas['pregunta12'] . "</td></tr>";
    echo "<tr><th>Pregunta 13</th><td>" . $respuestas['pregunta13'] . "</td></tr>";
    echo "<tr><th>Observaciones</th><td>" . $respuestas['observaciones'] . "</td></tr>";
    echo "<tr><th>encuestador</th><td>" . $respuestas['encuestador'] . "</td></tr>";
    echo "</table>";
} else {
    echo "<p>No hay respuestas disponibles para este cliente.</p>";
}

$conn->close();
?>
