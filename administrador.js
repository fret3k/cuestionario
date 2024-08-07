document.addEventListener("DOMContentLoaded", function() {
    fetch('administrador.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('data-table-body');
            data.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.nombre}</td>
                    <td>${row.apellido}</td>
                    <td>${row.numero_telefono}</td>
                    <td><a href='#' class='btn btn-primary' data-id='${row.idcliente}' data-nombre='${row.nombre}' data-apellido='${row.apellido}' data-toggle='modal' data-target='#historialModal'>Ver Historial</a></td>
                `;
                tableBody.appendChild(tr);
            });

            document.querySelectorAll('.btn-primary').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const idCliente = this.getAttribute('data-id');
                    const nombre = this.getAttribute('data-nombre');
                    const apellido = this.getAttribute('data-apellido');
                    fetch(`ver_historial.php?idCliente=${idCliente}`)
                        .then(response => response.json())
                        .then(data => {
                            const historialTableBody = document.getElementById('historial-table-body');
                            historialTableBody.innerHTML = '';

                            if (data.length > 0) {
                                const historial = data[0];
                                historialTableBody.innerHTML = `
                                    <tr><th>Nombre y Apellido</th><td>${nombre} ${apellido}</td></tr>
                                    <tr><th>Puntuación</th><td>${historial.puntuacion}</td></tr>
                                    <tr><th>pregunta 1 </th><td>${historial.pregunta1}</td></tr>
                                    <tr><th>pregunta 2 </th><td>${historial.pregunta2}</td></tr>
                                    <tr><th>pregunta 3 </th><td>${historial.pregunta3}</td></tr>
                                    <tr><th>pregunta 4 </th><td>${historial.pregunta4}</td></tr>
                                    <tr><th>pregunta 5 </th><td>${historial.pregunta5}</td></tr>
                                    <tr><th>pregunta 6 </th><td>${historial.pregunta6}</td></tr>
                                    <tr><th>pregunta 7 </th><td>${historial.pregunta7}</td></tr>
                                    <tr><th>pregunta 8 </th><td>${historial.pregunta8}</td></tr>
                                    <tr><th>pregunta 9 </th><td>${historial.pregunta9}</td></tr>
                                    <tr><th>pregunta 10 </th><td>${historial.pregunta10}</td></tr>
                                    <tr><th>pregunta 11 </th><td>${historial.pregunta11}</td></tr>
                                    <tr><th>pregunta 12 </th><td>${historial.pregunta12}</td></tr>
                                    <tr><th>pregunta 13 </th><td>${historial.pregunta13}</td></tr>
                                    <tr><th>observaciones </th><td>${historial.observaciones}</td></tr>
                                `;
                            } else {
                                historialTableBody.innerHTML = '<tr><td colspan="2">No hay historial disponible.</td></tr>';
                            }
                        })
                        .catch(error => console.error('Error fetching historial:', error));
                });
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});

