document.getElementById('crearIncidenciaBtn').addEventListener('click', () => {
    const now = new Date().toLocaleString('es-ES', { timeZone: 'America/Mexico_City', hour12: false }).replace(/,/g, '').split(' ');
    const [dia, mes, año] = now[0].split('/');
    const fechaHora = `${año}-${mes.padStart(2, '0')}-${dia.padStart(2, '0')} ${now[1]}`;

    const setField = (id, value) => { const elem = document.getElementById(id); if (elem) elem.value = value; };


    //aqui lo que hago es pasar los datos, turno, casetas y el nombre de vigilante del inicio de sesion a los formatos
    const turno = document.getElementById('id_turnos').value;
    const caseta = document.getElementById('id_casetas').value;
    const vigilante = document.getElementById('Nombre_vigilante').value;
    const camposGasolina = ['Lt Gasolina Inicial', 'Lt Gasolina Final'];

    if (!turno) return Swal.fire({ icon: 'warning', title: '¡Atención!', text: 'Por favor, seleccione un turno.', confirmButtonText: 'Aceptar' }).then(() => location.reload());

    ['fecha_hora', 'fecha_hora_detalles', 'fecha_hora_tots', 'fecha_hora_demos', 'fecha_hora_control', 'fecha_hora_revision', 'fecha_hora_unidades', 'fecha_hora_proveedores', 'fecha_hora_salida', 'fecha_hora_entrada', 'fecha_hora_inventario', 'fecha_hora_novedades', 'fecha_hora_nov_encierro', 'fecha_hora_post', 'fecha_hora_siniestradas', 'fecha_hora_lavados', 'fecha_hora_taller', 'fecha_hora_fuera', 'fecha_hora_exhibicion', 'fecha_hora_clientes', 'fecha_hora_azotea', 'fecha_hora_estadia', 'fecha_hora_servicios', 'fecha_hora_entrega', 'fecha_hora_servicio', 'fecha_hora_acceso', 'fecha_hora_altabrisa_servicio', 'fecha_hora_granel', 'fecha_hora_subaru', 'fecha_hora_subarutot', 'fecha_hora_m', 'fecha_hora_empresasub', 'fecha_hora_salidasubaru', 'fecha_hora_estacionamientosub', 'fecha_hora_porton', 'fecha_hora_acceso', 'fecha_hora_invaltabrisa', 'fecha_hora_vehiculos', 'fecha_hora_bitacora', 'fecha_hora_ingreso', 'fecha_hora_aceite', 'fecha_hora_nov_post'].forEach(id => setField(id, fechaHora));
    ['caseta_detalles', 'caseta_tots', 'caseta_demos', 'caseta_control', 'caseta_revision', 'caseta_unidades', 'caseta_proveedores', 'caseta_salida', 'caseta_entrada', 'caseta_inventario', 'caseta_novedades', 'caseta_nov_encierro', 'caseta_post', 'caseta_siniestradas', 'caseta_lavados', 'caseta_taller', 'caseta_fuera', 'caseta_exhibicion', 'caseta_clientes', 'caseta_azotea', 'caseta_estadia', 'caseta_servicios', 'caseta_entrega', 'caseta_servicio', 'caseta_acceso', 'caseta_altabrisa_servicio', 'caseta_granel', 'caseta_subaru', 'caseta_subaru_tot', 'caseta_subaru_m', 'caseta_empresasub', 'caseta_salida_subaru', 'caseta_estacionamiento_sub', 'caseta_porton', 'caseta_acceso', 'caseta_inventario_altabrisa', 'caseta_vehiculos', 'caseta_bitacora', 'caseta_ingreso', 'caseta_aceite', 'caseta_nov_post'].forEach(id => setField(id, caseta));
    ['turno_detalles', 'turno_tots', 'turno_demos', 'turno_control', 'turno_revision', 'turno_unidades', 'turno_proveedores', 'turno_salida', 'turno_entrada', 'turno_inventario', 'turno_novedades', 'turno_nov_encierro', 'turno_post', 'turno_siniestradas', 'turno_lavados', 'turno_taller', 'turno_fuera', 'turno_exhibicion', 'turno_caseta', 'turno_clientes', 'turno_azotea', 'turno_estadia', 'turno_servicios', 'turno_entrega', 'turno_servicio', 'turno_acceso', 'turno_altabrisa_servicio', 'turno_granel', 'turno_subaru', 'turno_subaru_tot', 'turno_subaru_m', 'turno_empresasub', 'turno_salida_subaru', 'turno_estacionamiento_sub', 'turno_porton', 'turno_acceso', 'turno_inventario_altabrisa', 'turno_vehiculos', 'turno_bitacora', 'turno_ingreso', 'turno_aceite', 'turno_nov_post'].forEach(id => setField(id, turno));
    ['Nombre_vigilante_detalles', 'Nombre_vigilante_tots', 'Nombre_vigilante_demos', 'Nombre_vigilante_control', 'Nombre_vigilante_revision', 'Nombre_vigilante_unidades', 'Nombre_vigilante_proveedores', 'Nombre_vigilante_salida', 'Nombre_vigilante_entrada', 'Nombre_vigilante_inventario', 'Nombre_vigilante_novedades', 'Nombre_vigilante_nov_encierro', 'Nombre_vigilante_post', 'Nombre_vigilante_siniestradas', 'Nombre_vigilante_lavados', 'Nombre_vigilante_taller', 'Nombre_vigilante_fuera', 'Nombre_vigilante_exhibicion', 'Nombre_vigilante_clientes', 'Nombre_vigilante_azotea', 'Nombre_vigilante_estadia', 'Nombre_vigilante_servicios', 'Nombre_vigilante_entrega', 'Nombre_vigilante_servicio', 'Nombre_vigilante_acceso', 'Nombre_altabrisa_servicio', 'Nombre_vigilante_granel', 'Nombre_vigilante_subaru', 'Nombre_vigilante_subarutot', 'Nombre_vigilante_m', 'Nombre_vigilante_empresasub', 'Nombre_vigilante_salidasubaru', 'Nombre_vigilante_estacionamientosub', 'Nombre_vigilante_porton', 'Nombre_vigilante_acceso', 'Nombre_vigilante_invaltabrisa', 'Nombre_vigilante_vehiculos', 'Nombre_vigilante_bitacora', 'Nombre_vigilante_ingreso', 'Nombre_vigilante_aceite', 'Nombre_vigilante_nov_post'].forEach(id => setField(id, vigilante));

    setField('hidden_fecha_hora', fechaHora);
    setField('hidden_id_turnos', turno);
    // setField('hidden_id_casetas', caseta);
    setField('hidden_nombre_vigilante', vigilante);
    document.getElementById('incidenciaForm').style.display = 'none';
    document.getElementById('detallesForm').style.display = 'block';

    document.querySelectorAll('.form-group').forEach((campo) => {
        const campoNombre = campo.querySelector('label') ? campo.querySelector('label').textContent.trim() : '';


        //esto es para encierro

        // Verificar si el campo es de gasolina y si el turno es 6
        if (turno === "6" && camposGasolina.includes(campoNombre)) {
            campo.style.display = "none";  // Ocultar campo
        } else {
            campo.style.display = "block";  // Mostrar campo
        }
    });
});
$(document).ready(function () {
    function actualizarFechaHora() {
        const ahora = new Date();
        const opciones = { timeZone: 'America/Mexico_City', hour12: false };
        const fechaHoraFormato = ahora.toLocaleString('sv-SE', opciones).replace(' ', 'T');
        $('.form-control.fechahora').val(fechaHoraFormato.replace('T', ' '));
    }

    actualizarFechaHora();
    setInterval(actualizarFechaHora, 1000);
});

