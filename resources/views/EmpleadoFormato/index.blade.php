<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Enviar correo por incidencia') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-10 lg:py-12">
        <div class="container mx-auto px-0 sm:px-6 lg:px-8">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-gray-100 shadow-sm p-4">
                    <h3 class="text-base sm:text-lg font-semibold mb-2 sm:mb-3 text-primary">
                        <i class="fas fa-envelope-open-text"></i>
                        {{ __('Enlace de formatos') }}
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

                    <form method="POST" action="{{ route('empleados_formatos.store') }}" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="row">
                            <!-- Empresa -->
                            <div class="col-md-6 mb-3">
                                <label for="id_empresa" class="form-label">
                                    <i class="fas fa-building"></i> Selecciona la empresa:
                                </label>
                                <select id="id_empresa" name="id_empresa" required
                                    class="form-select shadow-sm form-control-lg">
                                    <option value="">Seleccione una empresa</option>
                                </select>
                                <div class="invalid-feedback">Por favor selecciona una empresa.</div>
                            </div>

                            <!-- Sucursal -->
                            <div class="col-md-6 mb-3">
                                <label for="id_sucursal" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i> Selecciona la sucursal:
                                </label>
                                <select id="id_sucursal" name="id_sucursal" required
                                    class="form-select shadow-sm form-control-lg" disabled>
                                    <option value="">Seleccione una sucursal</option>
                                </select>
                                <div class="invalid-feedback">Por favor selecciona una sucursal.</div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Caseta -->
                            <div class="col-md-6 mb-3">
                                <label for="id_caseta" class="form-label">
                                    <i class="fas fa-warehouse"></i> Selecciona una caseta:
                                </label>
                                <select id="id_caseta" name="id_caseta" required
                                    class="form-select shadow-sm form-control-lg" disabled>
                                    <option value="">Seleccione una caseta</option>
                                </select>
                                <div class="invalid-feedback">Por favor selecciona una caseta.</div>
                            </div>

                            <!-- Departamentos -->
                            <div class="col-md-6 mb-3">
                                <label for="id_departamento" class="form-label">
                                    <i class="fas fa-users"></i>Selecciona un Departamento:
                                </label>
                                <select id="id_departamento" name="id_departamento" required
                                    class="form-select shadow-sm form-control-lg" disabled>
                                    <option value="">Seleccione un departamento</option>
                                </select>
                                <div class="invalid-feedback">Por favor selecciona un departamento.</div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Formatos disponibles -->
                            <div class="col-md-6 mb-3">
                                <label for="id_formato" class="form-label">
                                    <i class="fas fa-file-alt"></i> Formatos disponibles:
                                </label>
                                {{-- <input type="text" id="formato_search" class="form-control mb-2"
                                    placeholder="Buscar formato..." onkeyup="filterFormatos()"> --}}
                                <select id="id_formato" name="id_formato[]"
                                    class="form-select shadow-sm form-control-lg" required>
                                    <!-- se cargarán con AJAX -->
                                </select>
                                <small class="text-muted">Selecciona un formato.</small>
                                <div class="invalid-feedback">Por favor selecciona al menos un formato.</div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Destinatarios correo -->
                            <div class="col-md- text-center mb-4">
                                <button type="button" class="btn btn-warning px-2 py-2 shadow-lg" id="editarmodal">
                                    <i class="fa-solid fa-pencil"></i> Destinatarios Correos
                                </button>
                            </div>
                        </div>


                        <div class="row">
                            <!-- Empleados disponibles -->
                            <div class="col-md-6 mb-3">
                                <label for="id_empleado" class="form-label">
                                    <i class="fa-regular fa-address-card"></i> Empleados disponibles:
                                </label>
                                <input type="text" id="empleado_search" class="form-control mb-2"
                                    placeholder="Buscar empleado..." onkeyup="filterEmpleados()">
                                <select id="id_empleado" name="id_empleado[]" class="form-select shadow-sm" multiple
                                    required>
                                    <!-- Los empleados se cargarán aquí con AJAX -->
                                </select>
                                <small class="text-muted">Selecciona los empleados que deseas agregar. Puedes
                                    seleccionar varios manteniendo presionada la tecla Ctrl mientras haces clic en los
                                    empleados, o arrastrando el cursor para seleccionar un grupo.</small>
                                <div class="invalid-feedback">Por favor selecciona al menos un empleado.</div>
                            </div>
                        </div>

                        {{-- <div id="empleadosorganizados" style="padding: 10px;"></div> --}}


                        <div class="submit-button-container">
                            <button type="submit" id="EnlaceFormato" class="btn btn-primary px-5 py-2 shadow-lg">
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"
                                    id="spinner"></span>
                                <i class="fa-solid fa-link" id="checkIcon"></i> Enlazar Formato
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchEmpresas();

            document.getElementById('id_empresa').addEventListener('change', function() {
                const empresaId = this.value;
                if (empresaId) {
                    fetch(`/empresas/${empresaId}/sucursales`)
                        .then(response => response.ok ? response.json() : Promise.reject(
                            'Error al cargar sucursales'))
                        .then(data => {
                            const sucursalSelect = document.getElementById('id_sucursal');
                            sucursalSelect.innerHTML =
                                '<option value="">Seleccione una sucursal</option>';
                            sucursalSelect.disabled = false;
                            data.forEach(sucursal => {
                                const option = document.createElement('option');
                                option.value = sucursal.id_sucursal;
                                option.text = sucursal.nombre;
                                sucursalSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al cargar sucursales.');
                        });
                } else {
                    resetSucursalAndCaseta();
                }
            });

            document.getElementById('id_sucursal').addEventListener('change', fetchEmpleados);
            document.getElementById('id_departamento').addEventListener('change', fetchEmpleados);

            document.getElementById('id_sucursal').addEventListener('change', function() {
                const sucursalId = this.value;
                if (sucursalId) {
                    fetch(`/sucursales/${sucursalId}/casetas`)
                        .then(response => response.ok ? response.json() : Promise.reject(
                            'Error al cargar casetas'))
                        .then(data => {
                            const casetaSelect = document.getElementById('id_caseta');
                            casetaSelect.innerHTML = '<option value="">Seleccione una caseta</option>';
                            casetaSelect.disabled = false;
                            data.casetas.forEach(caseta => {
                                const option = document.createElement('option');
                                option.value = caseta.id_casetas;
                                option.text = caseta.nombre;
                                casetaSelect.appendChild(option);
                            });

                            const departamentoSelect = document.getElementById('id_departamento');
                            departamentoSelect.innerHTML =
                                '<option value="">Seleccione un departamento</option>';
                            departamentoSelect.disabled = false;
                            data.departamentos.forEach(departamento => {
                                const option = document.createElement('option');
                                option.value = departamento.id_departamento;
                                option.text = departamento.nombre;
                                departamentoSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al cargar casetas o departamentos.');
                        });
                } else {
                    resetCaseta();
                    resetDepartamento();
                }
            });

            document.getElementById('id_caseta').addEventListener('change', function() {
                const casetaId = this.value;
                if (casetaId) {
                    fetch(`/casetas/${casetaId}/formatos`)
                        .then(response => response.ok ? response.json() : Promise.reject(
                            'Error al cargar formatos'))
                        .then(data => {
                            const formatoSelect = document.getElementById('id_formato');
                            formatoSelect.innerHTML = '';
                            data.forEach(formato => {
                                const option = document.createElement('option');
                                option.value = formato.id_formatos;
                                option.text = formato.Tipo.charAt(0).toUpperCase() + formato
                                    .Tipo.slice(1).toLowerCase();
                                formatoSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al cargar formatos.');
                        });
                } else {
                    resetFormato();
                }
            });
        });

        function fetchEmpleados() {
            const sucursalId = document.getElementById('id_sucursal').value;
            const departamentoId = document.getElementById('id_departamento').value;

            if (sucursalId && departamentoId) {
                fetch(`/empleados/${sucursalId}/${departamentoId}`)
                    .then(response => response.ok ? response.json() : Promise.reject('Error al cargar empleados'))
                    .then(data => {
                        const empleadoSelect = document.getElementById('id_empleado');
                        empleadoSelect.innerHTML = '<option value="">Seleccione un empleado</option>';

                        const uniqueEmpleados = [];
                        const seen = new Set();

                        data.forEach(empleado => {
                            if (!seen.has(empleado.id_empleado)) {
                                seen.add(empleado.id_empleado);
                                uniqueEmpleados.push(empleado);
                            }
                        });

                        if (uniqueEmpleados.length > 0) {
                            uniqueEmpleados.forEach(empleado => {
                                const option = document.createElement('option');
                                option.value = empleado.id_empleado;
                                option.text = empleado.nombres + ' ' + empleado.apellidos;
                                option.setAttribute('data-email', empleado
                                    .email);
                                empleadoSelect.appendChild(option);
                            });
                        } else {
                            empleadoSelect.innerHTML = '<option value="">No se encontraron empleados</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener los empleados:', error);
                    });
            }

        }

        function resetSucursalAndCaseta() {
            document.getElementById('id_sucursal').innerHTML = '<option value="">Seleccione una sucursal</option>';
            document.getElementById('id_sucursal').disabled = true;
            resetCaseta();
        }

        function resetCaseta() {
            document.getElementById('id_caseta').innerHTML = '<option value="">Seleccione una caseta</option>';
            document.getElementById('id_caseta').disabled = true;
            resetFormato();
        }

        function resetFormato() {
            document.getElementById('id_formato').innerHTML = '';
        }

        function resetDepartamento() {
            const departamentoSelect = document.getElementById('id_departamento');

            departamentoSelect.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Seleccione un departamento';
            departamentoSelect.appendChild(defaultOption);
            departamentoSelect.disabled = true;
        }


        function fetchEmpresas() {
            fetch('/empresas')
                .then(response => response.ok ? response.json() : Promise.reject('Error al cargar empresas'))
                .then(data => {
                    const empresaSelect = document.getElementById('id_empresa');
                    empresaSelect.innerHTML = '<option value="">Seleccione una empresa</option>';
                    data.forEach(empresa => {
                        const option = document.createElement('option');
                        option.value = empresa.id_empresa;
                        option.textContent = empresa.alias;
                        empresaSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cargar empresas.');
                });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessage = '{{ session('error') }}';

            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/empleados/formatos',
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        $('#empleadosorganizados').empty();

                        let casetas = {};

                        response.data.forEach(item => {
                            if (!casetas[item.id_casetas]) {
                                casetas[item.id_casetas] = {
                                    empresa: item.empresa,
                                    sucursal: item.sucursal,
                                    caseta: item.nombre_caseta,
                                    formatos: {}
                                };
                            }

                            if (!casetas[item.id_casetas].formatos[item.Tipo]) {
                                casetas[item.id_casetas].formatos[item.Tipo] = [];
                            }

                            casetas[item.id_casetas].formatos[item.Tipo].push(item);
                        });

                        for (let nombreCaseta in casetas) {
                            let casetaData = casetas[nombreCaseta];
                            let casetaElement = `
                        <div class="caseta" data-caseta="${casetaData.caseta}" data-formatos="${Object.keys(casetaData.formatos).join(',')}">
                            <h5><strong class="font-weight-bold" style="font-size: 1.2em; color: #000000 ;">${casetaData.empresa} / ${casetaData.sucursal} / ${casetaData.caseta}</strong></h5>
                    `;

                            for (let tipo in casetaData.formatos) {
                                casetaElement += `
                            <div class="formato-tipo" style="font-size: 0.9">${tipo}</div>
                            <ul style="list-style-type: none; padding-left: 20px;">
                        `;

                                casetaData.formatos[tipo].forEach(item => {
                                    let checkbox = item.status == 1 ? 'checked' : '';
                                    let listItem = `
                                <li class="empleado-item">
                                    <span class="empleado-icon fa fa-user-circle"></span>
                                    <span class="empleado-nombre">${item.nombres}</span>
                                    <input type="checkbox" class="status-checkbox" data-id="${item.id_empleado}" data-formato-id="${item.id_formatos}" ${checkbox}>
                                </li>
                            `;
                                    casetaElement += listItem;
                                });

                                casetaElement += `</ul>`;
                            }

                            casetaElement += `</div>`;
                            $('#empleadosorganizados').append(casetaElement);
                        }

                        // un buscador
                        $('#buscarCasetaFormato').on('input', function() {
                            let query = $(this).val().toLowerCase();

                            $('.caseta').each(function() {
                                let caseta = $(this).data('caseta').toLowerCase();
                                let formatos = $(this).data('formatos').toLowerCase();

                                if (caseta.includes(query) || formatos.includes(
                                        query)) {
                                    $(this).show();
                                } else {
                                    $(this).hide();
                                }
                            });
                        });

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $('#empleadosorganizados').on('change', '.status-checkbox', function() {
                            let empleadoId = $(this).data('id');
                            let formatoId = $(this).data('formato-id');
                            let nuevoStatus = $(this).prop('checked') ? 1 : 0;
                            $.ajax({
                                url: `/empleados/actualizar-status/${empleadoId}/${formatoId}`,
                                type: 'PUT',
                                data: {
                                    status: nuevoStatus
                                },
                                success: function(response) {
                                    if (response.success) {
                                        console.log(
                                            'Estado actualizado correctamente.');
                                    } else {
                                        console.error(
                                            'Error al actualizar el estado.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error en la solicitud:', error);
                                }
                            });
                        });
                    } else {
                        console.error('Error en la respuesta del servidor.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al realizar la solicitud GET:', error);
                }
            });
        });
    </script>

    <style>
        #spinner {
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        #spinner.fade-in {
            opacity: 1;
        }

        #checkIcon {
            transition: opacity 0.5s ease;
        }

        .submit-button-container {
            display: flex;
            justify-content: center;
            margin-top: -20px;
            padding: 20px
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const botonAbrirModal = document.getElementById('editarmodal');
            const modalElemento = document.getElementById('modalEditarCorreo');
            const modal = new bootstrap.Modal(modalElemento);

            botonAbrirModal.addEventListener('click', function() {
                modal.show();
            });

            const closeModalButton = document.getElementById('cerrar');

            closeModalButton.addEventListener('click', function() {
                modal.hide();
            });
        });
    </script>

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
    </script>

    <script>
    function filterEmpleados() {
        const searchValue = document.getElementById('empleado_search').value.toLowerCase();
        const empleadoSelect = document.getElementById('id_empleado');

        // obtengo todas las opciones de la lista de empleados
        const empleadoOptions = Array.from(empleadoSelect.options);

        // filtro las opciones de empleados en base al valor de busqueda
        empleadoOptions.forEach(option => {
            const empleadoNombre = option.text.toLowerCase();
            if (empleadoNombre.includes(searchValue)) {
                option.style.display = '';  // muestro la opción si coincide
            } else {
                option.style.display = 'none';  // Ocultar la opción si no coincide
            }
        });
    }
    </script>


    <script>
        $(document).ready(function() {
            $('#modalEditarCorreo').on('show.bs.modal', function() {
                $(this).removeAttr('aria-hidden');
            });

            $('#modalEditarCorreo').on('hidden.bs.modal', function() {
                $(this).attr('aria-hidden', 'true');
            });
        });
    </script>

    <script>
        //boton enlace reporte
        document.getElementById('EnlaceFormato').addEventListener('click', function(event) {
            event.preventDefault();
            var spinner = document.getElementById('spinner');
            var checkIcon = document.getElementById('checkIcon');
            var button = this;
            checkIcon.style.opacity = 0;
            spinner.classList.remove('d-none');
            spinner.style.position = 'absolute';
            spinner.style.left = checkIcon.offsetLeft + 'px';
            spinner.style.top = checkIcon.offsetTop + 'px';

            button.disabled = true;
            setTimeout(function() {
                button.form.submit();
            }, 500); // tiempo de restraso
        });
    </script>

</x-app-layout>
