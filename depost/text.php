<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question_id = $_POST["question_id"];
    $is_active = $_POST["is_active"] ? 1 : 0;
    $sql = "UPDATE questions SET is_active = $is_active WHERE id = $question_id";
    if ($conn->query($sql) === TRUE) {
        echo "Estado del cuestionario actualizado correctamente.";
    } else {
        echo "Error al actualizar el estado: " . $conn->error;
    }
}

$sql = "SELECT * FROM questions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administración de Cuestionarios</title>
</head>
<body>
    <h1>Administración de Cuestionarios</h1>
    <form method="post" action="admin.php">
        <label for="question_id">Selecciona un cuestionario:</label>
        <select name="question_id" id="question_id">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["question_text"] . "</option>";
                }
            }
            ?>
        </select>
        <br>
        <label for="is_active">Activar:</label>
        <input type="checkbox" name="is_active" id="is_active" value="1">
        <br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>

<?php
$conn->close();
?>
