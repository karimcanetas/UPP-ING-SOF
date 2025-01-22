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
</x-app-layout>
