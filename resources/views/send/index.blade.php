<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Enviar Correos') }}
        </h2>
    </x-slot>
    <div class="py-8 sm:py-10 lg:py-12">
        <div class="container mx-auto px-0 sm:px-6 lg:px-8">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-gray-100 shadow-sm p-4">
                    <h3 class="text-base sm:text-lg font-semibold mb-2 sm:mb-3 text-primary">
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
                            <h1 class="h3 mb-4 text-center responsive-header">
                                <i class="fa-solid fa-file-alt"></i> Seleccionar Formato
                            </h1>
                        </div>

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

                        <div class="d-flex justify-content-center mt-4 position-relative">
                            <button type="submit" class="btn btn-success px-5 py-2 shadow-lg" id="generarReporte">
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"
                                    id="spinner"></span>
                                <i class="fa-solid fa-check-circle" id="checkIcon"></i> Enviar Reporte
                            </button>
                        </div>
                    </form>

                    <div class="container mt-5">
                        <div class="correo-container p-4 rounded shadow">
                            <h4 class="h4 text-center mb-4 text-primary">
                                <strong><i class="fa-solid fa-envelope me-2"></i> Se enviará a:</strong>
                            </h4>
                            <ul class="correo-list list-group" id="correos">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
