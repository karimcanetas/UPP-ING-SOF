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

                    <!-- Formulario -->
                    <form method="POST" action="{{ route('empleados_formatos.store') }}" class="needs-validation"
                        novalidate>
                        @csrf
                        <!-- Empresa y Sucursal -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="id_empresa" class="form-label">
                                    <i class="fas fa-building"></i> Selecciona la empresa:
                                </label>
                                <select id="id_empresa" name="id_empresa" class="form-select shadow-sm" required>
                                    <option value="">Seleccione una empresa</option>
                                </select>
                                <div class="invalid-feedback">Por favor selecciona una empresa.</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="id_sucursal" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i> Selecciona la sucursal:
                                </label>
                                <select id="id_sucursal" name="id_sucursal" class="form-select shadow-sm" required
                                    disabled>
                                    <option value="">Seleccione una sucursal</option>
                                </select>
                                <div class="invalid-feedback">Por favor selecciona una sucursal.</div>
                            </div>
                        </div>

                        <!-- Caseta y Formatos -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="id_caseta" class="form-label">
                                    <i class="fas fa-warehouse"></i> Selecciona una caseta:
                                </label>
                                <select id="id_caseta" name="id_caseta" class="form-select shadow-sm" required disabled>
                                    <option value="">Seleccione una caseta</option>
                                </select>
                                <div class="invalid-feedback">Por favor selecciona una caseta.</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="id_formato" class="form-label">
                                    <i class="fas fa-file-alt"></i> Formatos:
                                </label>
                                <select id="id_formato" name="id_formato[]" class="form-select shadow-sm" required>
                                    <!-- Los formatos se cargarán con AJAX -->
                                </select>
                                <small class="text-muted">Selecciona un formato.</small>
                                <div class="invalid-feedback">Por favor selecciona al menos un formato.</div>
                            </div>
                        </div>

                        <!-- Departamento -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="id_departamento" class="form-label">
                                    <i class="fas fa-users"></i> Selecciona un Departamento:
                                </label>
                                <select id="id_departamento" name="id_departamento" class="form-select shadow-sm"
                                    required disabled>
                                    <option value="">Seleccione un departamento</option>
                                </select>
                                <div class="invalid-feedback">Por favor selecciona un departamento.</div>
                            </div>
                        </div>

                        <!-- Empleados disponibles -->
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="id_empleado" class="form-label">
                                    <i class="far fa-address-card"></i> Empleados disponibles:
                                </label>
                                <input type="text" id="empleado_search" class="form-control mb-2"
                                    placeholder="Buscar empleado..." onkeyup="filterEmpleados()">
                                <select id="id_empleado" name="id_empleado[]" class="form-select shadow-sm" multiple
                                    required>
                                    <!-- Los empleados se cargarán con AJAX -->
                                </select>
                                <small class="text-muted">Selecciona los empleados que deseas agregar. Mantén presionada
                                    la tecla Ctrl para seleccionar múltiples empleados.</small>
                                <div class="invalid-feedback">Por favor selecciona al menos un empleado.</div>
                            </div>
                        </div>

                        <!-- Botón Enlazar Formato -->
                        <div class="text-center mb-4">
                            <button type="submit" id="EnlaceFormato" class="btn btn-primary px-5 py-2 shadow-lg">
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"
                                    id="spinner"></span>
                                <i class="fas fa-link" id="checkIcon"></i> Enlazar Formato
                            </button>
                        </div>
                    </form>

                    <!-- Botón para destinatarios correos -->
                    {{-- <div class="text-center mb-4">
                        <button type="button" class="btn btn-warning px-4 py-2 shadow-lg" id="editarmodal">
                            <i class="fas fa-pencil-alt"></i> Destinatarios Correos
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
