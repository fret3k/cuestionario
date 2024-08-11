<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../stilos/adminstyles.css">
</head>

<body>
    <div class="sidebar">
        <h3>ADMIN</h3>
        <a href="administrador.php">Dashboard</a>
        <h4>Inicio</h4>
        <a href="administrador.php" class="animate-fade-in">Mostrar datos</a>
        <h4>Usuarios</h4>
        <a href="crud_usuario.php" class="animate-fade-in">Mostrar</a>
    </div>
    

    
    <div class="main-content">
        <div class="header">
            <!-- campo para mostrar informacion -->
            <div class="user-info">
                <span>Admin</span>
                <!-- Add notification icons if needed -->
            </div>
        </div>

        <h1>CONTENIDO PRINCIPAL</h1>

        <div class="table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Número de Teléfono</th>
                        <th>Ver Historial</th>
                    </tr>
                </thead>
                <tbody id="data-table-body">
                    <!-- Agregar la tabla de la base de datos -->
                </tbody>
            </table>
        </div>

        <div class="footer">
            <button class="btn btn-primary">Exportar a Excel</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="administrador.js"></script> 

    <!-- Modal para mostrar el historial -->
    <div class="modal fade" id="historialModal" tabindex="-1" role="dialog" aria-labelledby="historialModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="historialModalLabel">Historial del Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody id="historial-table-body">
                            <!-- Aquí se insertarán las filas del historial mediante JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>


