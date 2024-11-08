<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Enviar correo por incidencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-light shadow-sm" style="padding: 20px;">
                    <h3 class="text-lg font-semibold mb-3 text-primary">
                        <i class="fas fa-envelope-open-text"></i>
                        {{ __('Agregar correos') }}
                    </h3>
                </div>


                <div class="card-body">
                    @if ($errors->any() && !collect($errors->all())->contains(fn($error) => str_contains($error, 'emails')))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                </div>
                @endif


                <form method="POST" action="{{ route('correos_formatos.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <!-- Empresa -->
                        <div class="col-md-6 mb-3">
                            <label for="id_empresa" class="form-label">
                                <i class="fas fa-building"></i> Selecciona la empresa:
                            </label>
                            <select id="id_empresa" name="id_empresa" required class="form-select shadow-sm">
                                <option value="">Seleccione una empresa</option>
                            </select>
                            <div class="invalid-feedback">Por favor selecciona una empresa.</div>
                        </div>

                        <!-- Sucursal -->
                        <div class="col-md-6 mb-3">
                            <label for="id_sucursal" class="form-label">
                                <i class="fas fa-map-marker-alt"></i> Selecciona la sucursal:
                            </label>
                            <select id="id_sucursal" name="id_sucursal" required class="form-select shadow-sm" disabled>
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
                            <select id="id_caseta" name="id_caseta" required class="form-select shadow-sm" disabled>
                                <option value="">Seleccione una caseta</option>
                            </select>
                            <div class="invalid-feedback">Por favor selecciona una caseta.</div>
                        </div>

                        <!-- Formatos disponibles -->
                        <div class="col-md-6 mb-3">
                            <label for="id_formato" class="form-label">
                                <i class="fas fa-file-alt"></i> Formatos disponibles:
                            </label>
                            <input type="text" id="formato_search" class="form-control mb-2"
                                placeholder="Buscar formato..." onkeyup="filterFormatos()">
                            <select id="id_formato" name="id_formato[]" class="form-select shadow-sm" required>
                                <!-- se cargaran con AJAX -->
                            </select>
                            <small class="text-muted">Selecciona un formato.</small>
                            <div class="invalid-feedback">Por favor selecciona al menos un formato.</div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Correos electrónicos -->
                        <div class="col-md-12 mb-3">
                            <label for="emails" class="form-label">
                                <i class="fas fa-envelope"></i> Correos electrónicos:
                            </label>
                            <div id="email-container" class="mb-3">
                                <div class="input-group mb-2">
                                    <input type="email" name="emails[]" class="form-control"
                                        placeholder="Correo electrónico">
                                    <button type="button" class="btn btn-success"
                                        onclick="saveEmail(this)">Guardar</button>
                                    <button type="button" class="btn btn-danger" onclick="removeEmail(this)">-</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="addEmail()">Agregar otro
                                correo</button>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="id_email" class="form-label">
                            <i class="fas fa-envelope"></i> Correos disponibles:
                        </label>
                        <input type="text" id="correo_search" class="form-control mb-2"
                            placeholder="Buscar correo..." onkeyup="filterEmails()">
                        <select id="id_email" name="id_emails[]" class="form-select shadow-sm" multiple required>
                            <!-- se cargaran con AJAX -->
                        </select>
                        <small class="text-muted">Selecciona los correos a agregar.</small>
                        <div class="invalid-feedback">Por favor selecciona al menos un correo.</div>
                    </div>


                    <!-- Asunto y Mensaje -->
                    {{-- <div class="row">
                            <!-- Asunto -->
                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label">
                                    <i class="fas fa-envelope"></i> Asunto:
                                </label>
                                <input type="text" id="subject" name="subject" required
                                    class="form-control shadow-sm">
                                <div class="invalid-feedback">Por favor ingresa un asunto.</div>
                            </div>

                            <!-- Mensaje -->
                            <div class="col-md-12 mb-3">
                                <label for="message" class="form-label">
                                    <i class="fas fa-comment-alt"></i> Mensaje:
                                </label>
                                <textarea id="message" name="message" rows="4" required class="form-control shadow-sm"></textarea>
                                <div class="invalid-feedback">Por favor ingresa un mensaje.</div>
                            </div>
                        </div> --}}

                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary px-5 py-2 shadow-lg">
                            <i class="fas fa-paper-plane"></i> Agregar Correos
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
                        .then(response => response.json())
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
                        });
                } else {
                    resetSucursalAndCaseta();
                }
            });

            document.getElementById('id_sucursal').addEventListener('change', function() {
                const sucursalId = this.value;
                if (sucursalId) {
                    fetch(`/sucursales/${sucursalId}/casetas`)
                        .then(response => response.json())
                        .then(data => {
                            const casetaSelect = document.getElementById('id_caseta');
                            casetaSelect.innerHTML = '<option value="">Seleccione una caseta</option>';
                            casetaSelect.disabled = false;
                            data.forEach(caseta => {
                                const option = document.createElement('option');
                                option.value = caseta.id_casetas;
                                option.text = caseta.nombre;
                                casetaSelect.appendChild(option);
                            });
                        });
                } else {
                    resetCaseta();
                }
            });

            document.getElementById('id_caseta').addEventListener('change', function() {
                const casetaId = this.value;
                if (casetaId) {
                    fetch(`/casetas/${casetaId}/formatos`)
                        .then(response => response.json())
                        .then(data => {
                            const formatoSelect = document.getElementById('id_formato');
                            formatoSelect.innerHTML = '';
                            data.forEach(formato => {
                                const option = document.createElement('option');
                                option.value = formato.id_formatos;

                                option.text = formato.Tipo.charAt(0).toUpperCase() + formato
                                    .Tipo.slice(1).toLowerCase();
                                formatoSelect.appendChild(option);
                                console.log(formato.id_formatos);
                            });
                        });
                } else {
                    resetFormato();
                }
            });
        });

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

        function fetchEmpresas() {
            fetch('/empresas')
                .then(response => response.json())
                .then(data => {
                    const empresaSelect = document.getElementById('id_empresa');
                    empresaSelect.innerHTML = '<option value="">Seleccione una empresa</option>';
                    data.forEach(empresa => {
                        const option = document.createElement('option');
                        option.value = empresa.id_empresa;
                        option.textContent = empresa.alias;
                        empresaSelect.appendChild(option);
                    });
                });
        }

        function filterFormatos() {
            const input = document.getElementById('formato_search');
            const filter = input.value.toLowerCase();
            const formatoSelect = document.getElementById('id_formato');
            const options = formatoSelect.options;

            for (let i = 0; i < options.length; i++) {
                const txtValue = options[i].text;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    options[i].style.display = "";
                } else {
                    options[i].style.display = "none";
                }
            }
        }

        function addEmail() {
            const emailContainer = document.getElementById('email-container');
            const newEmailInput = document.createElement('div');
            newEmailInput.classList.add('input-group', 'mb-2');
            newEmailInput.innerHTML = `
        <input type="email" name="emails[]" class="form-control" placeholder="Correo electrónico" required>
        <button type="button" class="btn btn-success" onclick="saveEmail(this)">Guardar</button>
        <button type="button" class="btn btn-danger" onclick="removeEmail(this)">-</button>
    `;
            emailContainer.appendChild(newEmailInput);
        }

        function saveEmail(button) {
            const emailInput = button.parentElement.querySelector('input[type="email"]');
            const emailValue = emailInput.value;

  
            if (emailValue) {
                fetch('/correos', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            correo: emailValue
                        }),
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            alert('Error al guardar el correo.');
                            throw new Error('Error al guardar el correo.');
                        }
                    })
                    .then(data => {
                        const correoSelect = document.getElementById('id_email');
                        const newOption = document.createElement('option');
                        newOption.value = data.id_correo;
                        newOption.textContent = data.correo;
                        correoSelect.appendChild(newOption);

                        emailInput.value = ''; 
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error en la conexión.');
                    });
            }

        }



        document.addEventListener('DOMContentLoaded', function() {
            fetchCorreos();

            function fetchCorreos() {
                fetch('/correos')
                    .then(response => response.json())
                    .then(data => {
                        const emailSelect = document.getElementById('id_email');
                        emailSelect.innerHTML = '';
                        data.forEach(correo => {
                            const option = document.createElement('option');
                            option.value = correo.id_correo; // ID del correo
                            option.textContent = correo.correo; // Dirección de correo
                            emailSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al cargar los correos:', error));
            }
        });

        function filterEmails() {
            const input = document.getElementById('correo_search').value.toLowerCase();
            const emailSelect = document.getElementById('id_email');
            Array.from(emailSelect.options).forEach(option => {
                option.style.display = option.text.toLowerCase().includes(input) ? '' : 'none';
            });
        }

        function filterEmails() {
            const input = document.getElementById('correo_search').value.toLowerCase();
            const emailSelect = document.getElementById('id_email');
            Array.from(emailSelect.options).forEach(option => {
                option.style.display = option.text.toLowerCase().includes(input) ? '' : 'none';
            });
        }

        function removeEmail(button) {
            const emailContainer = document.getElementById('email-container');
            emailContainer.removeChild(button.parentElement);
        }
    </script>
</x-app-layout>
{{-- <style>
    /* #id_formato {
        text-transform: lowercase;
    } */

    #id_formato:first-letter {
        text-transform: uppercase;
    }
</style> --}}