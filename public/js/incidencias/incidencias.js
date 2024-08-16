    document.getElementById('crearIncidenciaBtn').addEventListener('click', function() {
    // Capturar la fecha y hora actuales
    const now = new Date();
    const formattedDate = now.toLocaleString();
    
    // Asignar la fecha y hora al campo de fecha_hora
    document.getElementById('fecha_hora').value = formattedDate;

    // Recoger los datos ingresados en la primera etapa
    const casetaNombre = document.getElementById('caseta_nombre').value;
    const guardia = document.getElementById('guardia').value;
    const turno = document.getElementById('id_turnos').options[document.getElementById('id_turnos').selectedIndex].text;


    // Mostrar los datos en la segunda etapa
    document.getElementById('caseta_detalles').value = casetaNombre;
    document.getElementById('guardia_detalles').value = guardia;
    document.getElementById('turno_detalles').value = turno;

    // Ocultar el formulario de la primera etapa y mostrar el de la segunda
    document.getElementById('incidenciaForm').style.display = 'none';
    document.getElementById('detallesForm').style.display = 'block';
});

    // Mostrar el formato al seleccionar uno
    document.getElementById('id_formatos').addEventListener('change', function() {
    const formatContainer = document.getElementById('formatoDisplay');
    formatContainer.classList.remove('hidden');
    formatContainer.classList.add('show');
});

    function goBack() {
    window.history.back();
}