document.getElementById('crearIncidenciaBtn').addEventListener('click', () => {
    const now = new Date().toLocaleString('es-ES', { timeZone: 'America/Mexico_City', hour12: false }).replace(/,/g, '').split(' ');
    const [dia, mes, año] = now[0].split('/');
    const fechaHora = `${año}-${mes.padStart(2, '0')}-${dia.padStart(2, '0')} ${now[1]}`;

    const setField = (id, value) => { const elem = document.getElementById(id); if (elem) elem.value = value; };

    const turno = document.getElementById('id_turnos').value;
    const caseta = document.getElementById('id_casetas').value;
    const vigilante = document.getElementById('Nombre_vigilante').value;

    if (!turno) return Swal.fire({ icon: 'warning', title: '¡Atención!', text: 'Por favor, seleccione un turno.', confirmButtonText: 'Aceptar' }).then(() => location.reload());

    ['fecha_hora', 'fecha_hora_detalles', 'fecha_hora_tots', 'fecha_hora_demos', 'fecha_hora_control', 'fecha_hora_revision', 'fecha_hora_unidades', 'fecha_hora_proveedores', 'fecha_hora_salida', 'fecha_hora_entrada', 'fecha_hora_inventario', 'fecha_hora_novedades', 'fecha_hora_nov_encierro', 'fecha_hora_post', 'fecha_hora_siniestradas', 'fecha_hora_lavados', 'fecha_hora_taller', 'fecha_hora_fuera', 'fecha_hora_exhibicion', 'fecha_hora_clientes', 'fecha_hora_azotea', 'fecha_hora_estadia', 'fecha_hora_servicios', 'fecha_hora_entrega', 'fecha_hora_servicio', 'fecha_hora_acceso', 'fecha_hora_altabrisa_servicio', 'fecha_hora_granel', 'fecha_hora_subaru', 'fecha_hora_subarutot', 'fecha_hora_m', 'fecha_hora_empresasub', 'fecha_hora_salidasubaru', 'fecha_hora_estacionamientosub', 'fecha_hora_porton', 'fecha_hora_acceso', 'fecha_hora_invaltabrisa', 'fecha_hora_vehiculos', 'fecha_hora_bitacora', 'fecha_hora_ingreso', 'fecha_hora_aceite'].forEach(id => setField(id, fechaHora));
    ['caseta_detalles', 'caseta_tots', 'caseta_demos', 'caseta_control', 'caseta_revision', 'caseta_unidades', 'caseta_proveedores', 'caseta_salida', 'caseta_entrada', 'caseta_inventario', 'caseta_novedades', 'caseta_nov_encierro', 'caseta_post', 'caseta_siniestradas', 'caseta_lavados', 'caseta_taller', 'caseta_fuera', 'caseta_exhibicion', 'caseta_clientes', 'caseta_azotea', 'caseta_estadia', 'caseta_servicios', 'caseta_entrega', 'caseta_servicio', 'caseta_acceso', 'caseta_altabrisa_servicio', 'caseta_granel', 'caseta_subaru', 'caseta_subaru_tot', 'caseta_subaru_m', 'caseta_empresasub', 'caseta_salida_subaru', 'caseta_estacionamiento_sub', 'caseta_porton', 'caseta_acceso', 'caseta_inventario_altabrisa', 'caseta_vehiculos', 'caseta_bitacora', 'caseta_ingreso', 'caseta_aceite'].forEach(id => setField(id, caseta));
    ['turno_detalles', 'turno_tots', 'turno_demos', 'turno_control', 'turno_revision', 'turno_unidades', 'turno_proveedores', 'turno_salida', 'turno_entrada', 'turno_inventario', 'turno_novedades', 'turno_nov_encierro', 'turno_post', 'turno_siniestradas', 'turno_lavados', 'turno_taller', 'turno_fuera', 'turno_exhibicion', 'turno_caseta', 'turno_clientes', 'turno_azotea', 'turno_estadia', 'turno_servicios', 'turno_entrega', 'turno_servicio', 'turno_acceso', 'turno_altabrisa_servicio', 'turno_granel', 'turno_subaru', 'turno_subaru_tot', 'turno_subaru_m', 'turno_empresasub', 'turno_salida_subaru', 'turno_estacionamiento_sub', 'turno_porton', 'turno_acceso', 'turno_inventario_altabrisa', 'turno_vehiculos', 'turno_bitacora', 'turno_ingreso', 'turno_aceite'].forEach(id => setField(id, turno));
    ['Nombre_vigilante_detalles', 'Nombre_vigilante_tots', 'Nombre_vigilante_demos', 'Nombre_vigilante_control', 'Nombre_vigilante_revision', 'Nombre_vigilante_unidades', 'Nombre_vigilante_proveedores', 'Nombre_vigilante_salida', 'Nombre_vigilante_entrada', 'Nombre_vigilante_inventario', 'Nombre_vigilante_novedades', 'Nombre_vigilante_nov_encierro', 'Nombre_vigilante_post', 'Nombre_vigilante_siniestradas', 'Nombre_vigilante_lavados', 'Nombre_vigilante_taller', 'Nombre_vigilante_fuera', 'Nombre_vigilante_exhibicion', 'Nombre_vigilante_clientes', 'Nombre_vigilante_azotea', 'Nombre_vigilante_estadia', 'Nombre_vigilante_servicios', 'Nombre_vigilante_entrega', 'Nombre_vigilante_servicio', 'Nombre_vigilante_acceso', 'Nombre_altabrisa_servicio', 'Nombre_vigilante_granel', 'Nombre_vigilante_subaru', 'Nombre_vigilante_subarutot', 'Nombre_vigilante_m', 'Nombre_vigilante_empresasub', 'Nombre_vigilante_salidasubaru', 'Nombre_vigilante_estacionamientosub', 'Nombre_vigilante_porton', 'Nombre_vigilante_acceso', 'Nombre_vigilante_invaltabrisa', 'Nombre_vigilante_vehiculos', 'Nombre_vigilante_bitacora', 'Nombre_vigilante_ingreso', 'Nombre_vigilante_aceite'].forEach(id => setField(id, vigilante));

    document.getElementById('incidenciaForm').style.display = 'none';
    document.getElementById('detallesForm').style.display = 'block';
});

