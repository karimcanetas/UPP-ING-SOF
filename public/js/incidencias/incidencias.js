document.getElementById('crearIncidenciaBtn').addEventListener('click', function () {
    // capturar la fecha y hora con la zona horaria
    const now = new Date();
    const opciones = { timeZone: 'America/Mexico_City', hour12: false };

    // se eliminara cualquier caracter ","
    const fechaISO = now.toLocaleString('es-ES', opciones).replace(/,/g, '');

    // separdor
    const [fecha, hora] = fechaISO.split(' ');

    // cambiar el formato a "YYYY-MM-DD"
    const [dia, mes, año] = fecha.split('/');
    const fechaFormateada = `${año}-${mes.padStart(2, '0')}-${dia.padStart(2, '0')}`;

    // combina fecha y hora
    const fechaHoraFormateada = `${fechaFormateada} ${hora}`;

    document.getElementById('fecha_hora').value = fechaHoraFormateada;
    document.getElementById('fecha_hora').redOnly = true;

    //validar turno
    const turnoSeleccionado = document.getElementById('id_turnos').value;

    if (turnoSeleccionado) {
        mostrarSegundaEtapa(); // Continúa si un turno ha sido seleccionado
    } else {
        // mostrar una alerta si no selecciono
        Swal.fire({
            icon: 'warning',
            title: '¡Atención!',
            text: 'Por favor, seleccione un turno para continuar.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            location.reload(); // Recarga la página después de cerrar la alerta
        });
    }

    // recoger los datos ingresados en la primera etapa
    const casetaNombre = document.getElementById('id_casetas').value;
    const guardia = document.getElementById('guardia').value;
    const turno = document.getElementById('id_turnos').value;
    const Nombre_vigilante = document.getElementById('Nombre_vigilante').value;


    // mostrar los datos en la segunda etapa
    document.getElementById('caseta_detalles').value = casetaNombre;
    document.getElementById('guardia_detalles').value = guardia;
    document.getElementById('turno_detalles').value = turno;
    document.getElementById('Nombre_vigilante_detalles').value = Nombre_vigilante;


    // ocultar el formulario de la primera etapa y mostrar el de la segunda
    document.getElementById('incidenciaForm').style.display = 'none';
    document.getElementById('detallesForm').style.display = 'block';
});

function mostrarSegundaEtapa() {
    document.getElementById('primeraEtapa').style.display = 'none';
    document.getElementById('detallesForm').style.display = 'none';
}
//Formatos
// mostrar el formato al seleccionar uno
document.getElementById('id_formatos').addEventListener('change', function () {
    const formatContainer = document.getElementById('formatoDisplay');
    formatContainer.classList.remove('hidden');
    formatContainer.classList.add('show');
});

document.getElementById('id_formatos').addEventListener('change', function () {
    var selectedFormat = this.options[this.selectedIndex].text;
    var formatoDisplay = document.getElementById('formatoDisplay');
    var ltGasolinaFields = document.getElementById('ltGasolinaFields');

    if (selectedFormat === 'Novedades') {
        formatoDisplay.style.display = 'block';
        if (ltGasolinaFields) {
            ltGasolinaFields.style.display = 'block';
        }
    } else {
        formatoDisplay.style.display = 'none';
        if (ltGasolinaFields) {
            ltGasolinaFields.style.display = 'none';
        }
    }

});

////////Area de demos
document.getElementById('id_formatos').addEventListener('change', function () {
    var formatoSeleccionado = this.options[this.selectedIndex].text;

    var formularios = {
        'Control de Unidades': 'controlUnidades',
        'Control de proveedores TOTs': 'controlProv',
        'Uso Unidades demos (Pruebas de manejo y/o diligencias)': 'controlDemos',
        'Revision de instalaciones': 'instalaciones',
        'Inventario de unidades en exhibición': 'unidades',
        'Control de acceso a proveedores': 'controlProveedores',

    };

    //ocultar
    for (var key in formularios) {
        document.getElementById(formularios[key]).style.display = 'none';
    }

    // mostrar solo el formulario seleccionado
    if (formatoSeleccionado in formularios) {
        document.getElementById(formularios[formatoSeleccionado]).style.display = 'block';
    }
});

//////////Encierro
document.getElementById('id_formatos').addEventListener('change', function () {
    var formatoSeleccionado = this.options[this.selectedIndex].text;

    var formularios = {
        'Acceso y salida de unidades siniestradas': 'acceso_salida',
        'Entrada y salida de unidades del encierro': 'unidades_encierro',
        'Inventario de unidades nuevas en encierro / patio': 'inventario_unidades',

    };

    //ocultar
    for (var key in formularios) {
        document.getElementById(formularios[key]).style.display = 'none';
    }

    // mostrar solo el formulario seleccionado
    if (formatoSeleccionado in formularios) {
        document.getElementById(formularios[formatoSeleccionado]).style.display = 'block';
    }
});

//////////PostVenta
document.getElementById('id_formatos').addEventListener('change', function () {
    var formatoSeleccionado = this.options[this.selectedIndex].text;

    var formularios = {
        'Control de aceite y residuos de taller': 'control_taller',
        'Registro de unidades siniestradas en estacionamiento fuera de horario laboral': 'registro_unidades',
        'Registro de unidades seminuevas en estacionamiento para exhibición': 'registro_exhibicion',
        'Registro de otras unidades en estacionamientos de clientes': 'registro_clientes',
        'Unidades estadía en taller': 'estadia_taller',
        'Unidades estadía en azotea': 'estadia_azotea',
        'Control de acceso de unidades por el área de taller postventa': 'taller_postventa',
        'Vehículos por siniestros (ORDENES TIPO B SEGUROS)': 'vehiculos_siniestros',
        'Vehículo para lavado (ORDENES TIPO I,D,A,S Y E INTERNAS Y EMPLEADOS)': 'vehiculo_lavado'

    };

    //ocultar
    for (var key in formularios) {
        document.getElementById(formularios[key]).style.display = 'none';
    }

    // mostrar solo el formulario seleccionado
    if (formatoSeleccionado in formularios) {
        document.getElementById(formularios[formatoSeleccionado]).style.display = 'block';
    }
});


function goBack() {
    window.history.back();

}