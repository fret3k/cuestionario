function mostrarCuestionario() {
    const nombre = document.getElementById('nombre').value.trim();
    const apellido = document.getElementById('apellido').value.trim();
    const telefono = document.getElementById('telefono').value.trim();


    if (nombre === '') {
        alert('El nombre es requerido.');
        return;
    }


    if (apellido === '') {
        alert('El apellido es requerido.');
        return;
    }


    const telefonoRegex = /^[0-9]{9}$/;
    if (!telefonoRegex.test(telefono)) {
        alert('El teléfono debe contener 9 dígitos numéricos.');
        return;
    }


    document.getElementById('hidden-nombre').value = nombre;
    document.getElementById('hidden-apellido').value = apellido;
    document.getElementById('hidden-telefono').value = telefono;


    document.getElementById('registro-card').classList.add('hidden');
    document.getElementById('cuestionario-card').classList.remove('hidden');
}