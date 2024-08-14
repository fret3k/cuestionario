<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../stilos/styles_login.css">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <!-- Contenedor para el mensaje de error -->
        <?php if (isset($_GET['error']) && $_GET['error'] == 'true'): ?>
        <div id="error-message" class="alert alert-danger">
          <strong>Error:</strong> Nombre de usuario o contraseña incorrectos.
        </div>
        <?php endif; ?>
        <!-- Formulario de inicio de sesión -->
        <form action="login_controller.php" method="POST">
          <h2 class="mt-5 mb-4">Iniciar sesión</h2>
          <!-- Campo de entrada para el nombre de usuario -->
          <div class="form-group">
            <input type="text" class="form-control" name="nombre_user" placeholder="Nombre de usuario" required>
          </div>
          <!-- Campo de entrada para la contraseña -->
          <div class="form-group">
            <input type="password" class="form-control" name="contrasenia" placeholder="Contraseña" required>
          </div>
          <!-- Botón para enviar el formulario -->
          <button type="submit" class="btn btn-primary" name="login">Iniciar sesión</button>
        </form>
      </div>
      <!-- Columna para la imagen -->
      <div class="col-md-6 col-lg-4 d-none d-md-block">
        <img src="../img/1_img.png" alt="segurt" class="img-fluid">
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
