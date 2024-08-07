<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $q1 = $_POST['q1'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=dbquestionario', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare('INSERT INTO tclientes (nombre, apellido, telefono, q1) VALUES (:nombre, :apellido, :telefono, :q1)');
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':telefono' => $telefono,
            ':q1' => $q1
            // Agrega más parámetros para cada pregunta del cuestionario
        ]);

        echo "Registro exitoso";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
