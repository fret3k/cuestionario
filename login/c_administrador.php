<?php
// Conexión a la base de datos
require_once 'conexion.php';

$sql = "SELECT idCliente, apellido, nombre, numero_telefono, localidad, fechaRegistro FROM tcliente ORDER BY idCliente DESC";
$result = $conn->query($sql);

// Generar las filas de la tabla
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['apellido'] . "</td>";
        echo "<td>" . $row['numero_telefono'] . "</td>";
        echo "<td>" . $row['localidad'] . "</td>";
        echo "<td>" . $row['fechaRegistro'] . "</td>";
        echo "<td><button onclick='verHistorial(\"" . $row['idCliente'] . "\")' class='btn btn-primary'>Ver Historial</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No hay registros disponibles</td></tr>";
}

$conn->close();
?>
