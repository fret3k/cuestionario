<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['rol'] !== 'administrador') {
   
    header("Location: login.php");
    exit;
}
require_once 'conexion.php';
// Obtener usuarios
$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);
$usuarios = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../stilos/adminstyles.css">
    

</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutters">
            <nav class="col-md-3 col-lg-2 sidebar">
                <div class="sidebar-sticky">
                    <h3 class="sidebar-title">ADMIN</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <h4>Inicio</h4>
                        <li class="nav-item">
                            <a class="nav-link" href="administrador.php">
                                <i class="fas fa-list"></i>
                                Mostrar datos
                            </a>
                        </li>
                        <h4>Usuarios</h4>
                        <li class="nav-item">
                            <a class="nav-link" href="crud_usuario.php">
                                <i class="fas fa-users"></i>
                                Mostrar
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 col-lg-10 main-content">
              
            <div class="header d-flex justify-content-between align-items-center">
                    <h1></h1>
                    <div class="user-info">
                        <i  ><?php echo $_SESSION['username'] ."  ".$_SESSION['id_user']; ?> </i>
                        <a class=" fas fa-user-times ml-3 hover-dark" href="cerrar_secion.php">Salir </a>
                        <a class=" fas fa-user ml-4 hover-dark" href="crud_usuario.php">Editar Cuenta </a>
                    </div>
                </div>

            
            <body>
    <div class="container mt-5">
        <h2> Usuarios</h2>

        <!-- Create User Form -->
       <!-- Formulario para crear usuario -->
       <form method="POST" action="crud_usuario.php" class="mb-4">
            <input type="hidden" name="id_user" value="<?= isset($editUser) ? $editUser['id_user'] : '' ?>">
            <div class="form-group">
                <label for="user">Usuario</label>
                <input type="text" name="user" class="form-control" value="<?= isset($editUser) ? $editUser['user'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="contrasenia">Contraseña</label>
                <input type="password" name="contrasenia" class="form-control" <?= isset($editUser) ? 'placeholder="Dejar en blanco si no desea cambiarla"' : 'required' ?>>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= isset($editUser) ? $editUser['nombre'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" value="<?= isset($editUser) ? $editUser['apellidos'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <input type="text" name="rol" class="form-control" value="<?= isset($editUser) ? $editUser['rol'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="codigo_acceso">Código de Acceso</label>
                <input type="text" name="codigo_acceso" class="form-control" value="<?= isset($editUser) ? $editUser['codigo_acceso'] : '' ?>" required>
            </div>
            <button type="submit" name="<?= isset($editUser) ? 'update' : 'create' ?>" class="btn btn-primary">
                <?= isset($editUser) ? 'Actualizar' : 'Crear' ?> Usuario
            </button>
        </form>

         <!-- Tabla de usuarios -->
         <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Rol</th>
                    <th>Código de Acceso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($usuarios) && count($usuarios) > 0): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['id_user'] ?></td>
                            <td><?= $usuario['user'] ?></td>
                            <td><?= $usuario['nombre'] ?></td>
                            <td><?= $usuario['apellidos'] ?></td>
                            <td><?= $usuario['rol'] ?></td>
                            <td><?= $usuario['codigo_acceso'] ?></td>
                            <td>
                                <form method="POST" action="crud_usuario.php" style="display:inline;">
                                    <input type="hidden" name="id_user" value="<?= $usuario['id_user'] ?>">
                                    <button type="submit" name="delete" class="btn btn-danger">Eliminar</button>
                                </form>
                                <form method="POST" action="mostrar_usuarios.php" style="display:inline;">
                                    <input type="hidden" name="id_user" value="<?= $usuario['id_user'] ?>">
                                    <button type="submit" name="edit" class="btn btn-warning">Editar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No se encontraron usuarios.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

            </main>
        </div>
    </div>
</body>

</html>



