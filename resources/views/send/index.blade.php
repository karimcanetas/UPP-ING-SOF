<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Enviar Correos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container-fluid max-w-7xl mx-auto px-4">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-light shadow-sm py-4">
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

                        <div class="container">
                            <h1 class="h3 mb-4 text-center">
                                <i class="fa-solid fa-file-alt"></i> Seleccionar Formato
                            </h1>
                            <button type="button" class="btn btn-danger d-block mx-auto mb-3" id="botonAbrirModal">
                                <i class="fa-solid fa-list"></i> Seleccionar Formatos
                            </button>
                            <x-modalFormatos />
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de Inicio:</label>
                                <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                    min="1111-01-01T00:00" max="9999-12-31T23:59" required>
                            </div>

                            <div class="form-group">
                                <label for="fecha_fin">Fecha de Fin:</label>
                                <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin"
                                    min="1111-01-01T00:00" max="9999-12-31T23:59" required>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-success px-5 py-2 shadow-lg">
                                    <i class="fa-solid fa-check-circle"></i> Generar Reporte
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="container">
                        <div class="correo-container">
                            <h4 class="h4 text-center mb-4">
                                <strong><i class="fa-solid fa-envelope"></i> Se enviará a:</strong>
                            </h4>
                            <ul class="correo-list" id="correos"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
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

        console.log(formatoId);
    });

    document.getElementById('fecha_fin').addEventListener('change', () => {
        const formatoId = document.getElementById('formato_id').value;
        if (formatoId) {
            obtenerCampos(formatoId);
        }
        console.log(formatoId);
    });

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