// function mostrarSegundaEtapa() {
//     // Swal.fire({
//     //     title: 'Atención',
//     //     text: 'Es muy importante que primero complete y envíe cada uno de los formatos que se requieren. Una vez que haya terminado de llenar y enviar todos los formatos, deberá esperar hasta que falten solo 15 minutos para que su turno termine. Cuando eso suceda, aparecerá un botón que dice "Enviar Correo". Presione ese botón para completar su tarea antes de que su turno termine. Si no ve el botón, es porque su turno aún no ha llegado a los 15 minutos finales.',
//     //     icon: 'info',
//     //     confirmButtonText: 'Entendido'
//     // });
//     document.getElementById('primeraEtapa').style.display = 'none';
//     document.getElementById('detallesForm').style.display = 'none';
// }

//Funcion para el inicio de sesion
function mostrarSegundaEtapa() {
    var nombreVigilante = document.getElementById("Nombre_vigilante").value;

    if (nombreVigilante === "") {
        Swal.fire({
            title: 'Error',
            text: 'Se requiere el nombre del vigilante.',
            icon: "error",
            showConfirmButton: false,
            timer: 1500
        });
        location.reload();
        return;
    } else {
        document.getElementById('primeraEtapa').style.display = 'none';
        document.getElementById('detallesForm').style.display = 'none';
    }
}




document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('id_formatos').addEventListener('change', function () {
        const formatos = this.value;
        if (!formatos) {
            alert('Por favor, selecciona un formato.');
            return;
        }
        //nuevamente paso el id del formato que este contiene a los siguientes campos
        const setField = (id, value) => { const elem = document.getElementById(id); if (elem) elem.value = value; };
        ['formatos_tots', 'formatos_demos', 'formatos_control', 'formatos_revision', 'formatos_unidades', 'formatos_proveedores', 'formatos_salida', 'formatos_entrada', 'formatos_inventario', 'formatos_novedades', 'formatos_nov_encierro', 'formatos_post', 'formatos_siniestradas', 'formatos_lavados', 'formatos_taller', 'formatos_fuera', 'formatos_exhibicion', 'formatos_clientes', 'formatos_azotea', 'formatos_estadia', 'formatos_servicios', 'formatos_entrega', 'formatos_servicio_montejo', 'formatos_servicio_acceso', 'formatos_altabrisa_servicio', 'formatos_granel', 'formatos_subaru', 'formatos_subaru_tot', 'formatos_subaru_m', 'formatos_empresasub', 'formatos_salida_subaru', 'formatos_estacionamiento_sub', 'formatos_porton', 'formatos_acceso', 'formatos_inventario_altabrisa', 'formatos_vehiculos', 'formatos_bitacora', 'formatos_ingreso', 'formatos_aceite', 'formatos_nov_post'].forEach(id => setField(id, formatos));

        document.getElementById('incidenciaForm').style.display = 'none';
        document.getElementById('detallesForm').style.display = 'block';
    });
});

//una restriccion para los campps que tengan dicha funcion, limita el campo a que contengan mas de 6 digitos
function validateNumberInput(input) { input.value = input.value.replace(/\D/g, '').slice(0, 6); }