function mostrarSegundaEtapa() {
    document.getElementById('primeraEtapa').style.display = 'none';
    document.getElementById('detallesForm').style.display = 'none';
}


document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('id_formatos').addEventListener('change', function () {
        const formatos = this.value;
        if (!formatos) {
            alert('Por favor, selecciona un formato.');
            return;
        }
        const setField = (id, value) => { const elem = document.getElementById(id); if (elem) elem.value = value; };
        ['formatos_tots', 'formatos_demos', 'formatos_control', 'formatos_revision', 'formatos_unidades', 'formatos_proveedores', 'formatos_salida', 'formatos_entrada', 'formatos_inventario', 'formatos_novedades', 'formatos_nov_encierro', 'formatos_post', 'formatos_siniestradas', 'formatos_lavados', 'formatos_taller', 'formatos_fuera', 'formatos_exhibicion', 'formatos_clientes', 'formatos_azotea', 'formatos_estadia', 'formatos_servicios', 'formatos_entrega', 'formatos_servicio_montejo', 'formatos_servicio_acceso', 'formatos_altabrisa_servicio', 'formatos_granel', 'formatos_subaru', 'formatos_subaru_tot', 'formatos_subaru_m', 'formatos_empresasub', 'formatos_salida_subaru', 'formatos_estacionamiento_sub', 'formatos_porton', 'formatos_acceso', 'formatos_inventario_altabrisa', 'formatos_vehiculos', 'formatos_bitacora', 'formatos_ingreso', 'formatos_aceite'].forEach(id => setField(id, formatos));

        document.getElementById('incidenciaForm').style.display = 'none';
        document.getElementById('detallesForm').style.display = 'block';
    });
});