<script>
    $(document).ready(function() {
        let groupedBySucursal = {};
        $.ajax({
            url: '/checks-formatos',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                groupedBySucursal = response.groupedBySucursal;
                const addedFormats = new Set(); // para evitar formatos duplicados en cada caseta
                console.log(groupedBySucursal);
                $('#formatoSelect').empty();

                // Itera sobre sucursales
                $.each(groupedBySucursal, function(sucursalNombre, casetas) {
                    $.each(casetas, function(casetaNombre, formatos) {
                        let optgroup = $('<div>', {
                            class: 'caseta-group',
                            'data-caseta': casetaNombre.normalize("NFD")
                                .replace(/[\u0300-\u036f]/g, "")
                                .toLowerCase()
                        }).appendTo('#formatoSelect');

                        const empresa = formatos[0].empresa || 'Sin empresa';
                        const sucursal = formatos[0].sucursal || 'Sin sucursal';
                        const caseta = formatos[0].nombre_caseta || 'Sin caseta';

                        optgroup.append(
                            `<h5><strong>${empresa} / ${sucursal} / ${caseta}</strong></h5>`
                        );

                        $.each(formatos, function(index, formatoCaseta) {
                            const formatoTipo = formatoCaseta.Tipo.charAt(0)
                                .toUpperCase() + formatoCaseta.Tipo.slice(1)
                                .toLowerCase();

                            if (!addedFormats.has(formatoTipo
                                    .toLowerCase())) {
                                optgroup.append(
                                    `<label class="formato-label" data-formato="${formatoTipo.toLowerCase()}">
                                        <input type="checkbox" class="formato-checkbox" value="${formatoCaseta.id_formatos}"> ${formatoTipo}
                                    </label>`
                                );

                                const empleadosList = Array.isArray(
                                        formatoCaseta.empleados) ?
                                    formatoCaseta.empleados.map(function(
                                        empleado) {
                                        return `<li class="empleado-item" data-email="${empleado.email}" data-formato="${formatoCaseta.id_formatos}" data-nombre="${empleado.nombre}"><strong>${empleado.nombre}</strong></li>`;
                                    }).join('') :
                                    '';

                                if (empleadosList) {
                                    optgroup.append(
                                        `<ul class="empleados-list">${empleadosList}</ul>`
                                    );
                                }
                            }
                        });
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
            let correosAgrupados = {};

            $.each(selectedFormatos, function(index, formatoId) {
                const formatoCaseta = findFormatoById(formatoId);

                if (formatoCaseta) {
                    const empresa = formatoCaseta.empresa || 'Sin empresa';
                    const sucursal = formatoCaseta.sucursal || 'Sin sucursal';
                    const casetaNombre = formatoCaseta.casetaNombre || 'Sin caseta';

                    if (!correosAgrupados[empresa]) {
                        correosAgrupados[empresa] = {};
                    }
                    if (!correosAgrupados[empresa][sucursal]) {
                        correosAgrupados[empresa][sucursal] = {};
                    }
                    if (!correosAgrupados[empresa][sucursal][casetaNombre]) {
                        correosAgrupados[empresa][sucursal][casetaNombre] = [];
                    }

                    const empleadosCorreos = formatoCaseta.empleados.map(function(empleado) {
                        return {
                            email: empleado.email,
                            nombre: empleado.nombre,
                            formatoId: formatoId,
                            formato: formatoCaseta.Tipo
                        };
                    });

                    correosAgrupados[empresa][sucursal][casetaNombre].push(...empleadosCorreos);
                }
            });

            $('#correos').empty();
            let correosParaEnviar = [];

            if (Object.keys(correosAgrupados).length > 0) {
                $.each(correosAgrupados, function(empresa, sucursales) {
                    $.each(sucursales, function(sucursal, casetas) {
                        $.each(casetas, function(caseta, correos) {
                            $('#correos').append(
                                `<li>
                                    <h4><strong>${empresa} / ${sucursal} / ${caseta}</strong></h4>
                                    <ul>`
                            );

                            $.each(correos, function(index, correo) {
                                $('#correos').append(
                                    `<li data-email="${correo.email}" data-nombre="${correo.nombre}" data-formato="${correo.formatoId}">
                                        <strong>${correo.nombre}</strong> (${correo.email})
                                        <br>
                                        Formato: <strong>${correo.formato}</strong>
                                    </li>`
                                );

                                correosParaEnviar.push(correo.email);
                            });

                            $('#correos').append('</ul></li>');
                        });
                    });
                });

                $('#email').val(correosParaEnviar.join(','));
            } else {
                $('#correos').append('<li>No hay correos disponibles.</li>');
            }
        }

        function findFormatoById(id) {
            let formatoCaseta = null;
            $.each(groupedBySucursal, function(sucursalNombre, casetas) {
                $.each(casetas, function(casetaNombre, formatos) {
                    $.each(formatos, function(index, formato) {
                        if (formato.id_formatos == id) {
                            formato.casetaNombre = casetaNombre;
                            formatoCaseta = formato;
                            return false;
                        }
                    });
                    if (formatoCaseta) return false;
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
    document.addEventListener("DOMContentLoaded", function() {
        const botonAbrirModal = document.getElementById('botonAbrirModal');
        const modalElemento = document.getElementById('modalFormatos');
        const closeModalButton = document.getElementById('closeModalButton');
        const modal = new bootstrap.Modal(modalElemento);
        const originalFocusElement = botonAbrirModal;
        botonAbrirModal.addEventListener('click', function() {
            modal.show();
            closeModalButton.focus();
        });
        closeModalButton.addEventListener('click', function() {
            modal.hide();
        });
        modalElemento.addEventListener('hidden.bs.modal', function() {
            originalFocusElement.focus();
        });
    });
</script>

<style>
    .formato-label {
        display: block;
        margin-bottom: 5px;
        /* Espacio entre cada checkbox */
    }

    .caseta-group {
        margin-bottom: 15px;
    }

    .caseta-group h5 {
        font-weight: bold;
    }

    @media (max-width: 576px) {
        .formato-label {
            font-size: 14px;
        }

        .caseta-group {
            margin-bottom: 10px;
        }

        .caseta-group h5 {
            font-size: 16px;
        }
    }

    @media (max-width: 768px) {
        .formato-label {
            font-size: 16px;
        }

        .caseta-group {
            margin-bottom: 12px;
        }

        .caseta-group h5 {
            font-size: 18px;
        }
    }

    @media (min-width: 992px) {
        .formato-label {
            font-size: 18px;
        }

        .caseta-group {
            margin-bottom: 20px
        }

        .caseta-group h5 {
            font-size: 20px;
        }
    }

    @media (min-width: 1200px) {
        .formato-label {
            font-size: 20px;
        }

        .caseta-group {
            margin-bottom: 25px;
        }

        .caseta-group h5 {
            font-size: 22px;
        }



        #buscador {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }



        .correo-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .correo-item:hover {
            background-color: #f1f1f1;
        }



        .correo-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 5px 0;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .correo-item:hover {
            background-color: #f0f8ff;
        }

        .correo-item i {
            margin-left: auto;
            color: #007bff;
            transition: color 0.3s;
        }

        .correo-item:hover i {
            color: #0056b3;
        }

        .asociados-list {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    }
</style>

<script>
    $(document).ready(function() {
        @if (session('success'))
            Swal.fire({
                title: "¡Éxito!",
                text: "{{ session('success') }}",
                icon: "success"
            });
        @endif
    });

    $(document).ready(function() {
        @if (session('error'))
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error"
            });
        @endif
    });
</script>
