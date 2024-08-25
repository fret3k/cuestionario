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
    
    $Pregunta_1 = "1.¿Qué tan seguido has tenido poco interés o placer en hacer cosas?";
    $Pregunta_2 = "2.¿Te has sentido decaída, deprimida o sin esperanzas?";
    $Pregunta_3 = "3.¿Has tenido dificultades para lograr dormir o permanecer dormida o has dormido demasiado?";
    $Pregunta_4 = "4¿Te has sentido cansada o con poca energia?";
    $Pregunta_5 = "5.¿Has estado sin ganas de comer o has comido en exceso?";
    $Pregunta_6 = "6.¿Te has sentido mal contigo misma, o piensas que fracasaste o que has quedado mal contigo misma o con tu familia?";
    $Pregunta_7 = "7.¿Has tenido dificultades para concentrarte en algunas actividades, tales como leer o ver la televisión?";
    $Pregunta_8 = "8.¿Te has movido o hablado tan lento que otras personas podrían haberlo notado? ¿o por el contrario has estado muy inquieta o agitada, moviéndote mucho más de lo normal?";
    $Pregunta_9 = "9.¿Has tenido pensamientos como: estaría mejor muerta o has pensado en lastimarte de alguna manera?";
    $Pregunta_10 = "10.Si marcaste cualquiera de los problemas anteriores con un nivel mayor a 0 ¿Qué tanta dificultad te han ocasionado en tus quehaceres como: trabajo, tareas del hogar, o llevarte bien con otras personas?";
    $Pregunta_11 = "11.¿Cómo está tu estado de ánimo el día de hoy en la escala del 1 al 9?
";
    $Pregunta_12 = "12.¿Sufriste algún tipo de violencia?";
    $Pregunta_13 = "13.¿ Si la respuesta anterior fue SI, ¿de parte de quién?";

    // Filas siguientes: Preguntas y Respuestas
    echo "<tr><th>$Pregunta_1</th><td>" . $respuestas['pregunta1'] . "</td></tr>";
    echo "<tr><th>$Pregunta_2</th><td>" . $respuestas['pregunta2'] . "</td></tr>";
    echo "<tr><th>$Pregunta_3</th><td>" . $respuestas['pregunta3'] . "</td></tr>";
    echo "<tr><th>$Pregunta_4</th><td>" . $respuestas['pregunta4'] . "</td></tr>";
    echo "<tr><th>$Pregunta_5</th><td>" . $respuestas['pregunta5'] . "</td></tr>";
    echo "<tr><th>$Pregunta_6</th><td>" . $respuestas['pregunta6'] . "</td></tr>";
    echo "<tr><th>$Pregunta_7</th><td>" . $respuestas['pregunta7'] . "</td></tr>";
    echo "<tr><th>$Pregunta_8</th><td>" . $respuestas['pregunta8'] . "</td></tr>";
    echo "<tr><th>$Pregunta_9</th><td>" . $respuestas['pregunta9'] . "</td></tr>";
    echo "<tr><th>$Pregunta_10</th><td>" . $respuestas['pregunta10'] . "</td></tr>";
    echo "<tr><th>$Pregunta_11</th><td>" . $respuestas['pregunta11'] . "</td></tr>";
    echo "<tr><th>$Pregunta_12</th><td>" . $respuestas['pregunta12'] . "</td></tr>";
    echo "<tr><th>$Pregunta_13</th><td>" . $respuestas['pregunta13'] . "</td></tr>";
    echo "<tr><th>Observaciones</th><td>" . $respuestas['observaciones'] . "</td></tr>";
    echo "<tr><th>encuestador</th><td>" . $respuestas['encuestador'] . "</td></tr>";
    echo "</table>";
} else {
    echo "<p>No hay respuestas disponibles para este cliente.</p>";
}





$conn->close();
?>