function validateNumberInput(input) { input.value = input.value.replace(/\D/g, '').slice(0, 6); }

// function toggleOtroUnidad(selectElement) {
//     const container = document.getElementById('otroUnidadContainer');
//     container.style.display = selectElement.value === 'OTRO' ? 'block' : 'none';
//     container.querySelector('input').required = selectElement.value === 'OTRO';
// }

// document.querySelectorAll('.area_departamento, .ubicacion_unidad, .unidades_utilitarias').forEach(select => {
//     select.addEventListener('change', function () {
//         this.closest('.form-group').nextElementSibling.style.display = this.value === 'OTRO' ? 'block' : 'none';
//     });
// });

// function validateNumberInput(input) { input.value = input.value.replace(/\D/g, '').slice(0, 6); }

// function toggleOtroUnidad(selectElement) {
//     const container = document.getElementById('otroUnidadContainer');
//     container.style.display = selectElement.value === 'OTRO' ? 'block' : 'none';
//     container.querySelector('input').required = selectElement.value === 'OTRO';
// }

// document.querySelectorAll('.area_departamento, .ubicacion_unidad, .unidades_utilitarias').forEach(select => {
//     select.addEventListener('change', function () {
//         this.closest('.form-group').nextElementSibling.style.display = this.value === 'OTRO' ? 'block' : 'none';
//     });
// });

document.getElementById('id_turnos').addEventListener('change', function () {
    const turno = this.options[this.selectedIndex].dataset.nombre;
    const casetaSeleccionada = document.getElementById('id_casetas').value;  // Obtener el ID de la caseta seleccionada
    const formatos = document.getElementById('id_formatos').options;

    const formatosPorCasetaYTurno = {
        '3': { // ID de la caseta Área de demos
            'Matutino': [
                'Novedades',
                'Control de Unidades',
                'Control de proveedores TOTs',
                'Uso Unidades demos (Pruebas de manejo y/o diligencias)'
            ],
            'Nocturno': [
                'Novedades',
                'Revisión de instalaciones',
                'Inventario de unidades en exhibición',
                'Control de acceso a proveedores'
            ]
        },
        '9': { // ID de la caseta Encierro
            'Matutino': [
                'Novedades.',
                'Acceso y salida de unidades siniestradas',
                'Entrada y salida de unidades del encierro'
            ],
            'Nocturno': [
                'Novedades.',
                'Inventario de unidades nuevas en encierro / patio'
            ]
        },
        '16': { // ID de la caseta Postventa
            'Matutino': [
                'Novedades Postventa',
                'Control de acceso de unidades por el área de taller postventa',
                'Vehículos por siniestros (ORDENES TIPO B SEGUROS)',
                'Vehículo para lavado (ORDENES TIPO I,D,A,S Y E INTERNAS Y EMPLEADOS)'
            ],
            'Nocturno': [
                'Control de aceite y residuos de taller',
                'Registro de unidades siniestradas en estacionamiento fuera de horario laboral',
                'Registro de unidades seminuevas en estacionamiento para exhibición',
                'Registro de otras unidades en estacionamientos de clientes',
                'Unidades estadía en taller',
                'Unidades estadía en azotea'
            ],
        },
        '1': {// ID caseta servicio
            'Matutino': [
                'Novedades Servicios',
                'Control de acceso a proveedores Montejo',

            ],
            'Nocturno': [
                'Novedades Servicios',
                'Control de entrega de unidades en postventa',
                'Control de unidades en estacionamiento TOYOTA',
                'POSTVENTA - BITACORA DE SURTIDO DE ACEITE BAHIAS',
                'POSTVENTA - BITACORA DE ACEITE GRANEL'

            ]
        },
        '7': {// ID caseta subaru 
            'Matutino': [
                'Novedades Subaru',
                'Salida Unidades TOTs',
                'Control de acceso a proveedores Subaru'
            ],
            'Nocturno': [
                'Novedades Subaru',
                'Control de acceso a proveedores Subaru'
            ]
        },
        '5': {// ID Caseta subaru Empresa SUBARU Sucursal Mérida
            'Matutino': [
                'Novedades Subaru',
                'Control de entrega de unidades en Postventa Subaru',
                'SALIDA UNIDADES TOTs SUBARU'
            ],
            'Nocturno': [
                'Novedades Subaru',
                'Control de unidades en estacionamiento SUBARU'
            ]
        },
        '2': { //ID Caseta Servicio Empresa TOYOTA Sucursal Altabrisa
            'Matutino': [
                'Novedades Servicios',
                'POSTVENTA - BITACORA DE SURTIDO DE ACEITE BAHIAS ALTABRISA',
                'Postventa - Bitácora acceso vehículos a servicio sin cita',
                'Control de entrega de unidades en postventa'

            ],
            'Nocturno': [
                'Novedades Servicios',
                'POSTVENTA - BITACORA DE SURTIDO DE ACEITE BAHIAS ALTABRISA'
            ]
        },
        '8': {// ID Caseta Portón rojo empresa TOYOTA sucursal Altabrisa
            'Matutino': [
                'Novedades Portón rojo',
                'Bitacora de control de acceso personal y vehicular',
                'Bitácora de control de vehículos utilitarios',
                'CONTROL DE INGRESO/SALIDA DE UNIDADES B&P'

            ],
            'Nocturno': [
                'Novedades Portón rojo',
                'Bitacora de control de acceso personal y vehicular',
                'Inventario de unidades en las instalaciones'

            ]

        }
    };

    // Obtener los formatos correspondientes según la caseta y el turno seleccionados
    const formatosPorTurnoYCaseta = formatosPorCasetaYTurno[casetaSeleccionada] && formatosPorCasetaYTurno[casetaSeleccionada][turno] || [];

    // Mostrar solo los formatos que coincidan con la combinación de caseta y turno seleccionados
    Array.from(formatos).forEach(opcion => {
        opcion.style.display = formatosPorTurnoYCaseta.includes(opcion.text) ? '' : 'none';
    });
});

