<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Enviar Correos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-light shadow-sm" style="padding: 20px;">
                    <h3 class="text-lg font-semibold mb-3 text-primary">
                        <i class="fa-solid fa-paper-plane"></i>
                        {{ __('Enviar correos') }}
                    </h3>
                </div>

                <div class="container mt-5">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('envio.correos') }}" method="POST">
                        @csrf
                        <input type="hidden" id="formato_id" name="formato_id">
                        <input type="hidden" id="email" name="email">
                        {{-- <input type="hidden" id="campos_obtenidos" name="campos_obtenidos"> --}}

                        <div class="container">
                            <h1>Seleccionar Formato</h1>
                            <button type="button" class="btn btn-danger" id="botonAbrirModal">
                                Seleccionar Formatos
                            </button>
                            <x-modalFormatos />
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de Inicio:</label>
                                <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="fecha_fin">Fecha de Fin:</label>
                                <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin"
                                    required>
                            </div>


                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-success px-5 py-2 shadow-lg">Generar
                                    Reporte</button>
                            </div>
                    </form>

                    <form action="{{ route('correos.store') }}" method="POST" novalidate class="needs-validation"
                        novalidate>
                        @csrf

                        <div class="container">
                            <div class="correo-container">
                                <h4>Se enviara a:</h4>
                                <ul class="correo-list" id="correos">
                                </ul>
                            </div>
                    </form>
                    <style>
                        .correo-container {
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            padding: 20px;
                            max-width: 600px;
                            margin: 20px auto;
                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                            background-color: #fff;
                            max-height: 300px;
                            overflow-y: auto;
                        }

                        #buscador {
                            width: 100%;
                            /* Ancho completo */
                            padding: 10px;
                            /* Espaciado interno */
                            margin-bottom: 10px;
                            /* Espacio debajo del buscador */
                            border: 1px solid #ccc;
                            /* Borde del buscador */
                            border-radius: 5px;
                            /* Esquinas redondeadas */
                        }

                        .correo-list {
                            list-style-type: none;
                            /* Sin viñetas */
                            padding: 0;
                            /* Sin espaciado interno */
                            margin: 0;
                            /* Sin márgenes */
                        }

                        .correo-item {
                            padding: 10px;
                            /* Espaciado interno para cada item */
                            border-bottom: 1px solid #eee;
                            /* Línea divisoria */
                            cursor: pointer;
                            /* Cursor de mano al pasar sobre el item */
                            transition: background-color 0.2s;
                            /* Transición suave */
                        }

                        .correo-item:hover {
                            background-color: #f1f1f1;
                            /* Color de fondo al pasar el mouse */
                        }


                        .correo-list {
                            list-style-type: none;
                            padding-left: 0;
                            padding-right: 10px;
                            margin: 10px 0;
                        }

                        .correo-item {
                            display: flex;
                            /* Usar flexbox para alinear íconos y texto */
                            align-items: center;
                            /* Alinear verticalmente */
                            padding: 10px;
                            /* Espaciado interno */
                            border: 1px solid #ddd;
                            /* Borde alrededor de los elementos */
                            border-radius: 5px;
                            /* Esquinas redondeadas */
                            margin: 5px 0;
                            /* Margen entre correos */
                            transition: background-color 0.3s;
                            /* Transición suave para el hover */
                            cursor: pointer;
                            /* Cambia el cursor al pasar sobre el elemento */
                        }

                        .correo-item:hover {
                            background-color: #f0f8ff;
                            /* Color de fondo al pasar el ratón */
                        }

                        .correo-item i {
                            margin-left: auto;
                            /* Mover el ícono a la derecha */
                            color: #007bff;
                            /* Color del ícono */
                            transition: color 0.3s;
                            /* Transición suave para el color del ícono */
                        }

                        .correo-item:hover i {
                            color: #0056b3;
                            /* Cambiar color del ícono al pasar el ratón */
                        }

                        .asociados-list {
                            background-color: #f9f9f9;
                            /* Color de fondo diferente para la lista de asociados */
                            padding: 10px;
                            /* Espaciado interno para la lista de asociados */
                            border: 1px solid #ddd;
                            /* Borde alrededor de la lista */
                            border-radius: 5px;
                            /* Esquinas redondeadas */
                        }
                    </style>

                    <script>
                        function agregarCorreo(correo) {
                            const lista = document.getElementById('correos-asociados');

                            if (![...lista.children].some(item => item.textContent.includes(correo))) {
                                const li = document.createElement('li');

                                li.innerHTML = `${correo} <i class="fa-solid fa-minus" onclick="eliminarCorreo(this)"></i>`;
                                lista.appendChild(li);

                                //prueba en consola
                                actualizarCampoOculto();
                            } else {
                                console.log('Este correo ya está agregado.');
                            }
                        }

                        function eliminarCorreo(icon) {
                            const li = icon.parentElement;
                            li.remove();

                            actualizarCampoOculto();
                        }

                        function actualizarCampoOculto() {
                            const correos = Array.from(document.querySelectorAll('#correos-asociados li')).map(item => item.textContent
                                .replace(" ✖", ""));
                            document.getElementById('correosSeleccionados').value = correos.join(',');
                            console.log(correos);
                        }
                    </script>

                    <script>
                        (() => {
                            'use strict';

                            const forms = document.querySelectorAll('.needs-validation');

                            Array.from(forms).forEach(form => {
                                form.addEventListener('submit', event => {
                                    if (!form.checkValidity()) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }

                                    form.classList.add('was-validated');
                                }, false);
                            });
                        })();

                        // document.addEventListener('DOMContentLoaded', function() {
                        //     const selectElement = document.getElementById('formatoSelect');
                        //     const options = selectElement.options;

                        //     for (let i = 0; i < options.length; i++) {
                        //         let txtValue = options[i].text.toLowerCase(); // convertir a minuscula
                        //         options[i].text = txtValue.charAt(0).toUpperCase() + txtValue.slice(
                        //             1);
                        //     }
                        // });

                        function cargarCorreos(formatoId) {
                            if (formatoId) {
                                $.ajax({
                                    url: '{{ route('get.correos', ':id') }}'.replace(':id', formatoId),
                                    method: 'GET',
                                    success: function(response) {
                                        $('#correos').empty();
                                        if (response.correos && response.correos.length > 0) {
                                            response.correos.forEach(function(correo) {
                                                if (correo) {
                                                    const li =
                                                        `<li class="correo-item" onclick="agregarCorreo('${correo}')">${correo} <i class="fa-solid fa-plus"></i></li>`;
                                                    $('#correos').append(li);
                                                }
                                            });
                                        } else {
                                            $('#correos').append('<li>No se encontraron correos disponibles.</li>');
                                        }
                                    },
                                    error: function() {
                                        $('#correos').append('<li>Error al cargar correos.</li>');
                                    }
                                });

                                document.getElementById('formato_id').value = formatoId;

                                obtenerCampos(formatoId);
                            }
                        }

                        function obtenerCampos(formatoId) {
                            const fechaInicio = document.getElementById('fecha_inicio').value;
                            const fechaFin = document.getElementById('fecha_fin').value;

                            if (!fechaInicio || !fechaFin) {
                                console.error('Por favor, ingrese ambas fechas para realizar la búsqueda.');
                                return;
                            }

                            fetch('/obtener-campos', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                    },
                                    body: JSON.stringify({
                                        formato_id: formatoId,
                                        fecha_inicio: fechaInicio,
                                        fecha_fin: fechaFin
                                    }),
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Error en la respuesta del servidor');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    console.log('Campos obtenidos:', data);

                                })
                                .catch(error => {
                                    console.error('Error al obtener campos:', error);
                                });
                        }

                        document.getElementById('fecha_inicio').addEventListener('change', () => {
                            const formatoId = document.getElementById('formato_id').value;
                            if (formatoId) {
                                obtenerCampos(formatoId);
                            }
                        });

                        document.getElementById('fecha_fin').addEventListener('change', () => {
                            const formatoId = document.getElementById('formato_id').value;
                            if (formatoId) {
                                obtenerCampos(formatoId);
                            }
                        });

                        // function filterFormatos() {
                        //     const input = document.getElementById('formato_search');
                        //     const filter = input.value.toLowerCase();
                        //     const formatoSelect = document.getElementById('formatoSelect');
                        //     const options = formatoSelect.options;

                        //     for (let i = 0; i < options.length; i++) {
                        //         const txtValue = options[i].text;
                        //         if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        //             options[i].style.display = "";
                        //         } else {
                        //             options[i].style.display = "none";
                        //         }
                        //     }
                        // }

                        function filtrarCorreos() {
                            const input = document.getElementById('buscador');
                            const filter = input.value.toLowerCase();
                            const ul = document.getElementById('correos');
                            const li = ul.getElementsByTagName('li');

                            for (let i = 0; i < li.length; i++) {
                                const correoItem = li[i].textContent || li[i].innerText;
                                if (correoItem.toLowerCase().indexOf(filter) > -1) {
                                    li[i].style.display = "";
                                } else {
                                    li[i].style.display = "none";
                                }
                            }
                        }
                    </script>

                    {{-- <script>
                        $(document).ready(function() {
                            let groupedByCaseta = {}; // variable global para almacenar los datos de la respuesta AJAX
                            $.ajax({
                                url: '/checks-formatos',
                                type: 'GET',
                                dataType: 'json',
                                success: function(response) {
                                    groupedByCaseta = response.groupedByCaseta; // se asigna a la variable global
                                    const addedFormats = new Set(); // para evitar formatos duplicados

                                    $('#formatoSelect').empty();

                                    // agrupo las casetas con sus formatos asignados
                                    $.each(groupedByCaseta, function(casetaNombre, formatoCasetas) {
                                        let optgroup = $('<div>', {
                                            class: 'caseta-group',
                                            'data-caseta': casetaNombre.normalize("NFD").replace(
                                                /[\u0300-\u036f]/g, "").toLowerCase()
                                        }).appendTo('#formatoSelect');

                                        optgroup.append(`<h5><strong>${casetaNombre}</strong></h5>`);

                                        // itero sobre los formatos
                                        $.each(formatoCasetas, function(index, formatoCaseta) {
                                            const formatoTipo = formatoCaseta.Tipo.charAt(0)
                                                .toUpperCase() + formatoCaseta.Tipo.slice(1);

                                            if (!addedFormats.has(formatoTipo.toLowerCase())) {
                                                addedFormats.add(formatoTipo.toLowerCase());

                                                optgroup.append(
                                                    `<label class="formato-label" data-formato="${formatoTipo.toLowerCase()}">
                                    <input type="checkbox" class="formato-checkbox" value="${formatoCaseta.id_formatos}">
                                    ${formatoTipo}
                                </label>`
                                                );

                                                const empleadosList = formatoCaseta.empleados.map(
                                                    function(empleado) {
                                                        return `<li class="empleado-item" data-email="${empleado.email}" data-formato="${formatoCaseta.id_formatos}" data-nombre="${empleado.nombre}">${empleado.nombre}</li>`;
                                                    }).join('');

                                                optgroup.append(
                                                    `<ul class="empleados-list">${empleadosList}</ul>`
                                                );
                                            }
                                        });
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error("Error en la solicitud AJAX:", error);
                                }
                            });

                            $('#formatoSelect').on('change', '.formato-checkbox', function() {
                                const selectedFormatos = [];

                                $('.formato-checkbox:checked').each(function() {
                                    selectedFormatos.push($(this).val());
                                });

                                let formatoIds = $('#formato_id').val().split(',');
                                if ($(this).is(':checked')) {
                                    // el valor lo mando al campo oculto
                                    formatoIds.push($(this).val());
                                } else {
                                    const index = formatoIds.indexOf($(this).val());
                                    if (index > -1) {
                                        formatoIds.splice(index, 1);
                                    }
                                }

                                $('#formato_id').val(formatoIds.filter(function(value) {
                                    return value !== "";
                                }).join(','));

                                if (selectedFormatos.length > 0) {
                                    cargarCorreos(selectedFormatos);
                                } else {
                                    $('#correos').empty().append('<li>No hay correos disponibles.</li>');
                                }
                            });

                            function cargarCorreos(selectedFormatos) {
                                let correos = [];

                                $.each(selectedFormatos, function(index, formatoId) {
                                    const formatoCaseta = findFormatoById(formatoId);

                                    if (formatoCaseta) {
                                        const empleadosCorreos = formatoCaseta.empleados.map(function(empleado) {
                                            return {
                                                email: empleado.email,
                                                nombre: empleado.nombre, // Agregar el nombre del empleado
                                                formatoId: formatoId
                                            };
                                        });
                                        correos.push(...empleadosCorreos);
                                    }
                                });

                                // Crear el string de correos para el campo oculto
                                let correosString = correos.map(function(correo) {
                                    return correo.email;
                                }).join(',');

                                $('#email').val(correosString); // Asignar los correos al campo oculto

                                // Mostrar los nombres de los empleados en la lista
                                $('#correos').empty();
                                if (correos.length > 0) {
                                    $.each(correos, function(index, correo) {
                                        $('#correos').append(
                                            `<li data-email="${correo.email}" data-nombre="${correo.nombre}" data-formato="${correo.formatoId}">${correo.nombre} (${correo.email})</li>`
                                        );
                                    });
                                } else {
                                    $('#correos').append('<li>No hay correos disponibles.</li>');
                                }
                            }

                            // Se encuentra el formato por id
                            function findFormatoById(id) {
                                let formatoCaseta = null;
                                $.each(groupedByCaseta, function(casetaNombre, formatoCasetas) {
                                    $.each(formatoCasetas, function(index, formato) {
                                        if (formato.id_formatos == id) {
                                            formatoCaseta = formato;
                                            return false;
                                        }
                                    });
                                    if (formatoCaseta) return false;
                                });
                                return formatoCaseta;
                            }

                            // Filtro para los formatos
                            function filterFormatos() {
                                const input = document.getElementById('formato_search');
                                const filter = input.value.toLowerCase();
                                const casetaGroups = document.querySelectorAll('#formatoSelect .caseta-group');

                                casetaGroups.forEach(group => {
                                    const casetaName = group.getAttribute('data-caseta');
                                    const labels = group.querySelectorAll('.formato-label');
                                    let hasVisibleLabel = false;

                                    labels.forEach(label => {
                                        const formatoName = label.getAttribute('data-formato');
                                        if (casetaName.includes(filter) || formatoName.includes(filter)) {
                                            label.style.display = 'block'; //mostrar el formato que se busca
                                            hasVisibleLabel = true;
                                        } else {
                                            label.style.display = 'none';
                                        }
                                    });

                                    group.style.display = hasVisibleLabel ? 'block' : 'none';
                                });
                            }
                        });
                    </script> --}}

                    <script>
                        $(document).ready(function() {
                            let groupedByCaseta = {}; // variable global para almacenar los datos de la respuesta AJAX
                            $.ajax({
                                url: '/checks-formatos',
                                type: 'GET',
                                dataType: 'json',
                                success: function(response) {
                                    groupedByCaseta = response.groupedByCaseta; // se asigna a la variable global
                                    const addedFormats = new Set(); // para evitar formatos duplicados

                                    $('#formatoSelect').empty();

                                    // agrupo las casetas con sus formatos asignados
                                    $.each(groupedByCaseta, function(casetaNombre, formatoCasetas) {
                                        let optgroup = $('<div>', {
                                            class: 'caseta-group',
                                            'data-caseta': casetaNombre.normalize("NFD").replace(
                                                /[\u0300-\u036f]/g, "").toLowerCase()
                                        }).appendTo('#formatoSelect');

                                        optgroup.append(`<h5><strong>${casetaNombre}</strong></h5>`);

                                        // itero sobre los formatos
                                        $.each(formatoCasetas, function(index, formatoCaseta) {
                                            const formatoTipo = formatoCaseta.Tipo.charAt(0)
                                                .toUpperCase() + formatoCaseta.Tipo.slice(1)
                                                .toLowerCase();

                                            if (!addedFormats.has(formatoTipo.toLowerCase())) {
                                                addedFormats.add(formatoTipo.toLowerCase());

                                                optgroup.append(
                                                    `<label class="formato-label" data-formato="${formatoTipo.toLowerCase()}">
                                                        <input type="checkbox" class="formato-checkbox" value="${formatoCaseta.id_formatos}">
                                                        ${formatoTipo}
                                                    </label>`
                                                );

                                                // Verificar si 'empleados' es un arreglo antes de usar map
                                                const empleadosList = Array.isArray(formatoCaseta
                                                        .empleados) ?
                                                    formatoCaseta.empleados.map(function(empleado) {
                                                        return `<li class="empleado-item" data-email="${empleado.email}" data-formato="${formatoCaseta.id_formatos}" data-nombre="${empleado.nombre}">${empleado.nombre}</li>`;
                                                    }).join('') : '';

                                                if (empleadosList) {
                                                    optgroup.append(
                                                        `<ul class="empleados-list">${empleadosList}</ul>`
                                                    );
                                                }
                                            }
                                        });
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error("Error en la solicitud AJAX:", error);
                                }
                            });

                            $('#formatoSelect').on('change', '.formato-checkbox', function() {
                                const selectedFormatos = [];

                                $('.formato-checkbox:checked').each(function() {
                                    selectedFormatos.push($(this).val());
                                });

                                let formatoIds = $('#formato_id').val().split(',');
                                if ($(this).is(':checked')) {
                                    // el valor lo mando al campo oculto
                                    formatoIds.push($(this).val());
                                } else {
                                    const index = formatoIds.indexOf($(this).val());
                                    if (index > -1) {
                                        formatoIds.splice(index, 1);
                                    }
                                }

                                $('#formato_id').val(formatoIds.filter(function(value) {
                                    return value !== "";
                                }).join(','));

                                if (selectedFormatos.length > 0) {
                                    cargarCorreos(selectedFormatos);
                                } else {
                                    $('#correos').empty().append('<li>No hay correos disponibles.</li>');
                                }
                            });

                            function cargarCorreos(selectedFormatos) {
                                let correos = [];

                                $.each(selectedFormatos, function(index, formatoId) {
                                    const formatoCaseta = findFormatoById(formatoId);

                                    if (formatoCaseta) {
                                        const empleadosCorreos = formatoCaseta.empleados.map(function(empleado) {
                                            return {
                                                email: empleado.email,
                                                nombre: empleado.nombre, // Agregar el nombre del empleado
                                                formatoId: formatoId
                                            };
                                        });
                                        correos.push(...empleadosCorreos);
                                    }
                                });

                                // Crear el string de correos para el campo oculto
                                let correosString = correos.map(function(correo) {
                                    return correo.email;
                                }).join(',');

                                $('#email').val(correosString); // Asignar los correos al campo oculto

                                // Mostrar los nombres de los empleados en la lista
                                $('#correos').empty();
                                if (correos.length > 0) {
                                    $.each(correos, function(index, correo) {
                                        $('#correos').append(
                                            `<li data-email="${correo.email}" data-nombre="${correo.nombre}" data-formato="${correo.formatoId}">${correo.nombre} (${correo.email})</li>`
                                        );
                                    });
                                } else {
                                    $('#correos').append('<li>No hay correos disponibles.</li>');
                                }
                            }

                            // Se encuentra el formato por id
                            function findFormatoById(id) {
                                let formatoCaseta = null;
                                $.each(groupedByCaseta, function(casetaNombre, formatoCasetas) {
                                    $.each(formatoCasetas, function(index, formato) {
                                        if (formato.id_formatos == id) {
                                            formatoCaseta = formato;
                                            return false;
                                        }
                                    });
                                    if (formatoCaseta) return false;
                                });
                                return formatoCaseta;
                            }

                            // Filtro para los formatos
                            function filterFormatos() {
                                const input = document.getElementById('formato_search');
                                const filter = input.value.toLowerCase(); // Obtenemos el valor del filtro
                                const casetaGroups = document.querySelectorAll('#formatoSelect .caseta-group');

                                casetaGroups.forEach(group => {
                                    const casetaName = group.getAttribute('data-caseta');
                                    const labels = group.querySelectorAll('.formato-label');
                                    let hasVisibleLabel = false;

                                    labels.forEach(label => {
                                        const formatoName = label.getAttribute('data-formato');
                                        if (casetaName.includes(filter) || formatoName.includes(filter)) {
                                            label.style.display =
                                                'block'; // Mostrar formato que coincida con el filtro
                                            hasVisibleLabel = true;
                                        } else {
                                            label.style.display = 'none'; // Ocultar el formato que no coincida
                                        }
                                    });

                                    // Solo mostrar el grupo de caseta si hay al menos un formato visible
                                    group.style.display = hasVisibleLabel ? 'block' : 'none';
                                });
                            }

                            // Llamar al filtro cada vez que el usuario escriba
                            $('#formato_search').on('input', function() {
                                filterFormatos();
                            });
                        });
                    </script>

                    <script>
                        // Espera a que el documento esté listo
                        document.addEventListener("DOMContentLoaded", function() {
                            // Obtén el botón para abrir el modal
                            const botonAbrirModal = document.getElementById('botonAbrirModal');

                            // Obtén el modal
                            const modalElemento = document.getElementById('modalFormatos');
                            const modal = new bootstrap.Modal(modalElemento); // Inicializa el modal con Bootstrap

                            // Asigna un evento para abrir el modal cuando se haga clic en el botón
                            botonAbrirModal.addEventListener('click', function() {
                                modal.show(); // Abre el modal
                            });

                            // Obtén el botón para cerrar el modal
                            const closeModalButton = document.getElementById('closeModalButton');

                            // Asigna un evento para cerrar el modal cuando se haga clic en el botón
                            closeModalButton.addEventListener('click', function() {
                                modal.hide(); // Cierra el modal
                            });
                        });
                    </script>



                </div>
            </div>
        </div>
</x-app-layout>

<style>
    /* Estilo para alinear los checkboxes de manera vertical */
    .formato-label {
        display: block;
        /* Fuerza cada checkbox a ocupar toda la línea */
        margin-bottom: 5px;
        /* Espacio entre cada checkbox */
    }

    .caseta-group {
        margin-bottom: 15px;
        /* Espacio entre grupos de caseta */
    }

    /* Alineación del título de cada caseta en negritas */
    .caseta-group h5 {
        font-weight: bold;
    }
</style>
