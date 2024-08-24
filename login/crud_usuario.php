<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: login.php");
    exit;
}

require_once 'conexion.php';

$successMessage = "";

// Manejo de acciones de formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        // Crear nuevo usuario
        $user = $_POST['user'];
        $contrasenia = $_POST['contrasenia']; // Sin encriptación
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $rol = $_POST['rol'];
        $codigo_acceso = $_POST['codigo_acceso'];

        $sql = "INSERT INTO user (user, contrasenia, nombre, apellidos, rol, codigo_acceso) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssss', $user, $contrasenia, $nombre, $apellidos, $rol, $codigo_acceso);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $successMessage = "Usuario creado exitosamente!";
    } elseif (isset($_POST['update'])) {
        // Actualizar usuario existente
        $id_user = $_POST['id_user'];
        $user = $_POST['user'];
        $contrasenia = $_POST['contrasenia']; // Sin encriptación
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $rol = $_POST['rol'];
        $codigo_acceso = $_POST['codigo_acceso'];

        $sql = "UPDATE user SET user=?, contrasenia=?, nombre=?, apellidos=?, rol=?, codigo_acceso=? WHERE id_user=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssssi', $user, $contrasenia, $nombre, $apellidos, $rol, $codigo_acceso, $id_user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } elseif (isset($_POST['delete'])) {
        // Eliminar usuario
        $id_user = $_POST['id_user'];
        $sql = "DELETE FROM user WHERE id_user=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id_user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

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
                        <i><?php echo $_SESSION['username'] . "  " . $_SESSION['id_user']; ?></i>
                        <a class="fas fa-user-times ml-3 hover-dark" href="cerrar_secion.php">Salir</a>
                        <a class="fas fa-user ml-4 hover-dark" href="crud_usuario.php">Editar Cuenta</a>
                    </div>
                </div>

                <div class="container mt-5">
                    <h2>Usuarios</h2>

                    <!-- Alerta de éxito -->
                    <?php if ($successMessage): ?>
                        <div class="alert alert-success" role="alert">
                            <?= $successMessage ?>
                        </div>
                    <?php endif; ?>

                    <!-- Formulario para crear usuario -->
                    <form method="POST" action="crud_usuario.php" class="mb-4">
                        <div class="form-group">
                            <label for="user">Usuario</label>
                            <input type="text" name="user" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contrasenia">Contraseña</label>
                            <input type="password" name="contrasenia" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select name="rol" class="form-control" required>
                                <option value="">Seleccione un rol</option>
                                <option value="administrador">Administrador</option>
                                <option value="usuario">Usuario</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="codigo_acceso">Código de Acceso</label>
                            <input type="text" name="codigo_acceso" class="form-control" required>
                        </div>
                        <button type="submit" name="create" class="btn btn-primary">Crear Usuario</button>
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
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" 
                                                    data-id="<?= $usuario['id_user'] ?>" 
                                                    data-user="<?= $usuario['user'] ?>" 
                                                    data-nombre="<?= $usuario['nombre'] ?>" 
                                                    data-apellidos="<?= $usuario['apellidos'] ?>" 
                                                    data-rol="<?= $usuario['rol'] ?>" 
                                                    data-codigo="<?= $usuario['codigo_acceso'] ?>">Editar</button>
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
            </main>
        </div>
    </div>

    <!-- Modal para editar usuario -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="crud_usuario.php">
                        <input type="hidden" name="id_user" id="editId">
                        <div class="form-group">
                            <label for="editUser">Usuario</label>
                            <input type="text" name="user" id="editUser" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editContrasenia">Contraseña</label>
                            <input type="password" name="contrasenia" id="editContrasenia" class="form-control" placeholder="Dejar en blanco si no desea cambiarla">
                        </div>
                        <div class="form-group">
                            <label for="editNombre">Nombre</label>
                            <input type="text" name="nombre" id="editNombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editApellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="editApellidos" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editRol">Rol</label>
                            <select name="rol" id="editRol" class="form-control" required>
                                <option value="administrador">Administrador</option>
                                <option value="usuario">Usuario</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editCodigo">Código de Acceso</label>
                            <input type="text" name="codigo_acceso" id="editCodigo" class="form-control" required>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var id = button.data('id');
            var user = button.data('user');
            var nombre = button.data('nombre');
            var apellidos = button.data('apellidos');
            var rol = button.data('rol');
            var codigo = button.data('codigo');

            var modal = $(this);
            modal.find('#editId').val(id);
            modal.find('#editUser').val(user);
            modal.find('#editNombre').val(nombre);
            modal.find('#editApellidos').val(apellidos);
            modal.find('#editRol').val(rol);
            modal.find('#editCodigo').val(codigo);
        });
    </script>
</body>

</html>