document.getElementById('id_formatos').addEventListener('change', function () {
    const formatoSeleccionado = this.options[this.selectedIndex].text;

    const formularios = {
        //SUCURSAL TOYOTA CANCÚN

        // Caseta Área de demos
        'Novedades': 'Novedades_demos',
        'Novedades Postventa': 'Novedades_post',
        'Control de Unidades': 'controlUnidades',
        'Control de proveedores TOTs': 'controlProv',
        'Uso Unidades demos (Pruebas de manejo y/o diligencias)': 'controlDemos',
        'Revision de instalaciones': 'instalaciones',
        'Inventario de unidades en exhibición': 'unidades',
        'Control de acceso a proveedores': 'controlProveedores',


        // Caseta Encierro
        'Novedades.': 'Novedades_encierro',
        'Acceso y salida de unidades siniestradas': 'acceso_salida',
        'Entrada y salida de unidades del encierro': 'unidades_encierro',
        'Inventario de unidades nuevas en encierro / patio': 'inventario_unidades',

        // Caseta PostVenta
        'Control de aceite y residuos de taller': 'control_taller',
        'Registro de unidades siniestradas en estacionamiento fuera de horario laboral': 'registro_unidades',
        'Registro de unidades seminuevas en estacionamiento para exhibición': 'registro_exhibicion',
        'Registro de otras unidades en estacionamientos de clientes': 'registro_clientes',
        'Unidades estadía en taller': 'estadia_taller',
        'Unidades estadía en azotea': 'estadia_azotea',
        'Control de acceso de unidades por el área de taller postventa': 'taller_postventa',
        'Vehículos por siniestros (ORDENES TIPO B SEGUROS)': 'vehiculos_siniestros',
        'Vehículo para lavado (ORDENES TIPO I,D,A,S Y E INTERNAS Y EMPLEADOS)': 'vehiculo_lavado',

        //SUCURSAL TOYOTA MONTEJO

        //Caseta Servicio
        'Novedades Servicios': 'novedad_servicio',
        'Control de entrega de unidades en postventa': 'Control_entrega_servicio',
        'Control de unidades en estacionamiento TOYOTA': 'Control_toyota_servicio',
        'Control de acceso a proveedores Montejo': 'control_acceso_proveedores',
        'POSTVENTA - BITACORA DE SURTIDO DE ACEITE BAHIAS': 'controlAceite',
        'POSTVENTA - BITACORA DE ACEITE GRANEL': 'BitacoraAceite',

        //SUCURSAL TOYOTA ALTABRISA
        'Novedades Servicios': 'novedad_servicio',
        'Novedades Portón rojo': 'Novedades_porton_rojo',
        'Bitacora de control de acceso personal y vehicular': 'bitacora_acceso',
        'Inventario de unidades en las instalaciones': 'inventario_instalaciones',
        'Postventa - Bitácora acceso vehículos a servicio sin cita': 'bitacora_servicio',

        // Caseta Subaru
        'Salida Unidades TOTs': 'salida_unidades_subaru',
        'Control de acceso a proveedores Subaru': 'control_acceso_subaru',

        //EMPRESA SUBARU SUCURSAL MÉRIDA 
        //CASETA SUBARU
        'Novedades Subaru': 'novedad_subaru',
        'SALIDA UNIDADES TOTs SUBARU': 'unidades_subaru',
        'Control de unidades en estacionamiento SUBARU': 'Control_subaru_servicio',
        'Bitácora de control de vehículos utilitarios': 'control_vehiculos',
        'POSTVENTA - BITACORA DE SURTIDO DE ACEITE BAHIAS ALTABRISA': 'bitacora_bahias',
        'CONTROL DE INGRESO/SALIDA DE UNIDADES B&P': 'control_ingreso_salida',
        'Control de entrega de unidades en Postventa Subaru': 'control_subaru',
        'Control de entrega de unidades en Postventa': 'entrega_unidades_altabrisa'




    };

    Object.values(formularios).forEach(id => {
        const element = document.getElementById(id);
        if (element) element.style.display = 'none';
    });

    const seleccionar = document.getElementById(formularios[formatoSeleccionado]);
    if (seleccionar) seleccionar.style.display = 'block';
});

