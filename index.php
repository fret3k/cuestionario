<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="stilos/styles_index.css">
    <title>Cuestionario PHQ-9</title>
</head>
<body>

    <a href="login/login.php" class="admin-button">Admin</a>

    <div class="container">
        <div class="title">
            CUESTIONARIO SOBRE SALUD PERSONAL-9<br>(PHQ-9)
        </div>
        <div class="description">
            El presente cuestionario tiene como objetivo<br>consultar respecto a tu salud personal.
        </div>

        <!-- Formulario para enviar el código -->
        <form action="c_index.php" method="post">
            <div class="input-group">
                <label for="codigo">Ingrese el código</label>
                <input type="text" id="codigo" name="codigo" required>
            </div>
            <button type="submit" class="submit-button">Iniciar</button>
        </form>

        <!-- Mensaje de error -->
        <?php if (isset($_GET['error']) && $_GET['error'] == '1'): ?>
            <div class="alert alert-danger mt-3">Código incorrecto. Inténtelo nuevamente.</div>
        <?php endif; ?>
    </div>

</body>
</html>
