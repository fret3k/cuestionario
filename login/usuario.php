<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['rol'] !== 'usuario') {
   
    header("Location: login.php");
    exit;
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
                            <a class="nav-link" href="usuario.php">
                                <i class="fas fa-list"></i>
                                Mostrar datos
                            </a>
                        </li>
                    
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 col-lg-10 main-content">
                <div class="header d-flex justify-content-between align-items-center">
                    <h1>CONTENIDO PRINCIPAL</h1>
                    <div class="user-info">

                    <i  ><?php echo $_SESSION['username'] ."  "; ?> </i>
                        <a class=" fas fa-user-times ml-3 hover-dark" href="cerrar_secion.php">Salir </a>
                        <a class=" fas fa-user ml-4 hover-dark" href="crud_usuario.php">Editar Cuenta </a>
                   

                        <span>Admin</span>
                        <i class="fas fa-bell ml-3"></i>
                        <i class="fas fa-user ml-3"></i>
                    </div>
                </div>
            
                <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add New
                </button>

                <div class="container mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2>Lista de Clientes</h2>
                        
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
</body>
</html>