// btn atras
document.getElementById('btnAtras').addEventListener('click', function () {
    const primeraEtapa = document.getElementById('primeraEtapa');
    const incidenciaForm = document.getElementById('incidenciaForm');
    const detallesForm = document.getElementById('detallesForm');


    if (window.history.length > 1 && detallesForm.style.display === 'block') {
        detallesForm.classList.add('fade-out');

        setTimeout(function () {
            detallesForm.style.display = 'none';
            detallesForm.classList.remove('fade-out');


            primeraEtapa.style.display = 'block';
            incidenciaForm.style.display = 'block';
            primeraEtapa.classList.add('fade-in');

        }, 300);

    } else {
        document.body.classList.add('fade-out');
        setTimeout(function () {
            window.history.back();
        }, 300);
    }
});

//estilo
document.addEventListener('DOMContentLoaded', function () {
    const style = document.createElement('style');
    style.innerHTML = `
        .fade-out {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .fade-in {
            opacity: 1;
            transition: opacity 0.3s ease;
        }
    `;
    document.head.appendChild(style);
});
// // Función para mostrar u ocultar el textarea según la opción seleccionada
// function toggleOtroArea(selectElement) {
//     const selectedValue = selectElement.value;
//     const otrosTextareaContainer = selectElement.nextElementSibling; // Asegúrate de que el textarea esté justo después del select
//     const otrosTextarea = otrosTextareaContainer.querySelector('textarea');

