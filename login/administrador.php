<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Lista de Clientes</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
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
    </div>

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