//aqui organizo la casetas con sus formatos y para que turno seran si seran matutino o nocturno
document.getElementById('id_turnos').addEventListener('change', function () {
    const turno = this.options[this.selectedIndex].dataset.nombre;
    const casetaSeleccionada = document.getElementById('id_casetas').value;  // Obtener el ID de la caseta seleccionada
    const formatos = document.getElementById('id_formatos').options;

    const formatosPorCasetaYTurno = {
        '3': { // ID de la caseta Área de demos
            'Matutino': [ // Es tal cual lo tengo escrito en base de datos 
                'Novedades Area de Demos',
                'Unidades nuevas entregadas a clientes',
                'Control de acceso a proveedores',
                'Control de proveedores TOTs',
                'Uso Unidades demos (Pruebas de manejo y/o diligencias)',

            ],
            'Nocturno': [
                'Novedades Area de Demos',
                'Revision de instalaciones',
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
                'Novedades',
                'Inventario de unidades nuevas en encierro / patio'
            ]
        },
        '16': { // ID de la caseta Postventa
            'Matutino': [
                'Novedades Postventa',
                'Servicios sin citas (ordenes tipo n clientes toyota)',
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
                'Novedades Servicios.',
                'Control de acceso a proveedores Montejo',

            ],
            'Nocturno': [
                'Novedades Servicios.',
                'Control de entrega de unidades en postventa',
                'Control de unidades en estacionamiento TOYOTA',
                'Postventa - bitacora de surtido de aceite bahias',
                'Postventa - bitácora de aceite granel',

            ]
        },
        '7': {// ID caseta subaru 
            'Matutino': [
                'Novedades Subaru.',
                'Salida Unidades TOTs',
                'Control de acceso a proveedores Subaru'
            ],
            'Nocturno': [
                'Novedades Subaru.',
                'Control de acceso a proveedores Subaru'
            ]
        },
        '5': {// ID Caseta subaru Empresa SUBARU Sucursal Mérida
            'Matutino': [
                'Novedades Subaru',
                'Control de entrega de unidades en Postventa Subaru',
                'Salida unidades ToTs subaru',
            ],
            'Nocturno': [
                'Novedades Subaru',
                'Control de unidades en estacionamiento SUBARU'
            ]
        },
        '2': { //ID Caseta Servicio Empresa TOYOTA Sucursal Altabrisa
            'Matutino': [
                'Novedades Servicios',
                'Postventa - bitácora de surtido de aceite bahías Altabrisa',
                'Postventa - Bitácora acceso vehículos a servicio sin cita',
                'Control de entrega de unidades en postventa Altabrisa'


            ],
            'Nocturno': [
                'Novedades Servicios',
                'Postventa - bitácora de surtido de aceite bahías Altabrisa',
                'Inventario de unidades en las instalaciones servicios'

            ]
        },
        '8': {// ID Caseta Portón rojo empresa TOYOTA sucursal Altabrisa
            'Matutino': [
                'Novedades Portón rojo',
                'Bitacora de control de acceso personal y vehicular',
                'Bitácora de control de vehículos utilitarios',
                'Control de ingreso/salida de unidades B&P',

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

//aqui determino que formatos y en que vista estan
document.getElementById('id_formatos').addEventListener('change', function () {
    const formatoSeleccionado = this.options[this.selectedIndex].text;

    const formularios = {
        //SUCURSAL TOYOTA CANCÚN

        //Nombre del formato tal cual esta en la base de datos // nombre del include

        // Caseta Área de demos
        'Novedades Area de Demos': 'Novedades_demos',
        'Novedades Postventa': 'Novedades_post',
        'Unidades nuevas entregadas a clientes': 'controlUnidades',
        'Control de proveedores TOTs': 'controlProv',
        'Uso Unidades demos (Pruebas de manejo y/o diligencias)': 'controlDemos',
        'Revision de instalaciones': 'instalaciones',
        'Inventario de unidades en exhibición': 'unidades',
        'Control de acceso a proveedores': 'controlProveedores',


        // Caseta Encierro
        'Novedades.': 'Novedades_encierro',
        'Novedades': 'Novedades_demos',
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
        'Servicios sin citas (ordenes tipo n clientes toyota)': 'taller_postventa',
        'Vehículos por siniestros (ORDENES TIPO B SEGUROS)': 'vehiculos_siniestros',
        'Vehículo para lavado (ORDENES TIPO I,D,A,S Y E INTERNAS Y EMPLEADOS)': 'vehiculo_lavado',

        //SUCURSAL TOYOTA MONTEJO

        //Caseta Servicio
        'Novedades Servicios.': 'novedad_servicio',
        'Control de entrega de unidades en postventa': 'Control_entrega_servicio',
        'Control de unidades en estacionamiento TOYOTA': 'Control_toyota_servicio',
        'Control de acceso a proveedores Montejo': 'control_acceso_proveedores',
        'Postventa - bitacora de surtido de aceite bahias': 'controlAceite',
        'Postventa - bitácora de aceite granel': 'BitacoraAceite',

        //SUCURSAL TOYOTA ALTABRISA
        'Novedades Servicios': 'novedad_servicio',
        'Control de entrega de unidades en postventa Altabrisa': 'Control_entrega_servicio',
        'Novedades Portón rojo': 'Novedades_porton_rojo',
        'Bitacora de control de acceso personal y vehicular': 'bitacora_acceso',
        'Inventario de unidades en las instalaciones': 'inventario_instalaciones',
        'Inventario de unidades en las instalaciones servicios': 'inventario_instalaciones',
        'Postventa - Bitácora acceso vehículos a servicio sin cita': 'bitacora_servicio',

        // Caseta Subaru
        'Salida Unidades TOTs': 'salida_unidades_subaru',
        'Novedades Subaru.': 'novedad_servicio',
        'Control de acceso a proveedores Subaru': 'control_acceso_subaru',

        //EMPRESA SUBARU SUCURSAL MÉRIDA 
        //CASETA SUBARU
        'Novedades Subaru': 'novedad_subaru',
        'Salida unidades ToTs subaru': 'salida_unidades_subaru',
        'Control de unidades en estacionamiento SUBARU': 'Control_subaru_servicio',
        'Bitácora de control de vehículos utilitarios': 'control_vehiculos',
        'Postventa - bitácora de surtido de aceite bahías Altabrisa': 'bitacora_bahias',
        'Control de ingreso/salida de unidades B&P': 'control_ingreso_salida',
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
document.getElementById('btnAtras', 'btnEnviar').addEventListener('click', function () {
    const primeraEtapa = document.getElementById('primeraEtapa');
    const incidenciaForm = document.getElementById('incidenciaForm');
    const detallesForm = document.getElementById('detallesForm');

    if (window.history.length > 1 && detallesForm.style.display === 'block') {
        detallesForm.classList.add('fade-out');

        setTimeout(function () {
            location.reload();
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

//esto es para el formato de bitacora acceso de la sucursal de altabrisa lo que hace es colocar el select2 este actualizara el campo
//puesto segun el empleado seleccionado
document.addEventListener('DOMContentLoaded', function () {
    const empleadoSelect = document.getElementById('empleadoSelect');
    const campoAsociadoInternoSelect = $('#campoAsociadoInterno');
    // const puestoInput = document.getElementById('puestoInput');
    const puestoInput = document.querySelector('.form-control.puestoInput');
    const nuevoEmpleadoForm = document.getElementById('nuevoEmpleadoForm');
    const empleadoNoRegistradoContainer = document.getElementById('empleadoNoRegistradoContainer');
    const agregarEmpleadoBtn = document.getElementById('agregarEmpleadoBtn');
    const empleadoNombreInput = $('#empleadoNombre');
    const empleadoNoRegistradoSelect = $('#empleadoNoRegistrado');
    // Inicializa Select2 solo si el elemento existe
    if (empleadoSelect) {
        $(empleadoSelect).select2({
            tags: true,
            tokenSeparators: [',', ' '],
            width: '100%',
            placeholder: "Selecciona un empleado",
            allowClear: true
        }).on('change', updatePuestoInput);
    }

    // Actualiza el input de puesto basado en la seleccion
    function updatePuestoInput() {
        const selectedOption = this.options[this.selectedIndex];
        puestoInput.value = selectedOption ? selectedOption.getAttribute('data-puesto') : '';
        console.log(updatePuestoInput);
    }


    if (empleadoNoRegistradoSelect.length) {
        // Inicializamos select2 en el select
        empleadoNoRegistradoSelect.select2({
            width: '100%',
            placeholder: "Selecciona un empleado",
            allowClear: true
        }).on('select2:select', function (e) {
            const puestoId = e.params.data.element.value;
            const puestoNombre = e.params.data.element.dataset.puestoNombre;
            if (puestoInput) {
                puestoInput.value = puestoNombre || '';
            }
            if (puestoInputId) {
                puestoInputId.value = puestoId || '';
            }
        });
    }

    if (campoAsociadoInternoSelect.length) {
        campoAsociadoInternoSelect.select2({
            width: '100%',
            placeholder: "Selecciona un empleado",
            allowClear: true
        }).on('select2:select', function (e) {
            const puesto = e.params.data.element.dataset.puesto;
            if (puestoInput) {
                puestoInput.value = puesto || '';
            }
        });
    } else {
        // console.log('Select2 de empleado no encontrado');
    }

    // Maneja el evento de envio del nuevo empleado
    if (nuevoEmpleadoForm) {
        nuevoEmpleadoForm.addEventListener('submit', handleNewEmployeeSubmit);
    }

    //este es un fetch para poder guardar un nuevo empleado
    function handleNewEmployeeSubmit(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const guardarBtn = document.getElementById('guardarBtn');
        const spinner = guardarBtn.querySelector('.spinner-border');

        guardarBtn.disabled = true;
        spinner.style.display = 'inline-block';

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al guardar el empleado');
                }
                return response.json();
            })
            .then(data => addNewEmployeeOption(data))
            .catch(error => console.error('Error:', error))
            .finally(() => {

                spinner.style.display = 'none';
                guardarBtn.disabled = false;
            });
    }

    //tomo sus valores para poder manipularlos y asignar automaticamente eso datos a los campos que corresponden
    function addNewEmployeeOption(data) {
        const newOption = new Option(data.nombres, data.id_empleado, false, true);
        newOption.setAttribute('data-nombres', data.nombres);
        newOption.setAttribute('data-puesto-nombre', data.puestoNombre);

        empleadoNoRegistradoSelect.append(newOption).trigger('change');
        empleadoNoRegistradoSelect.val(data.id_empleado).trigger('change');

        $('#empleadoNombre').val(data.nombres);
        puestoInput.value = data.puestoNombre;
        alert(data.message || 'Empleado agregado exitosamente.');
        nuevoEmpleadoForm.reset();
        // console.log(data.message);
    }

    // cambia el campo asociado interno al cambiar el select de no registrados
    empleadoNoRegistradoSelect.on('change', function () {
        const selectedValue = $(this).val();
        $('#campoAsociadoInterno').toggle(!selectedValue);
        const empleadoNombre = $(this).find('option:selected').data('nombres');
        $('#empleadoNombre').val(empleadoNombre);

        if (empleadoNombreInput.val()) {
            $('label:contains("Nombre asociado interno")').hide();
        } else {
            $('label:contains("Empleado no registrado")').hide();
            $('label:contains("Nombre asociado interno")').show();
        }
    });

    $('#empleadoNoRegistrado').on('change', function () {
        var selectedOption = $(this).find('option:selected');
        var empleadoNombre = selectedOption.data('nombres');
        var puestoId = selectedOption.data('puesto-id');

        $('#empleadoNombre').val(empleadoNombre);
        // console.log('Empleado seleccionado:', empleadoNombre);

        $('#puestoInput').val(puestoId);
        // console.log('Puesto asignado', puestoId);

        if (selectedOption.val()) {
            $('#empleadoNoRegistradoContainer').show();
            $('label:contains("Empleado no registrado")').show();
        } else {
            $('#empleadoNoRegistradoContainer').hide();
            $('label:contains("Empleado no registrado")').hide();
        }
    });

    // $(document).ready(function () {
    //     $('label:contains("Empleado no registrado")').hide();
    // });


    // Muestra el campo de empleado no registrado
    if (agregarEmpleadoBtn) {
        agregarEmpleadoBtn.addEventListener('click', () => {
            empleadoNoRegistradoContainer.style.display = 'block'; // Muestra el campo
        });
    }
});

// Función para alternar el formulario
function toggleForm(showSelect) {
    const formNuevoEmpleado = document.getElementById('formNuevoEmpleado');
    const selectEmpleados = document.getElementById('selectEmpleadosNoRegistrados');

    formNuevoEmpleado.style.display = showSelect ? 'none' : 'block';
    selectEmpleados.style.display = showSelect ? 'block' : 'none';

    if (showSelect) {
        $('#empleadoNoRegistrado').select2('open');
    }
}

// es para el campo otro de los selects
function toggleOtroUnidad(select) {
    const textunidad = select.nextElementSibling;
    const otrotextunidad = textunidad.querySelector('textarea');

    textunidad.style.display = (select.value === 'otro') ? 'block' : 'none';

    if (select.value !== 'otro') {
        otrotextunidad.value = select.value;
        otrotextunidad.removeAttribute('required');
    } else {
        otrotextunidad.setAttribute('required', 'required');
    }
}
function ajustarValorCampo(form) {
    const selectElements = form.querySelectorAll('select[name^="campos["]');
    let valid = true;

    selectElements.forEach(selectElement => {
        const otrosTextarea = selectElement.nextElementSibling.querySelector('textarea');

        if (selectElement.value === 'otro') {
            selectElement.value = otrosTextarea.value.trim();
        }

        if (selectElement.value === '' && otrosTextarea.value.trim() === '') {
            alert('Por favor, especifica otra unidad.');
            valid = false;
        }
    });

    return valid;
}

document.addEventListener('alertaAbierta', function () {
    // Resetea los campos de detallesForm
    document.getElementById('detallesForm').reset();
});


//esta es la funcion para poder subir las fotos en un futuro esta hecha de igual forma en las vistas de cada formato algunas las tienen
//algunas no
function updatePhotoName(input, type) {
    const fileName = input.files[0] ? input.files[0].name : '';
    const message = type === 'subida' ? 'Foto subida: ' : 'Foto tomada: ';
    const mensajeFoto = document.getElementById('mensaje-foto');

    if (fileName) {
        mensajeFoto.innerText = message + fileName;
        mensajeFoto.style.display = 'block';
    } else {
        mensajeFoto.style.display = 'none';
    }
}

//esta funcion es un validador para todos los formatos 
function submitAndResetForm(boton) {
    boton.disabled = true;
    setTimeout(() => {
        boton.disabled = false;
    }, 5000);
    const formulario = boton.closest('form');
    const elementos = Array.from(formulario.elements);
    let esValido = true;
    let mensajeError = "";

    const validaciones = [
        { clase: 'ErrorRadios', mensaje: 'Por favor, selecciona un tipo de situación.' },
        { clase: 'ErrorResiduos', mensaje: 'Por favor, selecciona un tipo de residuo.' },
        { clase: 'ErrorPuerta', mensaje: 'Por favor, selecciona un tipo de Puerta.' },
        { clase: 'ErrorLuces', mensaje: 'Por favor, selecciona un tipo de Luces.' },
        { clase: 'ErrorAire', mensaje: 'Por favor, selecciona un tipo de Aire Acondicionado.' },
        { clase: 'ErrorTV', mensaje: 'Por favor, selecciona un tipo de TV.' },
        { clase: 'ErrorUbicacion', mensaje: 'Por favor, selecciona un tipo de ubicación.' },
        { clase: 'ErrorCondicion', mensaje: 'Por favor, selecciona un tipo de Condición de seguridad.' },
        { clase: 'ErrorDaños', mensaje: 'Por favor, selecciona un tipo de condición de daño.' }
    ];

    validaciones.forEach(({ clase, mensaje }) => {
        const seccion = formulario.querySelector(`section.${clase}`);
        if (seccion && getComputedStyle(seccion).display !== 'none') {
            const radios = seccion.querySelectorAll('input[type="radio"]');
            const selected = Array.from(radios).some(radio => radio.checked);


            if (!selected) {
                event.preventDefault();
                esValido = false;
                mensajeError = mensaje;
            }
        }
    });

    //estas funciones solo se deben hacer para dicho formato
    if (formulario.id === 'bitacora_acceso_porton') {
        const radioSeleccionado = formulario.querySelector('input[name="horaSelect"]:checked');
        if (!radioSeleccionado) {
            esValido = false;
            mensajeError = "Por favor, selecciona un tipo de hora.";
        }
        $('#campoAsociadoInterno').show();
        $('#empleadoSelect').show();
        $('label:contains("Nombre asociado interno")').show();
        $('label:contains("Empleado no registrado:")').hide();
        $('#empleadoNoRegistradoContainer').hide();
        //mostrar el boton con id agregarEmpleadoBtn
        $('#agregarEmpleadoBtn').show();
        $('label:contains("Nombre asociado interno")').show();
        $('#campoAsociadoInterno').show();
        $('label:contains("Puesto")').show();
        $('#puestoid').show();
        $('#unidadID').show();
        $('label:contains("Unidad - Vehiculo personal")').show();
        $('#placasID').show();
        $('label:contains("Placas")').show();
        $('label:contains("Observaciones / Comentarios")').show();
        $('#observacionesID').show();
        $('#botonenviarID').show();
    }

    elementos.forEach(elemento => {
        const esOpcional = !elemento.hasAttribute('required');
        const esOculto = elemento.type === 'hidden' || elemento.closest('.d-none') !== null || elemento.readOnly;

        if (!esOpcional && !esOculto && !elemento.disabled) {
            const esVacio =
                (['text', 'textarea', 'number', 'email', 'date', 'datetime', 'time'].includes(elemento.type) && elemento.value.trim() === '') ||
                (['checkbox', 'radio', 'select'].includes(elemento.type) && !formulario.querySelector(`[name="${elemento.name}"]:checked`)) ||
                (elemento.tagName === 'SELECT' && elemento.value === '');

            //valido que el campo vin tenga exactamente los 6 digitos su no lo tiene le muestro un error soicitando
            //los 6 digitos
            if (elemento.classList.contains('vin')) {
                const valorVin = elemento.value.trim();
                if (valorVin.length !== 6 || !/^\d{6}$/.test(valorVin)) {
                    esValido = false;
                    mensajeError = "El VIN debe tener exactamente 6 dígitos numéricos.";
                }
            }

            if (esVacio) {
                esValido = false;

                const label = formulario.querySelector(`label[for="${elemento.id}"]`);


                // const label = formulario.querySelector(`label[for="campos[{{ $campo->id_campo }}]"]`);
                const nombreCampo = label ? label.textContent.trim() : elemento.name || "campo requerido";
                mensajeError = mensajeError || `Favor de completar el campo: ${nombreCampo}`;

            }
        }
    });

    if (!esValido) {
        $(document).ready(function () {
            Swal.fire({
                title: "Error!",
                text: mensajeError,
                icon: "error"

            });
        });
        return;
    }

    formulario.submit(boton);

    // Después de enviar el formulario, restablecemos los campos
    setTimeout(() => {
        elementos.forEach(elemento => {
            const esOculto = elemento.type === 'hidden' || elemento.closest('.d-none') !== null || elemento.readOnly;
            const select2 = $('#campoAsociadoInterno');

            if (!esOculto && !elemento.disabled) {
                if (['checkbox', 'radio'].includes(elemento.type)) {
                    elemento.checked = false;
                } else if (elemento.tagName === 'SELECT') {
                    elemento.selectedIndex = 0;
                } else {
                    elemento.value = '';
                    $('#campoAsociadoInterno').val('').trigger('change');
                }
            }
        });
    }, 500);
}




//Esta es la formula para el formato de bahias
//Consumo por bahías = Acum Final  menos Acum Inicial por día
//Suma de Consumo por bahías 1-2, 3-4, 5-6, 7-8, 9-10,  =Total de surtido por día
// funcion general para calcular el consumo por bahía
function calcularConsumo(prefix, totalSurtidoClass) {
    const totalSurtido = document.querySelector(totalSurtidoClass);
    let totalConsumo = 0;

    for (let i = 1; i <= 10; i++) {
        const bahiaInicial = document.querySelector(`.${prefix}${i}-inicial`);
        const bahiaFinal = document.querySelector(`.${prefix}${i}-final`);

        if (bahiaInicial && bahiaFinal) {
            const consumoBahia = parseFloat(bahiaFinal.value || 0) - parseFloat(bahiaInicial.value || 0);
            totalConsumo += consumoBahia;
            // console.log(`Consumo de bahía ${i}:`, consumoBahia);
        }
    }

    if (totalSurtido) {
        totalSurtido.value = totalConsumo.toFixed(2);
    }
}

// Calcular consumo para Altabrisa
calcularConsumo('bahiaAL', '.total-surtidoAl');

// Calcular consumo para Montejo
calcularConsumo('bahia', '.total-surtidoMO');

// agregue mas bahias si en un futuro este llegara a crecer
const bahiasAL = ['bahiaAL1', 'bahiaAL2', 'bahiaAL3', 'bahiaAL4', 'bahiaAL5', 'bahiaAL6', 'bahiaAL7', 'bahiaAL8', 'bahiaAL9', 'bahiaAL10'];
const bahiasMO = ['bahia1', 'bahia2', 'bahia3', 'bahia4', 'bahia5', 'bahia6', 'bahia7', 'bahia8', 'bahia9', 'bahia10'];

// Agregar eventos para Altabrisa
bahiasAL.forEach(bahia => {
    const bahiaInicial = document.querySelector(`.${bahia}-inicial`);
    const bahiaFinal = document.querySelector(`.${bahia}-final`);

    if (bahiaInicial && bahiaFinal) {
        bahiaInicial.addEventListener("input", () => calcularConsumo('bahiaAL', '.total-surtidoAl'));
        bahiaFinal.addEventListener("input", () => calcularConsumo('bahiaAL', '.total-surtidoAl'));
    }
});

// Agregar eventos para bahías Montejo
bahiasMO.forEach(bahia => {
    const bahiaInicial = document.querySelector(`.${bahia}-inicial`);
    const bahiaFinal = document.querySelector(`.${bahia}-final`);

    if (bahiaInicial && bahiaFinal) {
        bahiaInicial.addEventListener("input", () => calcularConsumo('bahia', '.total-surtidoMO'));
        bahiaFinal.addEventListener("input", () => calcularConsumo('bahia', '.total-surtidoMO'));
    }
});

//aqui oculto el Total Surtido
$(document).ready(function () {
    $('label:contains("Total surtido")').closest('tr').hide();
});

//boton enviarCorreo y la configuracion del turno
$('#crearIncidenciaBtn').on('click', function () {
    iniciarTurno();
});


// function iniciarTurno() {
//     const selectedOption = document.querySelector('option[data-hora-fin]');
//     if (!selectedOption || !selectedOption.hasAttribute('data-hora-fin')) {
//         return;
//     }
//     const horaFin = selectedOption.getAttribute('data-hora-fin');
//     if (!horaFin) {
//         return;
//     }
//     const horaParts = horaFin.split(':');
//     if (horaParts.length < 2 || isNaN(horaParts[0]) || isNaN(horaParts[1])) {
//         return;
//     }
//     const ahora = new Date();
//     const horaFinDate = new Date(ahora);
//     horaFinDate.setHours(horaParts[0], horaParts[1], 0, 0);
//     if (isNaN(horaFinDate.getTime())) {
//         return;
//     }

//     const diferencia = horaFinDate - ahora;
//     if (diferencia <= 0) {
//         limpiarEstado();
//         return;
//     }

//     const tiempoAlerta = diferencia - 900000;
//     setTimeout(() => {
//         const incidenciaForm = document.getElementById('incidenciaForm');
//         const btnEnviar = document.getElementById('btnEnviar');

//         if (incidenciaForm && btnEnviar) {
//             const incidenciaFormOculto = window.getComputedStyle(incidenciaForm).display === 'none';
//             if (incidenciaFormOculto) {
//                 btnEnviar.style.display = 'block';
//             } else {
//                 btnEnviar.style.display = 'none';
//             }
//         }

//         Swal.fire({
//             title: '¡Alerta!',
//             text: 'Faltan 15 minutos para que termine el turno.',
//             icon: 'warning',
//             confirmButtonText: 'Cerrar',
//             toast: true,
//             position: 'bottom-end',
//             timer: horaFinDate,
//             timerProgressBar: true,
//         });
//     }, tiempoAlerta);

//     setTimeout(() => {
//         limpiarEstado();
//     }, diferencia);
// }

//esta e

//esta es la funcion de turno determina en que momento acabara el turnol vigilate para posteriormente mostrara la alerta de advertencia
//y mostrar el boton de envio de correos al concluir el turno el boton se vuelve a ocultar
function iniciarTurno() {
    const selectedOption = document.querySelector('option[data-hora-fin]');
    if (!selectedOption || !selectedOption.hasAttribute('data-hora-fin')) {
        return;
    }
    const horaFin = selectedOption.getAttribute('data-hora-fin');
    if (!horaFin) {
        return;
    }
    const horaParts = horaFin.split(':');
    if (horaParts.length < 2 || isNaN(horaParts[0]) || isNaN(horaParts[1])) {
        return;
    }
    const ahora = new Date();
    const horaFinDate = new Date(ahora);
    horaFinDate.setHours(horaParts[0], horaParts[1], 0, 0);
    if (isNaN(horaFinDate.getTime())) {
        return;
    }

    const diferencia = horaFinDate - ahora;
    if (diferencia <= 0) {
        limpiarEstado();
        return;
    }

    const tiempoAlerta = diferencia - 900000;
    setTimeout(() => {
        Swal.fire({
            title: '¡Alerta!',
            text: 'Faltan 15 minutos para que termine el turno.',
            icon: 'warning',
            confirmButtonText: 'Cerrar',
            toast: true,
            position: 'bottom-end',
            timer: diferencia, // Duración hasta la hora de fin
            timerProgressBar: true,
        });

        const btnEnviar = document.getElementById('btnEnviar');
        if (btnEnviar) {
            btnEnviar.style.display = 'block';
        }
    }, tiempoAlerta);
    setTimeout(() => {
        limpiarEstado();
    }, diferencia);
}

//boton enviarcorreo
//deshabilitar el boton btnEnviar por 5s
var btnEnviar = document.getElementById('btnEnviar');
btnEnviar.addEventListener('click', function (event) {
    // Deshabilitar el botón
    event.preventDefault();
    this.form.submit();
    btnEnviar.disabled = true;
    setTimeout(function () {
        btnEnviar.disabled = false;
    }, 5000);
});
function limpiarEstado() {
    const btnEnviar = document.getElementById('btnEnviar');
    if (btnEnviar) {
        btnEnviar.style.display = 'none';
    }
    const selectedOption = document.querySelector('option[data-hora-fin]');
    if (selectedOption) {
        selectedOption.removeAttribute('data-hora-fin');
    }
}

// iniciarTurno();


// $(document).ready(function () {
//     EmpleadosSinSalida();
// });


// esta funcion es para el formato de bitacora para poder mostrar los empleados a los que les hace falta una hora de salida
//esta consulta viene del incidenciasController en el metodo obtenerHoraSalida
function EmpleadosSinSalida() {
    $.ajax({
        url: '/obtenerSalida',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            let data = Array.isArray(response) ? response : Object.values(response);
            $('#miSalida').empty().append('<option value="">Selecciona una opción</option>');

            data.forEach(function (item) {
                let valorCampo34 = item.valor_campo_34;
                let empleado67 = item.empleados?.empleado_67 !== 'N/A' ? item.empleados?.empleado_67 : null;
                let empleado76 = item.empleados?.empleado_76 !== 'N/A' ? item.empleados?.empleado_76 : null;
                let empleadoTexto = `${empleado67 || empleado76 || 'Empleado no disponible'} ${valorCampo34 === null || valorCampo34 === 'N/A' ? '(Sin hora de salida)' : ''}`;
                let option = $('<option>', {
                    text: empleadoTexto,
                    value: item.id_incidencias
                });
                $('#miSalida').append(option);
            });

            $('#miSalida').select2({
                placeholder: 'Selecciona una opción',
                allowClear: true,
                minimumResultsForSearch: 0,
                width: '100%',
                dropdownParent: $('#HoraModal')
            });


            Swal.fire({
                title: 'Actualización',
                text: 'Se actualizaron los empleados',
                icon: 'success',
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__slideInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__slideOutUp'
                }
            });

            $('#miSalida').on('change', function () {
                const selectedIncidencia = $(this).val();
                if (selectedIncidencia) {
                    const selectedItem = data.find(item => item.id_incidencias == selectedIncidencia);
                    if (selectedItem) {
                        $('#empleadoSalida').val(`${selectedItem.empleados?.empleado_67 || selectedItem.empleados?.empleado_76 || 'Empleado no disponible'}`);
                        $('#id_fecha_hora_Salida').val(selectedItem.fecha_hora || 'Fecha y hora no disponibles');
                        $('#id_incidencias_Salida').val(selectedItem.id_incidencias);
                    }
                } else {
                    $('#empleadoSalida').val('');
                    $('#id_fecha_hora_Salida').val('');
                    $('#id_incidencias_Salida').val('');
                }
            });
        },
        error: function (error) {
            console.error("Error en la solicitud:", error);
        }
    });
}

// $('#ActualizarHora').on('click', function () {
//     EmpleadosSinSalida();
// });

// esta parte es un ajax para poder actualizar el campo hora de salida 
$(document).ready(function () {
    // EmpleadosSinSalida();
    $('#actualizarHoraForm').on('submit', function (e) {
        e.preventDefault();
        let submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');

        let formData = {
            id_incidencias: $('#id_incidencias_Salida').val(),
            HoraSalida: $('#Hora_salida').val(),
        };
        $.ajax({
            url: '/actualizar-salida',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                submitButton.prop('disabled', false).html('Guardar cambios');
                if (response.success) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.success,
                        showConfirmButton: false,
                        timer: 1500,

                    });
                    $('#actualizarHoraForm')[0].reset();
                    $('#cerrarHora').click();
                    EmpleadosSinSalida();
                    $('#miSalida').val('').trigger('change');
                    $('#actualizarHoraForm input').val('');
                    $('#actualizarHoraForm label.error').remove();
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Error en la solicitud',
                        showConfirmButton: true
                    });
                }
            },
            error: function (xhr) {
                submitButton.prop('disabled', false).html('Guardar cambios');
                alert('Ocurrió un error: ' + xhr.responseJSON.message);
            },
        });
    });
});
//aqui utilizo jquuery para poder realizar los cambios unicamente en el formato de bitacora acceso porton de la sucursal de altabrisa
//cuando se selecciona una opocion que cambio deberia realizar 
$(document).ready(function () {
    var formSelector = '#bitacora_acceso_porton';
    $(`${formSelector} label:contains("Empleado no registrado")`).hide();
    $(`${formSelector} #campoHoraEntrada`).hide();
    $(`${formSelector} #campoHoraSalida`).hide();
    $(`${formSelector} label:contains("Hora de entrada")`).hide();
    $(`${formSelector} label:contains("Hora de salida")`).hide();
    $(`${formSelector} #agregarhoraBtn`).hide();
    //mostrar el boton con id agregarEmpleadoBtn
    $(`${formSelector} #agregarEmpleadoBtn`).show();
    $(`${formSelector} label:contains("Nombre asociado interno")`).show();
    $(`${formSelector} #campoAsociadoInterno`).show();
    $(`${formSelector} label:contains("Puesto")`).show();
    $(`${formSelector} #puestoid`).show();
    $(`${formSelector} #unidadID`).show();
    $(`${formSelector} label:contains("Unidad - Vehiculo personal")`).show();
    $(`${formSelector} #placasID`).show();
    $(`${formSelector} label:contains("Placas")`).show();
    $(`${formSelector} label:contains("Observaciones / Comentarios")`).show();
    $(`${formSelector} #observacionesID`).show();
    $(`${formSelector} #botonenviarID`).show();
    $(`${formSelector} input[name="horaSelect"]`).change(function () {
        $(`${formSelector} #campoHoraEntrada`).hide();
        $(`${formSelector} #campoHoraSalida`).hide();
        $(`${formSelector} input[type="time"]`).removeAttr('required');
        if ($(this).val() === 'entrada') {
            $(`${formSelector} #campoHoraEntrada`).show();
            $(`${formSelector} label:contains("Hora de entrada")`).show();
            $(`${formSelector} #campoHoraEntrada input`).attr('required', true);
            $(`${formSelector} #agregarhoraBtn`).hide();

            $(`${formSelector} label:contains("Hora de salida")`).hide();
            //mostrar el boton con id agregarEmpleadoBtn
            $(`${formSelector} #agregarEmpleadoBtn`).show();
            $(`${formSelector} label:contains("Nombre asociado interno")`).show();
            $(`${formSelector} #campoAsociadoInterno`).show();
            //ocultar label e inputs de los formularios
            $(`${formSelector} label:contains("Puesto")`).show();
            $(`${formSelector} #puestoid`).show();
            $(`${formSelector} #unidadID`).show();
            $(`${formSelector} label:contains("Unidad - Vehiculo personal")`).show();
            $(`${formSelector} #placasID`).show();
            $(`${formSelector} label:contains("Placas")`).show();
            $(`${formSelector} label:contains("Observaciones / Comentarios")`).show();
            $(`${formSelector} #observacionesID`).show();
            $(`${formSelector} #botonenviarID`).show();
        } else if ($(this).val() === 'salida') {
            EmpleadosSinSalida();
            $(`${formSelector} #agregarhoraBtn`).show();
            $(`${formSelector} label:contains("Hora de entrada")`).hide();
            $(`${formSelector} input[type="time"]`).attr('required', true);
            //ocultar el boton con id agregarEmpleadoBtn
            $(`${formSelector} #agregarEmpleadoBtn`).hide();
            $(`${formSelector} label:contains("Nombre asociado interno")`).hide();
            $(`${formSelector} #campoAsociadoInterno`).hide();
            $(`${formSelector} label:contains("Hora de salida")`).hide();
            $(`${formSelector} label:contains("Puesto")`).hide();
            $(`${formSelector} #puestoid`).hide();
            $(`${formSelector} #unidadID`).hide();
            $(`${formSelector} label:contains("Unidad - Vehiculo personal")`).hide();
            $(`${formSelector} #placasID`).hide();
            $(`${formSelector} label:contains("Placas")`).hide();
            $(`${formSelector} label:contains("Observaciones / Comentarios")`).hide();
            $(`${formSelector} #observacionesID`).hide();
            $(`${formSelector} #botonenviarID`).hide();

        } else if ($(this).val() === 'ambas') {
            $(`${formSelector} #campoHoraEntrada`).show();
            $(`${formSelector} #campoHoraSalida`).show();
            $(`${formSelector} label:contains("Hora de entrada")`).show();
            $(`${formSelector} label:contains("Hora de salida")`).show();
            $(`${formSelector} #agregarhoraBtn`).hide();
            $(`${formSelector} input[type="time"]`).attr('required', true);
            //mostrar el boton con id agregarEmpleadoBtn
            $(`${formSelector} #agregarEmpleadoBtn`).show();
            $(`${formSelector} label:contains("Nombre asociado interno")`).show();
            $(`${formSelector} #campoAsociadoInterno`).show();
            $(`${formSelector} label:contains("Puesto")`).show();
            $(`${formSelector} #puestoid`).show();
            $(`${formSelector} #placasID`).show();
            $(`${formSelector} label:contains("Placas")`).show();
            $(`${formSelector} label:contains("Observaciones / Comentarios")`).show();
            $(`${formSelector} #observacionesID`).show();
            $(`${formSelector} #botonenviarID`).show();
        }
    });
    $(`${formSelector}`).submit(function (e) {
        if (!$(`${formSelector} input[name="horaSelect"]:checked`).length) {
            $(`${formSelector} #horaSelectError`).show();
            e.preventDefault();
        } else {
            $(`${formSelector} #horaSelectError`).hide();
        }
    });
});

$(document).ready(function () {
    $('.desab').on('focus mousedown selectstart', function (e) {
        e.preventDefault();
    });
});
$(document).ready(function () {
    function toggleAriaHidden(modalId) {
        $(modalId).on('show.bs.modal', function () {
            $(this).removeAttr('aria-hidden');
        });

        $(modalId).on('hidden.bs.modal', function () {
            $(this).attr('aria-hidden', 'true');
        });
    }

    toggleAriaHidden('#HoraModal');
    toggleAriaHidden('#agregarEmpleadoModal');
});



$(document).ready(function () {
    var formSelector = '#salida_tots_subaru';
    //hora entrada y salida
    $(`${formSelector} #campoHoraEntrada`).hide();
    $(`${formSelector} #HoraKmEntrada`).hide();
    $(`${formSelector} #campoHoraSalida`).hide();
    $(`${formSelector} label:contains("Hora de entrada")`).hide();
    $(`${formSelector} label:contains("Hora de salida")`).hide();
    //km entrada y salida
    $(`${formSelector} #kmEntrada`).hide();
    $(`${formSelector} #kmSalida`).hide();
    $(`${formSelector} label:contains("KM de entrada")`).hide();
    $(`${formSelector} label:contains("KM de salida")`).hide();

    $(`${formSelector} input[name="horaSelect"]`).change(function () {
        $(`${formSelector} #campoHoraEntrada`).hide();
        $(`${formSelector} #campoHoraSalida`).hide();
        $(`${formSelector} input[type="time"]`).removeAttr('required');
        $(`${formSelector} input[type="number"]`).removeAttr('required');
        if ($(this).val() === 'entrada') {
            //hora entrada
            FolioSinEntrada();
            $(`${formSelector} #campoHoraEntrada`).hide();
            $(`${formSelector} label:contains("Hora de entrada")`).hide();
            // $(`${formSelector} #campoHoraEntrada input`).attr('required', true);
            //km entrada
            $(`${formSelector} #kmEntrada`).hide();
            $(`${formSelector} label:contains("KM de entrada")`).hide();
            $(`${formSelector} #HoraKmEntrada`).show();
            $(`${formSelector} #kmEntrada input`).attr('required', true);
            //hora salida oculta y km
            $(`${formSelector} label:contains("Hora de salida")`).hide();
            $(`${formSelector} #campoHoraSalida`).hide();
            $(`${formSelector} #kmSalida`).hide();
            $(`${formSelector} label:contains("KM de salida")`).hide();
            //campos, requeridos a ocultar
            $(`${formSelector} label:contains("Fecha")`).hide();
            $(`${formSelector} #fechaTOT`).hide();
            $(`${formSelector} label:contains("Placas")`).hide();
            $(`${formSelector} #placasTOT`).hide();
            $(`${formSelector} label:contains("Unidad")`).hide();
            $(`${formSelector} #selectUnidad`).hide();
            $(`${formSelector} label:contains("VIN (6 últimos dígitos)")`).hide();
            $(`${formSelector} #VINtot`).hide();
            $(`${formSelector} label:contains("Nombre Taller")`).hide();
            $(`${formSelector} #TallerTOT`).hide();
            $(`${formSelector} label:contains("Persona que retira la unidad (Proveedor)")`).hide();
            $(`${formSelector} #proveedorTOT`).hide();
            $(`${formSelector} label:contains("Folio / Num de pase")`).hide();
            $(`${formSelector} #folioTOT`).hide();
            $(`${formSelector} label:contains("Observaciones / Comentarios")`).hide();
            $(`${formSelector} #comentariosTOT`).hide();
            $(`${formSelector} #BotonEnvio`).hide();
        } else if ($(this).val() === 'salida') {
            //hora salida
            $(`${formSelector} #HoraKmEntrada`).hide();
            $(`${formSelector} label:contains("Hora de salida")`).show();
            $(`${formSelector} #campoHoraSalida`).show();
            $(`${formSelector} #campoHoraSalida input`).attr('required', true);
            //km salida
            $(`${formSelector} #kmSalida`).show();
            $(`${formSelector} label:contains("KM de salida")`).show();
            $(`${formSelector} #kmSalida input`).attr('required', true);
            //km de entrada oculta y km
            $(`${formSelector} #campoHoraEntrada`).hide();
            $(`${formSelector} label:contains("Hora de entrada")`).hide();
            $(`${formSelector} #kmEntrada`).hide();
            $(`${formSelector} label:contains("KM de entrada")`).hide();
            //campos, requeridos a ocultar
            $(`${formSelector} label:contains("Fecha")`).show();
            $(`${formSelector} #fechaTOT`).show();
            $(`${formSelector} label:contains("Placas")`).show();
            $(`${formSelector} #placasTOT`).show();
            $(`${formSelector} label:contains("Unidad")`).show();
            $(`${formSelector} #selectUnidad`).show();
            $(`${formSelector} label:contains("VIN (6 últimos dígitos)")`).show();
            $(`${formSelector} #VINtot`).show();
            $(`${formSelector} label:contains("Nombre Taller")`).show();
            $(`${formSelector} #TallerTOT`).show();
            $(`${formSelector} label:contains("Persona que retira la unidad (Proveedor)")`).show();
            $(`${formSelector} #proveedorTOT`).show();
            $(`${formSelector} label:contains("Folio / Num de pase")`).show();
            $(`${formSelector} #folioTOT`).show();
            $(`${formSelector} label:contains("Observaciones / Comentarios")`).show();
            $(`${formSelector} #comentariosTOT`).show();
            $(`${formSelector} #BotonEnvio`).show();
        } else if ($(this).val() === 'ambas') {
            //hora
            $(`${formSelector} #HoraKmEntrada`).hide();
            $(`${formSelector} #campoHoraEntrada`).show();
            $(`${formSelector} #campoHoraSalida`).show();
            $(`${formSelector} label:contains("Hora de entrada")`).show();
            $(`${formSelector} label:contains("Hora de salida")`).show();
            $(`${formSelector} input[type="time"]`).attr('required', true);
            //km
            $(`${formSelector} #kmEntrada`).show();
            $(`${formSelector} #kmSalida`).show();
            $(`${formSelector} label:contains("KM de entrada")`).show();
            $(`${formSelector} label:contains("KM de salida")`).show();
            $(`${formSelector} input[type="number"]`).attr('required', true);
            //campos, requeridos a ocultar
            $(`${formSelector} label:contains("Fecha")`).show();
            $(`${formSelector} #fechaTOT`).show();
            $(`${formSelector} label:contains("Placas")`).show();
            $(`${formSelector} #placasTOT`).show();
            $(`${formSelector} label:contains("Unidad")`).show();
            $(`${formSelector} #selectUnidad`).show();
            $(`${formSelector} label:contains("VIN (6 últimos dígitos)")`).show();
            $(`${formSelector} #VINtot`).show();
            $(`${formSelector} label:contains("Nombre Taller")`).show();
            $(`${formSelector} #TallerTOT`).show();
            $(`${formSelector} label:contains("Persona que retira la unidad (Proveedor)")`).show();
            $(`${formSelector} #proveedorTOT`).show();
            $(`${formSelector} label:contains("Folio / Num de pase")`).show();
            $(`${formSelector} #folioTOT`).show();
            $(`${formSelector} label:contains("Observaciones / Comentarios")`).show();
            $(`${formSelector} #comentariosTOT`).show();
            $(`${formSelector} #BotonEnvio`).show();
        }
    });
    $(`${formSelector}`).submit(function (e) {
        if (!$(`${formSelector} input[name="horaSelect"]:checked`).length) {
            $(`${formSelector} #horaSelectError`).show();
            e.preventDefault();
        } else {
            $(`${formSelector} #horaSelectError`).hide();
        }
    });
});

$('#EntradaModal').on('show.bs.modal', function () {
    FolioSinEntrada();
});

//Entrada la caseta subaru
function FolioSinEntrada() {
    let idFormatos = $('#formatos_subaru_tot').val();
    $.ajax({
        url: '/obtenerEntrada',
        type: 'GET',
        //comentar si es necesario
        data: { formatos_subaru_tot: idFormatos },
        dataType: 'json',
        success: function (response) {
            // Convierte la respuesta a un array si no lo es
            let data = Array.isArray(response) ? response : Object.values(response);
            $('#miSelect').empty().append('<option value="">Selecciona una opción</option>');
            data.forEach(function (item) {
                let horaEntrada = item.HoraEntrada !== 'N/A' && item.HoraEntrada !== null ? item.HoraEntrada : '(Sin hora de entrada)';
                let kmEntrada = item.KmEntrada !== 'N/A' && item.KmEntrada !== null ? item.KmEntrada : '(Sin Km de entrada)';
                let folio = item.Folio || 'Folio no disponible';
                let optionText = `Folio: ${folio} - Hora: ${horaEntrada} - Km: ${kmEntrada}`;
                let option = $('<option>', {
                    text: optionText,
                    value: item.id_incidencias
                });
                $('#miSelect').append(option);
            });
            $('#miSelect').select2({
                placeholder: 'Selecciona una opción',
                allowClear: true,
                minimumResultsForSearch: 0,
                width: '100%',
                dropdownParent: $('#EntradaModal')
            });
            $('#miSelect').on('change', function () {
                let selectedId = $(this).val();
                $('#id_incidencias_Entrada').val(selectedId);
            });
            Swal.fire({
                title: 'Actualización',
                text: 'Se actualizó la hora de entrada y el Km de entrada',
                icon: 'success',
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__slideInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__slideOutUp'
                }
            });
        },
        error: function (error) {
            console.error("Error en la solicitud:", error);
            Swal.fire({
                title: 'Error',
                text: 'No se pudieron cargar los datos. Intenta nuevamente.',
                icon: 'error',
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__shakeX'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOut'
                }
            });
        }
    });
}

$(document).ready(function () {
    $('#entradaForm').on('submit', function (e) {
        e.preventDefault();

        let submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');

        let formData = {
            id_incidencias_Entrada: $('#id_incidencias_Entrada').val(),
            hora_Entrada: $('#hora_Entrada').val(),
            km_Entrada: $('#km_Entrada').val()
        };
        // console.log(formData);

        $.ajax({
            url: '/ActualizarEntrada',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                submitButton.prop('disabled', false).html('Guardar cambios');

                if (response.success) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.success,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#entradaForm')[0].reset();
                    FolioSinEntrada();
                    $('#cerrar').click();
                    $('#miSelect').val('').trigger('change');
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Error en la solicitud',
                        showConfirmButton: true
                    });
                }
            },
            error: function (xhr) {
                submitButton.prop('disabled', false).html('Guardar cambios');

                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Ocurrió un error: ' + xhr.responseJSON.message,
                    showConfirmButton: true
                });
            },
        });
    });
});

