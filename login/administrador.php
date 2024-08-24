<?php
session_start();

include 'conexion.php'; 

if (!isset($_SESSION['username']) || $_SESSION['rol'] !== 'administrador') {
   
    header("Location: login.php");
    exit;
}

$updateSuccess = false; 
// Obtener datos del usuario
$userId = $_SESSION['id_user'];
$sql = "SELECT user, contrasenia, nombre, apellidos, rol FROM user WHERE id_user=?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user, $contrasenia, $nombre, $apellido, $rol);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
} else {
    echo "Error en la preparación de la consulta: " . mysqli_error($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $contrasenia = $_POST['contrasenia'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $rol = $_POST['rol'];

    // Actualizar en la base de datos
    $sql = "UPDATE user SET user=?, contrasenia=?, nombre=?, apellidos=?, rol=? WHERE id_user=?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $user, $contrasenia, $nombre, $apellido, $rol, $userId);

        if (mysqli_stmt_execute($stmt)) {
            $updateSuccess = true;
        } else {
            echo "Error al actualizar el usuario: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conn);
    }

}

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
                            <a class="nav-link" href="administrador.html">
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
                    <h1>CONTENIDO PRINCIPAL</h1>
                    <div class="user-info">
                        <i  ><?php echo $_SESSION['username'] ."  ".$_SESSION['id_user']; ?> </i>
                        <a class=" fas fa-user-times ml-3 hover-dark" href="cerrar_secion.php">Salir </a>
                        <a class="fas fa-user ml-4 hover-dark" data-bs-toggle="modal" data-bs-target="#editUserModal">Editar Cuenta</a>
                    </div>
                </div>

                <div class="container mt-5">
        
        <form id="codeForm" method="post" action="update_codigo.php">
        <div class="form-group">
                <label for="codeInput" >Codigo de Encuesta: <?php echo $_SESSION['codigo_acceso']; ?> </label>
                <input type="text" class="form-control custom-input" id="codeInput" name="new_code" placeholder="Modificar codigo">
            </div>
            <button type="submit" class="btn btn-primary">Guardar Código</button>
        </form>
    </div>

                <div class="container mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2>Lista de Encuestados</h2>
                        <button class="btn btn-success">
                            <i class="fas"></i>
                            Exportar aExcel
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Número de Teléfono</th>
                                <th>Localidad</th>
                                <th>Fecha de Registro</th>
                                <th>Ver Historial</th>
                                </tr>
                            </thead>
                            <tbody id="data-table-body">
                                <?php
                                // Asegúrate de que la ruta al archivo sea correcta
                                include 'c_administrador.php';  // Ajusta la ruta según sea necesario
                                ?> 
                            </tbody>
                        </table>
                    </div>

                    <nav aria-label="Page navigation">
                       <!--carudel de navegacion -->
                    </nav>
                </div>

                <div class="footer mt-4">
                    <button class="btn btn-primary">Exportar a Excel</button>
                </div>

                <form action="exportar.php" method="get">
                <input type="hidden" name="idCliente" value="<?php echo $idCliente; ?>">
                <button type="submit">Exportar a Excel</button>
                </form>

            </main>
        </div>
    </div>
</body>

</html>

<!-- Modal -->
<div class="modal fade" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="historialModalLabel">Historial del Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-content" style="max-height: 500px; overflow-y: auto;">
                <!-- Aquí se cargará la tabla de detalles y respuestas -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function verHistorial(idCliente) {
            $.ajax({
                url: 'ver_historial.php',
                type: 'GET',
                data: { idCliente: idCliente },
                success: function(data) {
                    $('#modal-body-content').html(data);
                    var myModal = new bootstrap.Modal(document.getElementById('historialModal'));
                    myModal.show();
                },
                error: function() {
                    $('#modal-body-content').html('<p>Error al cargar el historial.</p>');
                }
            });
        }
    </script>

<!-- Modal para editar cuenta -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Editar Cuenta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" method="post" action="">
                        <input type="hidden" id="userId" name="userId" value="<?php echo $userId; ?>">
                        <div class="mb-3">
                            <label for="editUser" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="editUser" name="user" value="<?php echo $user; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="editContrasenia" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="editContrasenia" name="contrasenia" value="<?php echo $contrasenia; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editNombre" name="nombre" value="<?php echo $nombre; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="editApellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="editApellido" name="apellido" value="<?php echo $apellido; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="editRol" class="form-label">Rol</label>
                            <select class="form-select" id="editRol" name="rol" required>
                                <option value="administrador" <?php echo ($rol == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
                                <option value="usuario" <?php echo ($rol == 'usuario') ? 'selected' : ''; ?>>Usuario</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

 
 
</body>

</html>
<?php if ($updateSuccess): ?>
    <script>
        alert("Usuario actualizado correctamente.");
    </script>
<?php endif; ?>