//     if (selectedValue === 'otro') {
//         otrosTextareaContainer.style.display = 'block';
//         otrosTextarea.value = ''; // Limpiar el textarea
//     } else {
//         otrosTextareaContainer.style.display = 'none';
//         otrosTextarea.value = selectedValue; // Asignar el valor del select al textarea
//     }
// }

// // Función para ajustar el valor del campo de "Área / Departamento" antes de enviar el formulario
// function ajustarValorCampo(form) {
//     // Seleccionar todos los elementos select en el formulario
//     const selectElements = form.querySelectorAll('select[name^="campos["]');
//     let valid = true; // Variable para verificar la validez

//     selectElements.forEach((selectElement) => {
//         const otrosTextarea = selectElement.nextElementSibling.querySelector('textarea');

//         // Verificar si el valor seleccionado es "otro"
//         if (selectElement.value === 'otro') {
//             selectElement.value = otrosTextarea.value.trim(); // Asigna el valor del textarea
//         }

//         // Verifica que el textarea tenga un valor si se selecciona "OTRO"
//         if (selectElement.value === '' && otrosTextarea.value.trim() === '') {
//             alert('Por favor, especifica otra área o departamento.');
//             valid = false; // Marcar como inválido
//         }
//     });

//     return valid; // Retorna true si todos los campos son válidos
// }

document.addEventListener('DOMContentLoaded', function () {
    const empleadoSelect = document.getElementById('empleadoSelect');
    const puestoInput = document.getElementById('puestoInput');

    if (empleadoSelect) {
        empleadoSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const puesto = selectedOption.getAttribute('data-puesto');

            puestoInput.value = puesto || '';
        });
    } else {
        console.warn('elemento empleadoSelect no encontrado');
    }
});

function toggleOtroUnidad(select) {
    // Obtener el elemento del campo de texto "otroUnidad"
    const otraunidad = select.value;
    const textunidad = select.nextElementSibling;
    const otrotextunidad = textunidad.querySelector('textarea');

    // Si la opción seleccionada es "otro", mostrar el campo de texto, de lo contrario, ocultarlo
    if (select.value === 'otro') {
        textunidad.style.display = 'block';
        otrotextunidad.value = '';  // Hacer el campo obligatorio cuando se muestra
    } else {
        textunidad.style.display = 'none';
        otrotextunidad.value = otraunidad; // No obligatorio cuando está oculto
    }
}
function toggleOtroArea(selectElement) {
    const selectedValue = selectElement.value;
    const otrosTextareaContainer = selectElement.nextElementSibling; // Asegúrate de que el textarea esté justo después del select
    const otrosTextarea = otrosTextareaContainer.querySelector('textarea');

    if (selectedValue === 'otro') {
        otrosTextareaContainer.style.display = 'block';
        otrosTextarea.value = ''; // Limpiar el textarea
    } else {
        otrosTextareaContainer.style.display = 'none';
        otrosTextarea.value = selectedValue; // Asignar el valor del select al textarea
    }
}




// Función para ajustar el valor del campo de "Unidad" antes de enviar el formulario
function ajustarValorCampo(form) {
    const selectElements = form.querySelectorAll('select[name^="campos["]');
    let valid = true; // Variable para verificar la validez

    selectElements.forEach((selectElement) => {
        const otrosTextarea = selectElement.nextElementSibling.querySelector('textarea');

        // Verificar si el valor seleccionado es "otro"
        if (selectElement.value === 'otro') {
            selectElement.value = otrosTextarea.value.trim(); // Asigna el valor del textarea
        }

        // Verifica que el textarea tenga un valor si se selecciona "OTRO"
        if (selectElement.value === '' && otrosTextarea.value.trim() === '') {
            alert('Por favor, especifica otra unidad.');
            valid = true; // Marcar como inválido
        }
    });

    return true; // Retorna true si todos los campos son válidos
}





